<?php 
// Check for the error query parameter
if (isset($_SESSION['signin_error'])) {
  $errorMessage = $_SESSION['signin_error']; // "Credential not valid. Please try again.";
  unset($_SESSION['signin_error']);
}
?>
<section class="ftco-section contact-section">
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-md-6 ftco-animate">
            <?php if (!empty($errorMessage)) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $errorMessage; ?></div>
                <?php endif; ?>
              <h1 class="mb-3 mt-5 bread text-center">Sign In</h1>
             
              <form action="signin" method="post">
              <!-- <input type="hidden" name="user" > -->
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div>
                <div class="form-group text-center">
                  <input type="submit" value="Sign In" class="btn btn-primary py-3 px-5">
                </div>
                <p class="text-center">Don't have an account? <a href="signup">Sign up</a></p>
              </form>
            </div>
          </div>
        </div>
      </section>

      <script>
	  var currentPage = document.getElementById("signin");
	  currentPage.classList.add("active");
	  </script>