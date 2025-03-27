<?php
require_once 'config.php';
require_once 'header.php';

// Get filter values
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Pagination variables
$limit = 30; // Number of rows per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Calculate offset

// Base SQL query with filtering
$sql = "SELECT 
            reservations.id AS ReservationID,
            CONCAT(customer.fname, ' ', customer.lname) AS CustomerName,
            room.rnum AS RoomNumber,
            room_type.rtype AS RoomType,
            reservations.date_cancelled AS CancelTime
        FROM reservations
        JOIN customer ON reservations.user_id = customer.CustomerID
        JOIN reservation_details ON reservations.id = reservation_details.reservation_id
        JOIN room ON reservation_details.type_id = room.RtypeID
        JOIN room_type ON room.RtypeID = room_type.RtypeID
        WHERE reservations.cancelled = 1 AND reservations.date_cancelled >= '$start_date'";

// Add end_date filter if provided
if (!empty($end_date)) {
    $sql .= " AND reservations.date_cancelled <= '$end_date'";
}

// Add LIMIT and OFFSET for pagination
$sql .= " LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);

// Check if there is data for the next page
$next_offset = $offset + $limit;
$next_sql = "SELECT 1 FROM reservations 
             WHERE reservations.cancelled = 1 AND reservations.date_cancelled >= '$start_date'";
if (!empty($end_date)) {
    $next_sql .= " AND reservations.date_cancelled <= '$end_date'";
}
$next_sql .= " LIMIT 1 OFFSET $next_offset";
$next_result = mysqli_query($conn, $next_sql);
$has_next_page = mysqli_num_rows($next_result) > 0;
?>

<div>
<!-- Filter Form -->
<form method="GET">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control date" name="start_date" id="start_date" value="<?= htmlspecialchars($start_date) ?>" required>
        </div>
        <div class="form-group col-md-2">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control date" name="end_date" id="end_date" value="<?= htmlspecialchars($end_date) ?>">
        </div>
        <div class="form-group col-md-1 mt-4">
            <button type="submit" class="btn btn-primary btn-md">Filter</button>
        </div>
    </div>
</form>
</div>

<!-- Cancelled Reservations Table -->
<table id="example23" class="w3-table-all w3-hoverable w3-card-4 w3-small w3-centered">
    <thead>
        <tr class="w3-black">
            <th>#</th>
            <th>Customer Name</th>
           
            <th>Room No</th>
            <th>Room Type</th>
            <th>Cancel Time</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['ReservationID'] ?></td>
                <td><?= $row['CustomerName'] ?></td>
              
                <td><?= $row['RoomNumber'] ?></td>
                <td><?= $row['RoomType'] ?></td>
                <td><?= $row['CancelTime'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1) { ?>
        <a class="btn btn-primary btn-sm m-1" href="?start_date=<?= htmlspecialchars($start_date) ?>&end_date=<?= htmlspecialchars($end_date) ?>&page=<?= $page - 1 ?>">Previous</a>
    <?php } ?>
    <?php if ($has_next_page) { ?>
        <a class="btn btn-primary btn-sm m-1" href="?start_date=<?= htmlspecialchars($start_date) ?>&end_date=<?= htmlspecialchars($end_date) ?>&page=<?= $page + 1 ?>">Next</a>
    <?php } ?>
</div>

<?php
require_once 'footer.php';
?>


