<?php 
session_start(); //start session
include("includes/db.php");
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
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
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons.png">
    
    <!-- CSS
    ============================================ -->
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/icons.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- jQuery JS -->
	<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- New JS -->
    <script>
$(document).ready(function(){	
		$(".form-item").submit(function(e){
			var form_data = $(this).serialize();
			// var button_content = $(this).find('button[type=submit]');
			// button_content.html('Adding...'); //Loading button text 

			$.ajax({ //make ajax request to cart_process.php
				url: "cart_process.php",
				type: "POST",
				dataType:"json", //expect json value from server
				data: form_data
			}).done(function(data){ //on Ajax success
				$("#cart-info").html(data.items); //total items in cart-info element
				button_content.html('Add to Cart'); //reset button text to original text
				alert("Item added to Cart!"); //alert user
				if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
					$(".cart-box").trigger( "click" ); //trigger click to update the cart box.
				}
			})
			e.preventDefault();
		});
	
	//Remove items from cart
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
		e.preventDefault(); 
		var pcode = $(this).attr("data-code"); //get product code
		$(this).parent().fadeOut(); //remove item element from box
		$.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
			$("#cart-info").html(data.items); //update Item count in cart-info
			$(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
		});
	});

});
</script>

<style type="text/css">
	.link {padding: 10px 15px;background: transparent;border:#bccfd8 1px solid;border-left:0px;cursor:pointer;color:#607d8b}
.disabled {cursor:not-allowed;color: #bccfd8;}
.current {background: #bccfd8;}
.first{border-left:#bccfd8 1px solid;}
.question {font-weight:bold;}
.answer{padding-top: 10px;}
#pagination{margin-top: 20px;padding-top: 30px;border-top: #F0F0F0 1px solid;}
.dot {padding: 10px 15px;background: transparent;border-right: #bccfd8 1px solid;}
.page-content {padding: 20px;margin: 0 auto;}
	#overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: fixed;left: 0;top: 0;width: 100%;height: 100%;display: none;}
#overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
</style>
</head>
<body>
<div class="wrapper">
	<header class="header-area sticky-bar">
	    <div class="main-header-wrap">
	        <div class="container">
	            <div class="row">
	                <div class="col-xl-2 col-lg-2">
	                    <div class="logo pt-40">
	                        <a href="index.php">
	                            <img src="assets/img/logo/company-logo-2.svg" alt="">
	                        </a>
	                    </div>
	                </div>

	                <div class="col-xl-7 col-lg-7 ">
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

	                <div class="col-xl-3 col-lg-3">
	                    <div class="header-right-wrap pt-40">
	                        <div class="header-search">
	                            <a class="search-active" href="#"><i class="sli sli-magnifier"></i></a>
	                        </div>
	                        <div class="cart-wrap">
	                            <button class="icon-cart-active">
	                                <span class="icon-cart">
	                                    <i class="sli sli-bag"></i>
	                                    <span class="count-style">
	                                    	<?php 
											if(isset($_SESSION["products"])){
												echo count($_SESSION["products"]); 
											}else{
												echo 0; 
											}
											?>
	                                    </span>
	                                </span>
	                                <span class="cart-price">
	                                    $320.00
	                                </span>
	                            </button>
	                            <div class="shopping-cart-content">
	                                <div class="shopping-cart-top">
	                                    <h4>Shoping Cart</h4>
	                                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
	                                </div>
	                                <!-- Shopping Cart -->
<!-- <?php
if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
$total 			= 0;
$list_tax 		= '';
$cart_box 		= '<ul>';

foreach($_SESSION["products"] as $product){ //Print each item, quantity and price.
$product_name = $product["product_name"];
$product_qty = $product["product_quantity"];
$product_price = $product["product_price"];
$product_code = $product["product_id"];
$product_img = $product["product_image"];
// $product_color = $product["product_color"];
// $product_size = $product["product_size"];

$item_price 	= sprintf("%01.2f",($product_price * $product_qty));  // price x qty = total item price

$cart_box 		.=  "
<li> $product_code &ndash;  $product_name (Qty : $product_qty | $product_color | $product_size) <span> $currency. $item_price </span></li>
<li class=\"single-shopping-cart\">
<div class=\"shopping-cart-img\">
    <a href=\"#\"><img alt=\"\" src=\"assets/img/cart/cart-1.svg\"></a>
    <div class=\"item-close\">
        <a href=\"#\"><i class=\"sli sli-close\"></i></a>
    </div>
</div>
<div class=\"shopping-cart-title\">
    <h4><a href=\"#\">$product_name </a></h4>
    <span>$product_qty". " x " ."$product_price | $item_price</span>
</div>
</li>
";

$subtotal 		= ($product_price * $product_qty); //Multiply item quantity * price
$total 			= ($total + $subtotal); //Add up to total price
}

$grand_total = $total + $shipping_cost; //grand total

foreach($taxes as $key => $value){ //list and calculate all taxes in array
$tax_amount 	= round($total * ($value / 100));
$tax_item[$key] = $tax_amount;
$grand_total 	= $grand_total + $tax_amount; 
}

foreach($tax_item as $key => $value){ //taxes List
$list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
}

$shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';

//Print Shipping, VAT and Total
$cart_box .= "<li class=\"view-cart-total\">$shipping_cost  $list_tax <hr>Payable Amount : $currency ".sprintf("%01.2f", $grand_total)."</li>";
$cart_box .= "</ul>";

echo $cart_box;
}else{
echo "Your Cart is empty";
}
?> -->
	                                <!-- <ul>
	                                    <li class="single-shopping-cart">
	                                        <div class="shopping-cart-img">
	                                            <a href="#"><img alt="" src="assets/img/cart/cart-1.svg"></a>
	                                            <div class="item-close">
	                                                <a href="#"><i class="sli sli-close"></i></a>
	                                            </div>
	                                        </div>
	                                        <div class="shopping-cart-title">
	                                            <h4><a href="#">Product Name </a></h4>
	                                            <span>1 x 90.00</span>
	                                        </div>
	                                    </li>
	                                    <li class="single-shopping-cart">
	                                        <div class="shopping-cart-img">
	                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"></a>
	                                            <div class="item-close">
	                                                <a href="#"><i class="sli sli-close"></i></a>
	                                            </div>
	                                        </div>
	                                        <div class="shopping-cart-title">
	                                            <h4><a href="#">Product Name</a></h4>
	                                            <span>1 x 90.00</span>
	                                        </div>
	                                    </li>
	                                    <li class="single-shopping-cart">
	                                        <div class="shopping-cart-img">
	                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"></a>
	                                            <div class="item-close">
	                                                <a href="#"><i class="sli sli-close"></i></a>
	                                            </div>
	                                        </div>
	                                        <div class="shopping-cart-title">
	                                            <h4><a href="#">Product Name</a></h4>
	                                            <span>1 x 90.00</span>
	                                        </div>
	                                    </li>
	                                    <li class="single-shopping-cart">
	                                        <div class="shopping-cart-img">
	                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"></a>
	                                            <div class="item-close">
	                                                <a href="#"><i class="sli sli-close"></i></a>
	                                            </div>
	                                        </div>
	                                        <div class="shopping-cart-title">
	                                            <h4><a href="#">Product Name</a></h4>
	                                            <span>1 x 90.00</span>
	                                        </div>
	                                    </li>
	                                    <li class="single-shopping-cart">
	                                        <div class="shopping-cart-img">
	                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"></a>
	                                            <div class="item-close">
	                                                <a href="#"><i class="sli sli-close"></i></a>
	                                            </div>
	                                        </div>
	                                        <div class="shopping-cart-title">
	                                            <h4><a href="#">Product asdName</a></h4>
	                                            <span>1 x 90.00</span>
	                                        </div>
	                                    </li>
	                                </ul> -->


	                                <div class="shopping-cart-bottom">
	                                    <div class="shopping-cart-total">
	                                        <h4>Total : <span class="shop-total">$260.00</span></h4>
	                                    </div>
	                                    <div class="shopping-cart-btn btn-hover text-center">
	                                        <a class="default-btn" href="checkout.php">checkout</a>
	                                        <a class="default-btn" href="cart-page.php">view cart</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

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
		                                        <li><a href="compare-page.php">Compare </a></li>
		                                        <li><a href="wishlist.php">Wishlist </a></li>
	                                            <li><a href="login-register.php">Login/Register</a></li>
	                                        </ul>
	                                    </li>
	                                </ul>
	                            </div>
	                        </div> 
	                    </div>
	                </div>

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
	                            <img alt="" src="assets/img/logo/logo.png">
	                        </a>
	                    </div>
	                </div>
	                <div class="col-6">
	                    <div class="header-right-wrap">
	                        <div class="cart-wrap">
	                            <button class="icon-cart-active">
	                                <span class="icon-cart">
	                                    <i class="sli sli-bag"></i>
	                                    <span class="count-style">02</span>
	                                </span>
	                                <span class="cart-price">
	                                    $320.00
	                                </span>
	                            </button>
	                            <div class="shopping-cart-content">
	                                <div class="shopping-cart-top">
	                                    <h4>Shoping Cart</h4>
	                                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
	                                </div>
	                                <ul>
	                                    <li class="single-shopping-cart">
	                                        <div class="shopping-cart-img">
	                                            <a href="#"><img alt="" src="assets/img/cart/cart-1.svg"></a>
	                                        </div>
	                                        <div class="shopping-cart-title">
	                                            <h4><a href="#">Product Name </a></h4>
	                                            <span>1 x 90.00</span>
	                                        </div>
	                                    </li>
	                                    <li class="single-shopping-cart">
	                                        <div class="shopping-cart-img">
	                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"></a>
	                                        </div>
	                                        <div class="shopping-cart-title">
	                                            <h4><a href="#">Product Name</a></h4>
	                                            <span>1 x 90.00</span>
	                                        </div>
	                                    </li>
	                                </ul>
	                                <div class="shopping-cart-bottom">
	                                    <div class="shopping-cart-total">
	                                        <h4>Total : <span class="shop-total">$260.00</span></h4>
	                                    </div>
	                                    <div class="shopping-cart-btn btn-hover text-center">
	                                        <a class="default-btn" href="checkout.php">checkout</a>
	                                        <a class="default-btn" href="cart-page.php">view cart</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="mobile-off-canvas">
	                            <a class="mobile-aside-button" href="#"><i class="sli sli-menu"></i></a>
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
                    <a class="mobile-account-active" href="my-account.php">My Account <i class="sli sli-arrow-down"></i></a>
                    <div class="lang-curr-dropdown account-dropdown-active">
                        <ul>
                            <li><a href="cart-page.php">Cart Page </a></li>
                            <li><a href="checkout.php">Checkout </a></li>
                            <li><a href="compare-page.php">Compare </a></li>
                            <li><a href="wishlist.php">Wishlist </a></li>
                            <li><a href="login-register.php">Login/Register</a></li>
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
