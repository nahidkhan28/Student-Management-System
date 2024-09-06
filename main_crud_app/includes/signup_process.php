<?php
session_start();
include('dbcon.php');

if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'Passwords do not match!'
        ];
        header('location: ../signup.php');
        exit();
    }

    // Check if the user already exists
    $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // User already exists
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'Signup failed: User already exists!'
        ];
        header('location: ../signup.php');
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

    if (mysqli_query($con, $query)) {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Signup successful! Please login.'
        ];
        header('location: ../index.php');
        exit();
    } else {
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'Signup failed: ' . mysqli_error($con)
        ];
        header('location: ../signup.php');
        exit();
    }
}

?>

<?php include('includes/footer.php'); ?>
