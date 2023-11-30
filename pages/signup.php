<?php 
// Check for the error query parameter
if (isset($_SESSION['signup_error'])) {
  $errorMessage = $_SESSION['signup_error']; 
  unset($_SESSION['signup_error']);
}
?>

<section class="ftco-section contact-section">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 ftco-animate">
            <?php if (!empty($errorMessage)) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $errorMessage; ?></div>
                <?php endif; ?>
                <h1 class="mb-3 mt-5 bread text-center">Sign Up</h1>
                <form action="signup" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username" maxlength="250" >
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" maxlength="250" minlength="8" >
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="confirmPassword" maxlength="250" minlength="8">
                        <span id="passwordError" class="text-danger"></span>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Sign Up" class="btn btn-primary py-3 px-5">
                    </div>
                    <p class="text-center">Already have an account? <a href="signin">Sign in</a></p>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        var passwordError = document.getElementById("passwordError");

        if (password !== confirmPassword) {
            passwordError.textContent = "Passwords do not match.";
            return false; // Prevent form submission
        } else {
            passwordError.textContent = ""; // Clear the error message
            return true; // Allow form submission
        }
    }
</script>