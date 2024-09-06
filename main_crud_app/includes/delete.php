<?php 
session_start();
include('dbcon.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query ="DELETE FROM students WHERE id = '$id'";

    $result = mysqli_query($con, $query);

    if(!$result){
        die("Query failed : ".mysqli_error($con));
    } else {
        header("location:../index_crud.php?delete_msg=You have deleted the record.");
        exit();
    }
}
?>
