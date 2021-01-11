<?php include_once("includes/header.php"); ?>

    <div class="breadcrumb-area pt-35 pb-35 bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">login / register </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-register-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#login">
                                <h4> login </h4>
                            </a>
                            <a data-toggle="tab" href="#register">
                                <h4> register </h4>
                            </a>
                        </div>  
                        <div class="tab-content">

                            <div id="login" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="assets/php/customer_login-register.php"  method="post">
                                            <input type="email" name="user-email" placeholder="Email">                                                                  
                                            <input type="password" name="user-password" placeholder="Password">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input type="checkbox">
                                                    <label>Remember me</label>
                                                    <a href="#">Forgot Password?</a>
                                                </div>
                                                <button type="submit" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="register" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="assets/php/customer_login-register.php" method="post">
                                            <input type="text" name="user-name" placeholder="Your Name" id="username" required>
                                            <input type="password" name="user-password" placeholder="Password" id="pass" required>
                                            <input type="email" name="user-email" placeholder="Email" required>
                                            <div class="button-box">
                                                <button type="submit" name="register">REGISTER</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="txt1 text-center">
                                        <span> Or Sign Up Using </span>
                                    </div>
                                    <div class="flex-c-m">
                                        <a href="#" class="login100-social-item bg1">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="#" class="login100-social-item bg2">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#" class="login100-social-item bg3">
                                            <i class="fa fa-google"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once("includes/footer.php"); ?>
