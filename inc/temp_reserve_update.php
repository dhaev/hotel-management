<?php
require '../vendor/autoload.php';
include '../config.php';
require_once 'functions.php';
include '../secrets.php';
\Stripe\Stripe::setApiKey(STRIPE_API_KEY);

function calculateTotalAmount($conn, $reservation_id) {
    $sql = "
    WITH RefundTotals AS (
        SELECT 
            payment_intent, 
            SUM(amount) AS total_refunds
        FROM 
            refunds
        GROUP BY 
            payment_intent
    )
    SELECT 
        SUM(COALESCE(payments.amount - RefundTotals.total_refunds, payments.amount)) AS total_amount
    FROM 
        payments
    LEFT JOIN 
        RefundTotals 
    ON 
        payments.payment_intent = RefundTotals.payment_intent
    WHERE 
        payments.reservation_id = ?
    GROUP BY 
        payments.reservation_id
    ";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo('Failed to connect');
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $reservation_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $total_amount = 0;
    if ($row = mysqli_fetch_assoc($result)) {
        $total_amount = $row['total_amount'];
    }
    mysqli_stmt_close($stmt);

    return $total_amount;
}


function fetchRefundableAmounts($conn, $reservation_id) {
    $sql = "
    WITH RefundTotals AS (
        SELECT 
            payment_intent, 
            SUM(amount) AS total_refunds
        FROM 
            refunds
        GROUP BY 
            payment_intent
    )
    SELECT 
        payments.id, 
        payments.payment_intent, 
        payments.amount, 
        RefundTotals.total_refunds, 
        COALESCE(payments.amount - RefundTotals.total_refunds, payments.amount) AS refundable_amount
    FROM 
        payments
    LEFT JOIN 
        RefundTotals 
    ON 
        payments.payment_intent = RefundTotals.payment_intent
    WHERE 
        payments.reservation_id = ?
    ORDER BY 
        payments.payment_date DESC;
    ";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo('Failed to connect');
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $reservation_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $refundable_amounts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $refundable_amounts[] = $row;
    }
    mysqli_stmt_close($stmt);

    return $refundable_amounts;
}

