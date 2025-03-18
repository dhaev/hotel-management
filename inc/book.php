<?php
print_r($_POST);
if (isset($_POST['checkin']) && isset($_POST['checkout'])) {

    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = 0;

    $room = $_POST['room'];
    require_once '../config.php';
    require_once 'functions.php';

    $currentDate = new DateTime();
    $checkinDate = new DateTime($checkin);
    $checkoutDate = new DateTime($checkout);

    // Check if check-in date is in the past
    if ($checkinDate < $currentDate) {
        echo('index.php ? error=check-in date cannot be in the past');
        exit();
    }

    // Check if check-out date is before check-in date
    if ($checkoutDate <= $checkinDate) {
        echo('index.php ? error=check-out date cannot be before or the same as check-in date');
        exit();
    }

    foreach ($room as $value) {
        $rtype = $value['rtype'];
        $numr = $value['numr'];
        $price = $value['price'];

        if (bookEmpty($checkin, $checkout, $rtype, $numr, $price, $fname, $lname, $email, $phone) !== false) {
            echo('index.php ? error=please fill all fields');
            exit();
        }
    }

    $BookID = createBook($conn, $checkin, $checkout, $fname, $lname, $email, $phone);

    foreach ($room as $value) {
        $rtype = $value['rtype'];
        $numr = $value['numr'];
        $pricePerRoom = rtypeprice($conn, $rtype)["price"];

        $interval = $checkinDate->diff($checkoutDate);
        $numDays = $interval->days;

        $totalPrice = $pricePerRoom * $numDays;

        for ($i = 1; $i <= intval($numr); $i++) {
            bookRnum($conn, $rtype, $checkin, $checkout, $BookID, $status, $totalPrice);
        }
    }
} else {
    echo('index.php');
    exit();
}
?>