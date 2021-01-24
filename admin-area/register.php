<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<?php include_once("includes/stylesheet.php"); ?>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Register Page Start -->
        <div class="m-account-w" data-bg-img="assets/img/account/img3.jpg">
            <div class="m-account">
                <div class="row no-gutters">
                    <div class="col-md-6">
                    </div>

                    <div class="col-md-6">
                        <!-- Register Form Start -->
                        <div class="m-account--form-w">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <img src="assets/img/logo.png" alt="">
                                </div>
                                <!-- Logo End -->

                                <form action="assets/php/admin_login.php" method="post">
                                    <label class="m-account--title">Create your account</label>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <input type="text" name="username" placeholder="Username" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-envelope"></i>
                                            </div>

                                            <input type="email" name="email" placeholder="Email" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="form-check">
                                            <input type="checkbox" name="checkbox" value="1" class="form-check-input">
                                            <span class="form-check-label">I agree all statements in <a href="#">terms of service</a></span>
                                        </label>
                                    </div>

                                    <div class="m-account--actions">
                                        <button type="submit" name="register" class="btn btn-block btn-rounded btn-info">Register</button>
                                    </div>

                                    <div class="m-account--footer">
                                        <p>&copy; 2018 ThemeLooks</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Register Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Register Page End -->

<?php include_once("includes/footer.php"); ?>
