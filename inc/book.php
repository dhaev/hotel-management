<?php
require '../vendor/autoload.php';
include '../config.php';
require_once 'functions.php';
require_once '../secrets.php'; 

session_start();

$stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

print_r($_POST);
if (isset($_POST['checkin']) && isset($_POST['checkout'])) {

    $start_date = $_POST['checkin'];
    $end_date = $_POST['checkout'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_id = $_SESSION['CustomerID'];
    // $user_id = $_POST['user_id'];
    $status = 0;

    $room = $_POST['room'];

    $total_amount =0;// = $_POST['total_amount']; // Calculate this based on room types and number of rooms
    $currency = 'usd';
    $metadata = [
        'user_id' => $user_id,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'rooms' => json_encode($room)
    ];
    var_dump($_POST);
    // var_dump($_POST['payment_method_id']);
    try {
        $line_item_array = [];
        foreach ($room as $value) {
            $rtype = $value['rtype'];
            $numr = $value['numr'];
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
            
            $line_item_array[] = [
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => $roomtype,
                        'description' => "$numDays day(s): $start_date to $end_date",
                    ],
                    'unit_amount' => $pricePerRoom * $numDays * 100,
                ],
                'quantity' => intval($numr),
            ];
        }

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $line_item_array,
            'mode' => 'payment',
            'success_url' => BASE_URL.'success.php',
            'cancel_url' => BASE_URL.'site/cancel.php',
            'metadata' => $metadata
        ]);

        // Return the checkout session URL to the client
        // echo json_encode(['url' => $checkout_session->url]);
        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
} else {
    echo('index.php');
    exit();
}
?>