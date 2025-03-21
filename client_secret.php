<?php
require 'vendor/autoload.php';
include 'config.php';
require_once 'secrets.php';
// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

// $intent = $stripe->paymentIntents->create([
//   'amount' => 1099,
//   'currency' => 'cad',
//   'automatic_payment_methods' => ['enabled' => true],
// ]);
// error_log('created payment intent'.$intent);
if (isset($_GET['payment_intent_id'])) {
    $intent_id=$_GET['payment_intent_id'];
    $intent = $stripe->paymentIntents->retrieve($intent_id,[]);
    echo json_encode(['client_secret' => $intent->client_secret]);
} else {
    echo json_encode(array('error' => 'Invalid request'));
}


?>