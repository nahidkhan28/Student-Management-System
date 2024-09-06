<?php
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'You need to log in first!'];
    header('Location: login.php');
    exit();
}

include('includes/header.php');
include('includes/dbcon.php');

// Pagination settings
$records_per_page = 8; // Number of records to show per page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int)$_GET['page'];
} else {
    $current_page = 1; // Default to page 1
}

$offset = ($current_page - 1) * $records_per_page;

// Fetch the total number of records
$total_query = "SELECT COUNT(*) FROM `students`";
$total_result = mysqli_query($con, $total_query);
$total_records = mysqli_fetch_array($total_result)[0];
$total_pages = ceil($total_records / $records_per_page);

// Fetch records for the current page
$query = "SELECT * FROM `students` LIMIT $offset, $records_per_page";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<div class="container">
    <div class="box1">
        <h2>All STUDENT</h2>
        <div class="button-group">
            <!-- <a href="includes/logout_process.php" class="btn btn-danger">Logout</a> -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD STUDENTS</button>
        </div>
    </div>

    <table class="table table-hover table-ordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>AGE</th>
                <th>BLOOD GROUP</th>
                <th>UPDATE</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['age']); ?></td>
                    <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                    <td><a href="includes/updatepage.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-success">Update</a></td>
                    <td><a href="includes/delete.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination-wrapper">
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($current_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index_crud.php?page=<?php echo $current_page - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
                        <a class="page-link" href="index_crud.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="index_crud.php?page=<?php echo $current_page + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<form action="includes/insert_data.php" method="post">
    <!-- Modal content -->
</form>



<form action="includes/insert_data.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add students</h5>
                    <button type="button" class="close ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="f_name">First Name</label>
                        <input type="text" name="f_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="l_name">Last Name</label>
                        <input type="text" name="l_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="b_group">Blood Group</label>
                        <input type="text" name="b_group" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="add_students" value="ADD">
                </div>
            </div>
        </div>
    </div>
</form>

<script>
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "500",
    "timeOut": "2000",
    "extendedTimeOut": "500",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.onload = function() {
    <?php if (isset($_SESSION['flash_message'])): ?>
        toastr.<?php echo $_SESSION['flash_message']['type']; ?>('<?php echo $_SESSION['flash_message']['message']; ?>');
        <?php unset($_SESSION['flash_message']); // Clear the message ?>
    <?php endif; ?>

    <?php if (isset($_GET['update_msg'])): ?>
        toastr.success('<?php echo htmlspecialchars($_GET['update_msg']); ?>');
    <?php endif; ?>

    <?php if (isset($_GET['delete_msg'])): ?>
        toastr.success('<?php echo htmlspecialchars($_GET['delete_msg']); ?>');
    <?php endif; ?>
};
</script>

<?php include('includes/footer.php'); ?>
