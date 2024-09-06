<?php 
session_start();
include('includes/header.php'); 
?>

<?php
if (isset($_SESSION['flash_message'])) {
    $flash_message = $_SESSION['flash_message'];
    echo '<script type="text/javascript">
            $(document).ready(function() {
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
                toastr["' . $flash_message['type'] . '"]("' . addslashes($flash_message['message']) . '");
            });
          </script>';
    unset($_SESSION['flash_message']);
}
?>

<div class="container" style="max-width: 30rem;">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center fw-bold">LOGIN SYSTEM IN PHP</h3>
                    <form action="includes/login_process.php" method="POST">
                        <div class="mb-3">
                            <label for="uname" class="form-label">Username</label>
                            <input type="text" class="form-control" id="uname" name="uname" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-input">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <span class="eye-icon" onclick="togglePasswordVisibility()">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                        </div>
                        <input type="submit" name="login" value="Login" class="btn btn-primary w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

<!-- Toastr CSS CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous">

<!-- Toastr JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>


<script>
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.querySelector(".eye-icon i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
  }
</script>

<?php include('includes/footer.php'); ?>
