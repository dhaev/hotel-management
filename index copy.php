<?php
require_once 'config.php';
require_once 'header.php';
require_once 'secrets.php';
require_once 'inc/functions.php';
?>
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', async () => {
  const paymentIntentId = '<?= $_GET['payment_intent_id']; ?>';
  console.log('Payment Intent ID:', paymentIntentId);

  try {
    const response = await fetch(`https://b1e5-2607-fea8-d5c3-8100-b55c-d2b1-c034-a0ce.ngrok-free.app/client_secret.php?payment_intent_id=${paymentIntentId}`);
    const {client_secret: clientSecret} = await response.json();

    if (clientSecret) {
      console.log('Client Secret:', clientSecret);

      const stripe = Stripe('pk_test_51R4LZERq0GzSOwDwRwknBaC44wxC1MdiJ8WdUx1MMwefRtZlHYbmdMH9qID57Oje6BiVfcB5huEcsY26FgdBGnYb00hojg3z6l');
      const options = {
        clientSecret: clientSecret,
        appearance: {
          theme: 'night',
          labels: 'floating',
        }
      };

      // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in a previous step
      const elements = stripe.elements(options);

      // Create and mount the Payment Element
      const paymentElementOptions = { layout: 'tabs' };
      const paymentElement = elements.create('payment', paymentElementOptions);
      paymentElement.mount('#payment-element');

      const form = document.getElementById('payment-form');

      form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const { error } = await stripe.confirmPayment({
          // `Elements` instance that was used to create the Payment Element
          elements,
          confirmParams: {
            return_url: 'https://b1e5-2607-fea8-d5c3-8100-b55c-d2b1-c034-a0ce.ngrok-free.app/payment_status.php',
          },
        });

        if (error) {
          // This point will only be reached if there is an immediate error when
          // confirming the payment. Show error to your customer (for example, payment
          // details incomplete)
          const messageContainer = document.querySelector('#error-message');
          messageContainer.textContent = error.message;
        } else {
          // Your customer will be redirected to your `return_url`. For some payment
          // methods like iDEAL, your customer will be redirected to an intermediate
          // site first to authorize the payment, then redirected to the `return_url`.
        }
      });
    } else {
      console.error('Client secret not found in response:', data);
    }
  } catch (error) {
    console.error('Error fetching client secret:', error);
  }
});
</script>
<div class="container mt-5">
   
   <form id="payment-form">
    <h3 class="text-center ">Payment</h3>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4">
            <label for="payment-element"></label>
            <div id="payment-element">
              <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="error-message" role="alert"></div>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-md-4 text-center">
            <button class="btn btn-primary" type="submit" id="submit">Submit</button>
         </div>
      </div>
   </form>
</div>


<?php 
require_once 'footer.php';
?>