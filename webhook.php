<?php
require 'vendor/autoload.php';
include 'config.php';
require_once 'inc/functions.php';
require_once 'secrets.php'; 

\Stripe\Stripe::setApiKey(STRIPE_API_KEY);

$endpoint_secret = STRIPE_DASHBOARD_WEBHOOK_SECRET;

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Event::constructFrom(
    json_decode($payload, true)
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  error_log('⚠️  Webhook error while parsing basic request.') ;
  http_response_code(400);
  exit();
}
if ($endpoint_secret) {
  // Only verify the event if there is an endpoint secret defined
  // Otherwise use the basic decoded event
  $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
  try {
    $event = \Stripe\Webhook::constructEvent(
      $payload, $sig_header, $endpoint_secret
    );
  } catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    error_log('⚠️  Webhook error while validating signature.');
    echo '⚠️  Webhook error while validating signature.';
    http_response_code(400);
    exit();
  }
}



// Handle the event
if ($event->type == 'checkout.session.completed') {
    error_log('🔔  Checkout session completed!');
    echo "Checkout session completed";
    echo "\n i've got the hoook hook hook !!!!!!!!!!!!!!";
    $session = $event->data->object;

    // Retrieve the session to get the customer details
    $checkout_session = \Stripe\Checkout\Session::retrieve($session->id);

    // Start a transaction
    $conn->begin_transaction();

    try {
        error_log('🔔  Transaction started!');
        $user_id = $checkout_session->metadata->user_id;
        $start_date = $checkout_session->metadata->start_date; 
        $end_date = $checkout_session->metadata->end_date;
        $room = json_decode($checkout_session->metadata->rooms, true);
        $total_amount = $checkout_session->amount_total / 100;
        $currency = $checkout_session->currency;
        $payment_status = $checkout_session->payment_status;
        error_log('Payment_status :'.$payment_status);
        // Insert reservation
        $stmt = $conn->prepare("INSERT INTO reservations (user_id, start_date, end_date) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $start_date, $end_date);
        $stmt->execute();
        $reservation_id = $stmt->insert_id;
        $stmt->close();

        // Insert reservation details
        error_log('🔔  Inserting reservation details!');
        foreach ($room as $value) {
            $type_id = $value['rtype'];
            $num_rooms = $value['numr'];
            $stmt = $conn->prepare("INSERT INTO reservation_details (reservation_id, type_id, num_rooms) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $reservation_id, $type_id, $num_rooms);
            $stmt->execute();
            $stmt->close();
        }

        // Store payment details
        error_log('🔔  Storing payment details!');
        $stmt = $conn->prepare("INSERT INTO payments (reservation_id, amount, currency, payment_status, payment_date, stripe_payment_id, payment_intent) VALUES (?, ?, ?, ?, NOW(), ?, ?)");
        $stmt->bind_param("idssss", $reservation_id, $total_amount, $currency, $payment_status, $checkout_session->id, $checkout_session->payment_intent);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        error_log('🔔  Committing transaction!');
        $conn->commit();
    } catch (Exception $e) {
        // Rollback transaction on error
        error_log('🔔  Rolling back transaction!');
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}

http_response_code(200);
?>
