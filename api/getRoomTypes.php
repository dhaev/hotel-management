<?php
include '../config.php';

header('Content-Type: application/json');

$sql = "SELECT * FROM room_type WHERE rtype IN (SELECT rtype FROM room)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo json_encode(['error' => 'Could not connect to the database']);
    exit();
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$roomTypes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $roomTypes[] = $row;
}

echo json_encode($roomTypes);
?>
