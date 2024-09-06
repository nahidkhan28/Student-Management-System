<?php
session_start();
include('dbcon.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['uname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query to check if a user exists with the provided username/email combination
    $query = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['uname'] = $username;
            $_SESSION['authenticated'] = true;  // Set the authenticated flag
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Logged in successfully'
            ];
            header('Location: ../index_crud.php');
            exit();
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Invalid credentials'
            ];
            header('Location: ../login.php');
            exit();
        }
    } else {
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'User not found or incorrect email'
        ];
        header('Location: ../login.php');
        exit();
    }
}

?>