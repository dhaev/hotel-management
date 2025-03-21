<?php
require '../vendor/autoload.php';
include '../config.php';
require_once 'functions.php';
\Stripe\Stripe::setApiKey(STRIPE_API_KEY);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_id = $_POST['reservation_id'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Fetch payment details
        $stmt = $conn->prepare("SELECT id, stripe_payment_id, amount FROM payments WHERE reservation_id = ?");
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();
        $stmt->bind_result($payment_id, $stripe_payment_id, $amount);
        $stmt->fetch();
        $stmt->close();

        // Process refund with Stripe
        $refund = \Stripe\Refund::create([
            'payment_intent' => $stripe_payment_id,
            'amount' => $amount * 100, // Stripe expects the amount in cents
        ]);

        // Store refund details
        $stmt = $conn->prepare("INSERT INTO refunds (payment_id, amount, refund_date, stripe_refund_id) VALUES (?, ?, NOW(), ?)");
        $stmt->bind_param("ids", $payment_id, $amount, $refund->id);
        $stmt->execute();
        $stmt->close();

        // Delete reservation details
        $stmt = $conn->prepare("DELETE FROM reservation_details WHERE reservation_id = ?");
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();
        $stmt->close();

        // Delete reservation rooms
        $stmt = $conn->prepare("DELETE FROM reservation_rooms WHERE reservation_id = ?");
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();
        $stmt->close();

        // Delete reservation
        $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $conn->commit();
        echo json_encode(['status' => 'success', 'message' => 'Reservation cancelled and refund processed successfully!']);
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