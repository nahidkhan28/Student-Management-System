<?php
session_start();
include('header.php'); 
include('dbcon.php'); 

$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM students WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

if (isset($_POST['Update_student'])) {
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $age = $_POST['age'];
    $bgroup = $_POST['b_group'];

    $query = "UPDATE students SET first_name = '$fname', last_name = '$lname', age = '$age', blood_group = '$bgroup' WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    } else {
        header("Location: ../index_crud.php?update_msg=You have successfully updated the data");
        exit();
    }
}
?>

<form action="updatepage.php?id=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label for="f_name">First Name :</label>
        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name :</label>
        <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>">
    </div>
    <div class="form-group">
        <label for="age">Age :</label>
        <input type="number" name="age" class="form-control" value="<?php echo $row['age']; ?>">
    </div>
    <div class="form-group">
        <label for="b_group">Blood Group :</label>
        <input type="text" name="b_group" class="form-control" value="<?php echo $row['blood_group']; ?>">
    </div>
    <input type="submit" class="btn btn-success mt-2" name="Update_student" value="Update">
</form>

<?php include('footer.php'); ?>
