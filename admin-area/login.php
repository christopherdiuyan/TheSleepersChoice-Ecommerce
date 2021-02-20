<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<?php include_once("includes/stylesheet.php"); ?>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Login Page Start -->
        <div class="m-account-w" data-bg-img="assets/img/account/img3.jpg">
            <div class="m-account">
                <div class="row no-gutters">
                    <div class="col-md-6">
                    </div>

                    <div class="col-md-6">
                        <!-- Login Form Start -->
                        <div class="m-account--form-w">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <img src="assets/img/shapher-logo.png" alt="">
                                </div>
                                <!-- Logo End -->

                                <form action="assets/php/admin_login.php" method="post">
                                    <label class="m-account--title">Login to your account</label>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-envelope"></i>
                                            </div>

                                            <input type="email" name="user-email" placeholder="Email" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" name="user-password"placeholder="Password" class="form-control"  required>
                                            <!--autocomplete="off"-->
                                        </div>
                                    </div>

                                    <div class="m-account--actions">
                                        <a href="forgot-password.php" class="btn-link">Forgot Password?</a>

                                        <button type="submit" name="login" class="btn btn-rounded btn-info">Login</button>
                                    </div>

                                    <div class="m-account--alt">
                                        <p><span>OR LOGIN WITH</span></p>

                                        <div class="btn-list">
                                            <a href="#" class="btn btn-rounded btn-warning">Facebook</a>
                                            <a href="#" class="btn btn-rounded btn-warning">Google</a>
                                        </div>
                                    </div>

                                    <div class="m-account--footer">
                                        <p>&copy; <?php echo date("Y")?> SHAPHER</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Page End -->

<?php include_once("includes/footer.php"); ?>
