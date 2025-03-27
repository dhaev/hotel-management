<?php
require_once 'config.php';
require_once 'header.php';
require_once 'inc/functions.php';

// Get filter values
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Pagination variables
$limit = 30; // Number of rows per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Calculate offset

// Base SQL query with filtering
$sql = "SELECT 
            reservations.id, 
            customer.fname, 
            customer.lname, 
            reservations.start_date, 
            reservations.end_date, 
            reservation_status_code.description AS status 
        FROM reservations
        JOIN customer ON reservations.user_id = customer.CustomerID
        JOIN reservation_status_code ON reservations.status = reservation_status_code.code
        WHERE reservations.start_date >= '$start_date'";

// Add end_date filter if provided
if (!empty($end_date)) {
    $sql .= " AND reservations.end_date <= '$end_date'";
}

// Add LIMIT and OFFSET for pagination
$sql .= " LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);

// Check if there is data for the next page
$next_offset = $offset + $limit;
$next_sql = "SELECT 1 FROM reservations 
             JOIN customer ON reservations.user_id = customer.CustomerID
             JOIN reservation_status_code ON reservations.status = reservation_status_code.code
             WHERE reservations.start_date >= '$start_date'";
if (!empty($end_date)) {
    $next_sql .= " AND reservations.end_date <= '$end_date'";
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
<div class="text-right">
    <a href="book.php" class="btn btn-secondary btn-md">Add Reservation</a>
</div>
</div>

<!-- Reservations Table -->
<table id="" class="w3-table-all w3-hoverable w3-card-4 w3-small w3-centered">
    <thead>
        <tr class="w3-black">
            <th>Reservation ID</th>
            <th>Customer Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['fname'] . " " . $row['lname'] ?></td>
                <td><?= $row['start_date'] ?></td>
                <td><?= $row['end_date'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <!-- Edit Button -->
                    <a href="edit_reservation.php?reservation_id=<?= $row['id']; ?>" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-edit">Edit</span>
                    </a>

                    <!-- Checkin Form -->
                    <form action="api/checkin.php" method="POST" style="display:inline;">
                        <input type="hidden" class="form-control"  name="reservation_id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-ok-sign">Checkin</span>
                        </button>
                    </form>

                    <!-- Checkout Form -->
                    <form action="api/checkout.php" method="POST" style="display:inline;">
                        <input type="hidden" class="form-control"  name="reservation_id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-ok-sign">Checkout</span>
                        </button>
                    </form>

                    <!-- Cancel Form -->
                    <form action="api/cancel.php" method="POST" style="display:inline;">
                        <input type="hidden" class="form-control"  name="reservation_id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <span class="glyphicon glyphicon-remove-sign">Cancel</span>
                        </button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1) { ?>
        <a class="btn btn-primary btn-sm m-1"  href="?start_date=<?= htmlspecialchars($start_date) ?>&end_date=<?= htmlspecialchars($end_date) ?>&page=<?= $page - 1 ?>" class="btn btn-secondary">Previous</a>
    <?php } ?>
    <?php if ($has_next_page) { ?>
        <a class="btn btn-primary btn-sm m-1"  href="?start_date=<?= htmlspecialchars($start_date) ?>&end_date=<?= htmlspecialchars($end_date) ?>&page=<?= $page + 1 ?>" class="btn btn-secondary">Next</a>
    <?php } ?>
</div>

<?php
require_once 'footer.php';
?>