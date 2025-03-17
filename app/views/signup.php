<<<<<<< HEAD
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['message'])):
?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['message']; ?>
    </div>
<?php
    unset($_SESSION['message']);
endif;

if (isset($_SESSION['error'])):
?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error']; ?>
    </div>
<?php
    unset($_SESSION['error']);
endif;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>signup form</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../public/assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css"
    />
    <link rel="stylesheet" href="assets/css/style-sign-in-up.css" />
  </head>
  <body>
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" action="process-signup" id="register-form">
                        <div class="form-group">
                            <label for="merchant_email"><i class="zmdi zmdi-email"></i></label>
                            <input
                            type="email"
                            name="merchant_email"
                            id="merchant_email"
                            class="input-text"
                            required
                            pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}"
                            placeholder="Merchant Email"
                            required
                          />
                        </div>
                        <div class="form-group form-password-toogle">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term"  required/>
                            <label for="agree-term" class="label-agree-term" required><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="assets/img/customer-pay-card.png" alt="sing up image"></figure>
                    <a href="login" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>


    <script>
        setTimeout(() => {
          let alertBox = document.querySelector(".alert");
          if (alertBox) {
            alertBox.style.transition = "opacity 0.5s";
            alertBox.style.opacity = "0";
            setTimeout(() => alertBox.remove(), 500);
          }
        }, 3000); // Auto-close after 3 seconds
      </script>
      
  </body>
</html>
=======
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['message'])):
?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['message']; ?>
    </div>
<?php
    unset($_SESSION['message']);
endif;

if (isset($_SESSION['error'])):
?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error']; ?>
    </div>
<?php
    unset($_SESSION['error']);
endif;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>signup form</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../public/assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css"
    />
    <link rel="stylesheet" href="assets/css/style-sign-in-up.css" />
  </head>
  <body>
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" action="process-signup" id="register-form">
                        <div class="form-group">
                            <label for="merchant_email"><i class="zmdi zmdi-email"></i></label>
                            <input
                            type="email"
                            name="merchant_email"
                            id="merchant_email"
                            class="input-text"
                            required
                            pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}"
                            placeholder="Merchant Email"
                            required
                          />
                        </div>
                        <div class="form-group form-password-toogle">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term"  required/>
                            <label for="agree-term" class="label-agree-term" required><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="assets/img/customer-pay-card.png" alt="sing up image"></figure>
                    <a href="login" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>


    <script>
        setTimeout(() => {
          let alertBox = document.querySelector(".alert");
          if (alertBox) {
            alertBox.style.transition = "opacity 0.5s";
            alertBox.style.opacity = "0";
            setTimeout(() => alertBox.remove(), 500);
          }
        }, 3000); // Auto-close after 3 seconds
      </script>
      
  </body>
</html>
>>>>>>> cb2db00 (Initial commit)
