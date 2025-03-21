<?php
require '../vendor/autoload.php';
include '../config.php';
require_once 'functions.php';
\Stripe\Stripe::setApiKey(STRIPE_API_KEY);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $start_date = $_POST['checkin'];
    $end_date = $_POST['checkout'];
    $room = $_POST['room']; // Array of room types and number of rooms
    $total_amount = 0; // Total amount to be charged
     // Additional amount to be charged

    // Start a transaction
    $conn->begin_transaction();

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
            $room_type_details = rtypeExists($conn, $rtype);
            $pricePerRoom = $room_type_details["price"];
            $roomtype = $room_type_details["rtype"];
    
            $currentDate = new DateTime();
            $checkinDate = new DateTime($start_date);
            $checkoutDate = new DateTime($end_date);

            $interval = $checkinDate->diff($checkoutDate);
            $numDays = $interval->days;
    
            $totalPrice = $pricePerRoom * $numDays * intval($numr);
            $total_amount += $totalPrice;

            $stmt = $conn->prepare("INSERT INTO reservation_details (reservation_id, type_id, num_rooms) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $reservation_id, $type_id, $num_rooms);
            $stmt->execute();
            $stmt->close();
        }

        function getpaymentdetails($conn,$reservation_id){
            //---------------------SELECT ROOM TYPE----------------------------------------
                $sql="SELECT amount, payment_intent FROM payment WHERE reservation_id = ?;";
                $stmt=mysqli_stmt_init($conn);
        
                if (!mysqli_stmt_prepare($stmt,$sql)){
                    echo('failed to connect');
                    exit();
                }
                mysqli_stmt_bind_param($stmt,'i',$reservation_id);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_assoc($result)){
                        return $row;
                    }
                }
                else {
                    $result = false;
                    
                    echo('Room type does not exist');
                }
                return $result;
                mysqli_stmt_close($stmt);
            }
            $original_payment = getpaymentdetails($conn,$reservation_id);
            $original_amount = $original_payment['amount'];
            $original_payment_intent = $original_payment['payment_intent'];
            $additional_amount = $total_amount - $original_amount;
        // Process additional payment with Stripe
        if ($additional_amount > 0) {
            $payment_intent = \Stripe\PaymentIntent::create([
                'amount' => $additional_amount * 100, // Stripe expects the amount in cents
                'currency' => 'usd',
                'payment_method' => $_POST['payment_method_id'],
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            if ($payment_intent->status != 'succeeded') {
                throw new Exception("Additional payment failed: " . $payment_intent->status);
            }
        }
        if ($additional_amount < 0) {
            $refund = \Stripe\Refund::create([
                'payment_intent' => $original_payment_intent,
                'amount' => abs($additional_amount) * 100, // Stripe expects the amount in cents
            ]);

            if ($refund->status != 'succeeded') {
                throw new Exception("Refund failed: " . $refund->status);
            }

            // Store refund details
            $stmt = $conn->prepare("INSERT INTO refunds (payment_id, amount, refund_date, stripe_refund_id) VALUES (?, ?, NOW(), ?)");
            $stmt->bind_param("ids", $payment_id, $amount, $refund->id);
            $stmt->execute();
            $stmt->close();
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(['status' => 'success', 'message' => 'Reservation modified successfully!']);
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>