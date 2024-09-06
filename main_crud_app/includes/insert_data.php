<?php
session_start();
include('dbcon.php');

if (isset($_POST['add_students'])) {
    $first_name = $_POST['f_name'];
    $last_name = $_POST['l_name'];
    $age = $_POST['age'];
    $blood_group = $_POST['b_group'];

    $query = "INSERT INTO students (first_name, last_name, age, blood_group) VALUES ('$first_name', '$last_name', '$age','$blood_group')";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    } else {
        header("Location: ../index_crud.php");
        exit();
    }
} else {
    echo "Form not submitted correctly.";
}
?>

<!-- #know die and echo and its uses ? -->