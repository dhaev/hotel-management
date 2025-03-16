<?php

$conn=mysqli_connect('localhost','root','','hotel_management');
if (!$conn) {
die( 'sumn went wrong'.mysqli_connect_error());
;
}