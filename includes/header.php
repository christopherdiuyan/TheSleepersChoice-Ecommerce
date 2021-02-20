<?php 
session_start(); //start session
require_once("includes/db.php");
include_once("functions/functions.php");
require_once('assets/php/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sleepwear For All Ages | Online Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/logo.png">
    
    <!-- CSS ============================================ -->
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/icons.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- jQuery JS -->
	<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- New JS -->
  	
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style404.css">
    <script>(function(w, d) { w.CollectId = "600da43cf5130668a3113f97"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
</head>
<body>
<div class="breadcrumb-area text-center pt-20 wrapper-notif">
    <h6><strong>FREE SHIPPING</strong> FOR ORDERS <strong>₱5,000</strong> ABOVE</h6>
</div>
<div class="wrapper">
	<header class="header-area sticky-bar">
	    <div class="main-header-wrap">
	        <div class="container">
	            <div class="row">
	                <div class="col-xl-2 col-lg-2">
	                    <div class="logo pt-40">
	                        <a href="index.php">
	                            <img src="assets/img/logo/sleepers0choice-logo.jpg" width="176 px" height="80 px" style="margin-top: -25px" alt="Shapher">
	                        </a>
	                    </div>
	                </div>

	                <div class="col-xl-6 col-lg-7 ">
	                    <div class="main-menu">
	                        <nav>
	                            <ul>
	                                <li class="angle-shape"><a href="index.php">Home </a></li>
	                                <li class="angle-shape"><a href="shop.php"> Shop <span>new</span> </a></li>
	                                <li class="angle-shape"><a href="about-us.php">About <i class="sli sli-arrow-down"></i></a>
	                                	<ul class="submenu">
	                                        <li><a href="about-us.php">About Us </a></li>
	                                        <li><a href="contact-us.php">Contact Us</a></li>
	                                    </ul>
	                                </li>
	                            </ul>
	                        </nav>
	                    </div>
	                </div>
                     <?php $size = isset($_SESSION['user_uni_no']) ? "4" : "2"; ?>
	                <div class="col-xl-<?php echo $size ?> col-lg-3">
	                    <div class="header-right-wrap pt-40">
	                        <div class="header-search">
	                            <a class="search-active" href="javascript:void(0)"><i class="sli sli-magnifier"></i></a>
	                        </div>
	                        
                            <div class="cart-wrap">
	                            <button class="icon-cart-active wishlist-icon" onclick="location.href = 'wishlist.php';">
	                                <span class="icon-cart">
	                                    <i class="sli sli-heart"></i>
	                                    <span class="wishlist-count-style">0
	                                    </span>
	                                </span>
	                            </button>
	                        </div>
	                        
	                        <div class="cart-wrap">
	                           
	                            <button class="icon-cart-active">
	                                <span class="icon-cart">
	                                    <i class="sli sli-bag"></i>
	                                    <span class="count-style">0
	                                    </span>
	                                </span>
	                                <span class="cart-price">
	                                    ₱ 0.00
	                                </span>
	                            </button>
	                            <div class="shopping-cart-content">
	                            	<span class="cart_details"></span>
	                                
	                            </div>
	                        </div>
                            <?php if(isset($_SESSION['user_uni_no'])) { ?>
                            <div class="setting-wrap">
                                <button class="setting-active">
                                    <i class="sli sli-settings"></i>
                                </button>
                                <div class="setting-content">
                                    <ul>
                                        <li>
                                            <h4>Account</h4>
                                            <ul>
                                                <li><a href="my-account.php">My Account</a></li>
                                                <li><a href="cart-page.php">Cart Page </a></li>
                                                <li><a href="checkout.php">Checkout </a></li>
                                                <li><a href="logout.php">Logout</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div> 
                            <?php } ?>
	                    </div>
	                </div>
                    
                    <?php if(!isset($_SESSION['user_uni_no'])) { ?>
                    <div class="col-xl-2 col-lg-2">
	                   <div class="login-btn btn-hover text-center">
                	        <a class="default-btn" href="login-register.php">Login/Register</a>
                	    </div>
	                </div>
                    <?php } ?>
	            </div>
	        </div>
	        <!-- main-search start -->
	        <div class="main-search-active">
	            <div class="sidebar-search-icon">
	                <button class="search-close"><span class="sli sli-close"></span></button>
	            </div>
	            <div class="sidebar-search-input">
	                <form>
	                    <div class="form-search">
	                        <input id="search" class="input-text" value="" placeholder="Search Now" type="search">
	                        <button>
	                            <i class="sli sli-magnifier"></i>
	                        </button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <div class="header-small-mobile">
	        <div class="container">
	            <div class="row align-items-center">
	                <div class="col-6">
	                    <div class="mobile-logo">
	                        <a href="index.php">
	                            <img alt="" src="assets/img/logo/sleepers0choice-logo.jpg" width="280px" height="100px">
	                        </a>
	                    </div>
	                </div>
	                <div class="col-6">
	                    <div class="header-right-wrap">
                          <div class="cart-wrap">
	                            <button class="icon-cart-active wishlist-icon" onclick="location.href = 'wishlist.php';">
	                                <span class="icon-cart">
	                                    <i class="sli sli-heart"></i>
	                                    <span class="wishlist-count-style">0
	                                    </span>
	                                </span>
	                            </button>
	                        </div>
	                        <div class="cart-wrap">
	                            <button class="icon-cart-active">
	                                <span class="icon-cart">
	                                    <i class="sli sli-bag"></i>
	                                    <span class="count-style">0
	                                    </span>
	                                </span>
	                                <span class="cart-price">
	                                    ₱ 0.00
	                                </span>
	                            </button>
	                            <div class="shopping-cart-content" class="popover_content_wrapper" >
	                            	<span class="cart_details"></span>
	                                
	                            </div>
	                        </div>
	                        <div class="mobile-off-canvas">
	                            <a class="mobile-aside-button" href="javascript:void(0)"><i class="sli sli-menu"></i></a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>
	
	<div class="mobile-off-canvas-active">
        <a class="mobile-aside-close"><i class="sli sli-close"></i></a>
        <div class="header-mobile-aside-wrap">
            <div class="mobile-search">
                <form class="search-form" action="#">
                    <input type="text" placeholder="Search entire store…">
                    <button class="button-search"><i class="sli sli-magnifier"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap">
                <!-- mobile menu start -->
                <div class="mobile-navigation">
                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="shop.php">shop</a></li>
                            <li class="menu-item-has-children "><a href="about-us.php">About </a>
                            	<ul class="dropdown">
                                    <li><a href="about-us.php">About Us </a></li>
                                    <li><a href="contact-us.php">Contact Us</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-curr-lang-wrap">
                <div class="single-mobile-curr-lang">
                    <a class="mobile-account-active" href="javascript:void(0)">My Account <i class="sli sli-arrow-down"></i></a>
                    <div class="lang-curr-dropdown account-dropdown-active">
                        <ul>
                            <?php if(!isset($_SESSION['user_uni_no'])) { ?>
                            <li><a href="login-register.php">Login/Register</a></li>
                            <?php } else { ?>
                            <li><a href="my-account.php">My Account</a></li>
                            <li><a href="cart-page.php">Cart Page </a></li>
                            <li><a href="checkout.php">Checkout </a></li>
                            <li><a href="logout.php">Logout</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-social-wrap">
                <a class="facebook" href="#"><i class="sli sli-social-facebook"></i></a>
                <a class="twitter" href="#"><i class="sli sli-social-twitter"></i></a>
                <a class="pinterest" href="#"><i class="sli sli-social-pinterest"></i></a>
                <a class="instagram" href="#"><i class="sli sli-social-instagram"></i></a>
                <a class="google" href="#"><i class="sli sli-social-google"></i></a>
            </div>
        </div>
    </div>
