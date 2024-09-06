<?php include('includes/header.php'); ?>

<div class="container" style="max-width: 30rem;">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center fw-bold">SIGN UP</h3>
                    <form action="includes/signup_process.php" method="POST" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-input">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <span class="eye-icon" onclick="togglePasswordVisibility1()">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <div class="password-input">
                                <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
                                <span class="eye-icon" onclick="togglePasswordVisibility2()">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <p>Already have an account? <a href="login.php">Login</a></p>
                        </div>
                        <input type="submit" name="signup" value="Signup" class="btn btn-primary w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JQuery and Toastr JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Handle Toastr messages -->
<script>
<?php
if (isset($_SESSION['flash_message'])) {
    $type = $_SESSION['flash_message']['type'];
    $message = $_SESSION['flash_message']['message'];
    echo "toastr.$type('$message');";
    unset($_SESSION['flash_message']); // Clear flash message after use
}
?>
</script>

<script>
function togglePasswordVisibility1() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.querySelector("#password + .eye-icon i");

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

function togglePasswordVisibility2() {
    const passwordInput = document.getElementById("confirm-password");
    const eyeIcon = document.querySelector("#confirm-password + .eye-icon i");

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

function validateForm() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    if (password !== confirmPassword) {
        toastr.error('Passwords do not match!');
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}
</script>

<?php include('includes/footer.php'); ?>
