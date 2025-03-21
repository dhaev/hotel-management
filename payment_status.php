<?php
   require_once 'config.php';
   require_once 'header.php';
   require_once 'secrets.php';
   require_once 'inc/functions.php';


 ?>
<div id="message">
    <!-- Display error message to your customers here -->
  </div>
  <script src="https://js.stripe.com/v3/"></script>
<script>
// Initialize Stripe.js using your publishable key
const stripe = Stripe('pk_test_51R4LZERq0GzSOwDwRwknBaC44wxC1MdiJ8WdUx1MMwefRtZlHYbmdMH9qID57Oje6BiVfcB5huEcsY26FgdBGnYb00hojg3z6l');

// Retrieve the "payment_intent_client_secret" query parameter appended to
// your return_url by Stripe.js
const clientSecret = new URLSearchParams(window.location.search).get(
  'payment_intent_client_secret'
);

const redirectStatus = new URLSearchParams(window.location.search).get(
  'redirect_status'
);

console.log('redirect_status ', redirectStatus);


// Retrieve the PaymentIntent
stripe.retrievePaymentIntent(clientSecret).then(({paymentIntent}) => {
  const message = document.querySelector('#message')

  // Inspect the PaymentIntent `status` to indicate the status of the payment
  // to your customer.
  //
  // Some payment methods will [immediately succeed or fail][0] upon
  // confirmation, while others will first enter a `processing` state.
  //
  // [0]: https://stripe.com/docs/payments/payment-methods#payment-notification
  switch (paymentIntent.status) {
    case 'succeeded':
      message.innerText = 'Success! Payment received.';
      break;

    case 'processing':
      message.innerText = "Payment processing. We'll update you when payment is received.";
      break;

    case 'requires_payment_method':
      message.innerText = 'Payment failed. Please try another payment method.';
      // Redirect your user back to your payment page to attempt collecting
      // payment again
      break;

    default:
      message.innerText = 'Something went wrong.';
      break;
  }
});
</script>
<?php 
require_once 'footer.php';
?>