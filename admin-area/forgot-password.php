<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<?php include_once("includes/stylesheet.php"); ?>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Forgot Password Page Start -->
        <div class="m-account-w" data-bg-img="assets/img/account/img3.jpg">
            <div class="m-account">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <!-- Forgot Password Content Start -->
                        <div class="m-account--content-w" data-bg-img="assets/img/account/content-bg.jpg">
                            <div class="m-account--content">
                                <h2 class="h2">Have an account?</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a href="login.php" class="btn btn-rounded">Login Now</a>
                            </div>
                        </div>
                        <!-- Forgot Password Content End -->
                    </div>

                    <div class="col-md-6">
                        <!-- Forgot Password Form Start -->
                        <div class="m-account--form-w">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <img src="assets/img/logo.png" alt="">
                                </div>
                                <!-- Logo End -->

                                <form action="#" method="post">
                                    <label class="m-account--title">Forgot Password?</label>

                                    <p class="m-account--subtitle">Don't worry, we'll send you an email to reset your password.</p>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-envelope"></i>
                                            </div>

                                            <input type="email" name="email" placeholder="Email" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group pt-3">
                                        <p>Don't remember your email? <a href="#">Contact Support</a></p>
                                    </div>

                                    <div class="m-account--actions">
                                        <button type="submit" class="btn btn-block btn-rounded btn-info">Reset Password</button>
                                    </div>

                                    <div class="m-account--footer">
                                        <p>&copy; <?php echo date("Y")?> SHAPHER</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Forgot Password Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Forgot Password Page End -->

<?php include_once("includes/footer.php"); ?>
