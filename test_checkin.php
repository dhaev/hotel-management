<?php
require_once 'config.php';
require_once 'header.php';
require_once 'secrets.php';
require_once 'inc/functions.php';
?>
    <h1>Test Check-In API</h1>
    <button id="checkinButton">Check In Reservation ID 13</button>
    <p id="response"></p>

    <script>
        document.getElementById('checkinButton').addEventListener('click', function () {
            fetch('api/checkin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'reservation_id=13'
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('response').textContent = JSON.stringify(data, null, 2);
            })
            .catch(error => {
                document.getElementById('response').textContent = 'Error: ' + error;
            });
        });
    </script>
<?php require_once 'footer.php'; ?>