function processRefunds($conn, $reservation_id, $refund_amount) {
    

    // Fetch refundable amounts for the reservation
    $refundable_amounts = fetchRefundableAmounts($conn, $reservation_id);

    // Convert the refund amount to cents (Stripe expects amounts in cents)
    $remaining_refund_amount = $refund_amount * 100;
    error_log("Starting refund process for reservation_id: $reservation_id, refund_amount: $refund_amount, remaining_refund_amount: $remaining_refund_amount");

    // Loop through each refundable amount
    foreach ($refundable_amounts as $refundable) {
        $payment_id = $refundable['id'];
        $payment_intent = $refundable['payment_intent'];
        $refundable_amount = $refundable['refundable_amount'] * 100; // Convert to cents

        error_log("Processing payment_id: $payment_id, payment_intent: $payment_intent, refundable_amount: $refundable_amount, remaining_refund_amount: $remaining_refund_amount");

        if ($remaining_refund_amount <= 0) {
            break;
        }

        $refund_amount_for_intent = min($remaining_refund_amount, $refundable_amount);
        error_log("Refund amount for intent: $refund_amount_for_intent");

        try {
            $refund = \Stripe\Refund::create([
                'payment_intent' => $payment_intent,
                'amount' => $refund_amount_for_intent,
            ]);

            if ($refund->status != 'succeeded') {
                throw new Exception("Refund failed: " . $refund->status);
            }

            // Store refund details in the database
            $sql_refund = "INSERT INTO refunds (payment_id, payment_intent, amount, refund_date, stripe_refund_id) VALUES (?, ?, ?, NOW(), ?)";
            $stmt_refund = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt_refund, $sql_refund)) {
                throw new Exception('Failed to prepare statement: ' . mysqli_error($conn));
            }
            $amount_refunded = $refund_amount_for_intent / 100;
            $stripe_refund_id = $refund->id;
            error_log("Storing refund details: payment_id: $payment_id, payment_intent: $payment_intent, amount_refunded: $amount_refunded, stripe_refund_id: $stripe_refund_id");
            mysqli_stmt_bind_param($stmt_refund, 'isds', $payment_id, $payment_intent, $amount_refunded, $stripe_refund_id);
            mysqli_stmt_execute($stmt_refund);
            mysqli_stmt_close($stmt_refund);

            $remaining_refund_amount -= $refund_amount_for_intent;
            error_log("Updated remaining_refund_amount: $remaining_refund_amount");
        } catch (Exception $e) {
            error_log('Error processing refund: ' . $e->getMessage());
            throw $e;
        }
    }

    if ($remaining_refund_amount > 0) {
        throw new Exception("Not enough funds to refund the full amount");
    }

    echo('Refund processed successfully');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $start_date = $_POST['checkin'];
    $end_date = $_POST['checkout'];
    $room = $_POST['room']; // Array of room types and number of rooms
    $amount_to_charge = 0; // Total amount to be charged
    $metadata = [
        'reservation_id' => $reservation_id,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'rooms' => json_encode($room)
    ];
    $currentDate = new DateTime();
    $checkinDate = new DateTime($start_date);
    $checkoutDate = new DateTime($end_date);

    $interval = $checkinDate->diff($checkoutDate);
    $numDays = $interval->days;

    $total_amount_previously_charged = calculateTotalAmount($conn, $reservation_id);

    foreach ($room as $value) {
        $type_id = $value['rtype'];
        $num_rooms = $value['numr'];
        $room_type_details = rtypeExists($conn, $type_id);// check if you can cache this using session or somethingelse to avoid multiple db calls.
        $pricePerRoom = $room_type_details["price"];
        $roomtype = $room_type_details["rtype"];
        $totalPrice = $pricePerRoom * $numDays * intval($num_rooms);
        $amount_to_charge += $totalPrice;
    }

    $total_amount_to_charge = $total_amount_previously_charged - $amount_to_charge;
    if ($total_amount_to_charge > 0) {
        $payment_intent = \Stripe\PaymentIntent::create([
            'amount' => $total_amount_to_charge * 100, // Stripe expects the amount in cents
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
            'metadata' => $metadata,
        ]);
        echo json_encode(['status' => 'requires_payment', 'payment_intent_id' => $payment_intent->id,'client_secret' => $payment_intent->client_secret]);
        exit();
    }

    if ($total_amount_to_charge < 0) {
        $total_amount_to_refund = abs($total_amount_to_charge);
        processRefunds($conn, $reservation_id, $total_amount_to_refund);


    }

    if ($total_amount_to_charge == 0) {
        
    try {
        // Update reservation dates
        $stmt = $conn->prepare("UPDATE reservations SET start_date = ?, end_date = ? WHERE id = ?");
        $stmt->bind_param("ssi", $start_date, $end_date, $reservation_id);
        $stmt->execute();
        $stmt->close();

        // Update reservation details
        $stmt = $conn->prepare("DELETE FROM reservation_details WHERE reservation_id = ?");
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();
        $stmt->close();

        foreach ($room as $value) {
            $type_id = $value['rtype'];
            $num_rooms = $value['numr'];
            $room_type_details = rtypeExists($conn, $type_id);
            $pricePerRoom = $room_type_details["price"];
            $roomtype = $room_type_details["rtype"];

            $stmt = $conn->prepare("INSERT INTO reservation_details (reservation_id, type_id, num_rooms) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $reservation_id, $type_id, $num_rooms);
            $stmt->execute();
            $stmt->close();
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(['status' => 'success', 'message' => 'no_payment_required']);
        // echo json_encode(['status' => 'no_payment_required']);
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

   
        exit();
    }

}