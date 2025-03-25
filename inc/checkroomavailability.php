<?php
require_once '../config.php';

$start = $_GET['start'];
$end = $_GET['end'];

if (!$start || !$end) {
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

$query = "CALL CheckRoomAvailability(?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $start, $end);
$stmt->execute();
$result = $stmt->get_result();

$roomAvailability = [];
while ($row = $result->fetch_assoc()) {
    $roomAvailability[] = $row;
}

echo json_encode($roomAvailability);
?>
