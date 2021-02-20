<?php 
include_once("includes/header.php"); 

if(isset($_SESSION['user_uni_no']))
{
    $customerID = $_SESSION['user_uni_no'];
    $stmt = $connect->query("SELECT * FROM customers WHERE customer_u_id = '". $customerID ."'");
    $row = $stmt->fetch();
    $customerName = $row['customer_name'];
    $customerProvince = $row['customer_province'];
    $customerAddress = $row['customer_address'];
    $customerContact = $row['customer_contact'];
    $customerEmail = $row['customer_email'];
}
else
{
    $customerID = 0;
    $customerEmail = $customerContact = $customerAddress = $customerProvince = $customerName = "";

}

?>

    <div class="breadcrumb-area pt-35 pb-35 bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">Checkout </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- compare main wrapper start -->
    <div class="checkout-main-area pt-70 pb-70">
        <div class="container">

            <?php  if(!isset($_SESSION['user_uni_no'])){ ?>
            <div class="customer-zone mb-20">
                <p class="cart-page-title">Returning customer? <a class="checkout-click1" href="#">Click here to login</a></p>
                <div class="checkout-login-info">
                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.</p>
                    <form action="assets/php/customer_login-register.php"  method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="sin-checkout-login">
                                    <label>Email address <span>*</span></label>
                                    <input type="text" name="user-email" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="sin-checkout-login">
                                    <label>Passwords <span>*</span></label>
                                    <input type="password" name="user-password">
                                </div>
                            </div>
                        </div>
                        <div class="button-remember-wrap">
                            <button class="button" type="submit" name="login">Login</button>
                            <div class="checkout-login-toggle-btn">
                                <input type="checkbox">
                                <label>Remember me</label>
                            </div>
                        </div>
                        <div class="lost-password">
                            <a href="#">Lost your password?</a>
                        </div>
                    </form>
                    <div class="checkout-login-social">
                        <span>Login with:</span>
                        <ul>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Google</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="customer-zone mb-20">
                <p class="cart-page-title">Have a coupon? <a class="checkout-click3" href="#">Click here to enter your code</a></p>
                <div class="checkout-login-info3">
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <input type="submit" value="Apply Coupon">
                    </form>
                </div>
            </div>
            <div class="checkout-wrap pt-30">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap mr-50">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20">
                                        <label>Complete Name <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" placeholder="First Name Middle Initial Surname" value="<?php echo $customerName?>">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-select mb-20">
                                        <label>Province <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" placeholder="Province" list="provinces" id="provices" value="<?php echo $customerProvince?>">
                                        <datalist id="provinces">
                                            <option>Abra</option>
                                            <option>Agusan del Norte</option>
                                            <option>Agusan del Sur</option>
                                            <option>Aklan</option>
                                            <option>Albay</option>
                                            <option>Antique</option>
                                            <option>Apayao</option>
                                            <option>Aurora</option>
                                            <option>Basilan</option>
                                            <option>Bataan</option>
                                            <option>Batanes</option>
                                            <option>Batangas</option>
                                            <option>Benguet</option>
                                            <option>Biliran</option>
                                            <option>Bohol</option>
                                            <option>Bukidnon</option>
                                            <option>Bulacan</option>
                                            <option>Cagayan</option>
                                            <option>Camarines Norte</option>
                                            <option>Camarines Sur</option>
                                            <option>Camiguin</option>
                                            <option>Capiz</option>
                                            <option>Catanduanes</option>
                                            <option>Cavite</option>
                                            <option>Cebu</option>
                                            <option>Cotabato</option>
                                            <option>Davao de Oro</option>
                                            <option>Davao del Norte</option>
                                            <option>Davao del Sur</option>
                                            <option>Davao Occidental</option>
                                            <option>Davao Oriental</option>
                                            <option>Dinagat Islands</option>
                                            <option>Eastern Samar</option>
                                            <option>Guimaras</option>
                                            <option>Ifugao</option>
                                            <option>Ilocos Norte</option>
                                            <option>Ilocos Sur</option>
                                            <option>Iloilo</option>
                                            <option>Isabela</option>
                                            <option>Kalinga</option>
                                            <option>La Union</option>
                                            <option>Laguna</option>
                                            <option>Lanao del Norte</option>
                                            <option>Lanao del Sur</option>
                                            <option>Leyte</option>
                                            <option>Maguindanao</option>
                                            <option>Marinduque</option>
                                            <option>Masbate</option>
                                            <option>Metro Manila</option>
                                            <option>Misamis Occidental</option>
                                            <option>Misamis Oriental</option>
                                            <option>Mountain Province</option>
                                            <option>Negros Occidental</option>
                                            <option>Negros Oriental</option>
                                            <option>Northern Samar</option>
                                            <option>Nueva Ecija</option>
                                            <option>Nueva Vizcaya</option>
                                            <option>Occidental Mindoro</option>
                                            <option>Oriental Mindoro</option>
                                            <option>Palawan</option>
                                            <option>Pampanga</option>
                                            <option>Pangasinan</option>
                                            <option>Quezon</option>
                                            <option>Quirino</option>
                                            <option>Rizal</option>
                                            <option>Romblon</option>
                                            <option>Samar</option>
                                            <option>Sarangani</option>
                                            <option>Siquijor</option>
                                            <option>Sorsogon</option>
                                            <option>South Cotabato</option>
                                            <option>Southern Leyte</option>
                                            <option>Sultan Kudarat</option>
                                            <option>Sulu</option>
                                            <option>Surigao del Norte</option>
                                            <option>Surigao del Sur</option>
                                            <option>Tarlac</option>
                                            <option>Tawi-Tawi</option>
                                            <option>Zambales</option>
                                            <option>Zamboanga del Norte</option>
                                            <option>Zamboanga del Sur</option>
                                            <option>Zamboanga Sibugay</option>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20">
                                        <label>City/Municipality, House Number, Building and Street Name <abbr class="required" title="required">*</abbr></label>
                                        <input class="billing-address" placeholder="City/Municipality, House number and street name" type="text" value="<?php echo $customerAddress ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20">
                                        <label>Phone <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" value="<?php echo $customerContact?>" >
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20">
                                        <label>Email Address <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" value="<?php echo $customerEmail?>">
                                    </div>
                                </div>
                            </div>
                            <div class="additional-info-wrap">
                                <label>Order notes</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. " id="order-notes" name="message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3>Your order</h3>
                             <form action="POST" id="form-billing-info">
                                <input type="hidden" name="" id="hasValue" value="<?php echo $_SESSION['hasValue'] ?>">
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-info-wrap">
                                        <div class="your-order-info">
                                            <ul>
                                                <li>Product <span>Total</span></li>
                                            </ul>
                                        </div>
                                        <span id="checkout_details"></span>
                                        <div class="your-order-info order-subtotal">
                                            <ul>
                                                <li>Subtotal <span class="total-price">₱0.00</span></li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-shipping">
                                            <ul>
                                                <li>Shipping <p>Enter your full address to see shipping <br>costs. </p></li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-total">
                                            <ul>
                                                <li>Total <span class="total-price">₱0.00 </span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <input type="hidden" name="customerID" id="customerID" value="<?php echo $customerID ?>">
                                        <input type="hidden" id="total-amount" value="<?php echo $_SESSION['total_amount']?>">
                                        <div class="pay-top sin-payment">
                                            <input id="payment-method-3" class="input-radio" type="radio" checked value="Cash on delivery" name="payment_method">
                                            <label for="payment-method-3">Cash on delivery </label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                                <div class="Place-order mt-40">
                                                    <a href="javascript:void(0)" class="place-order-COD">Place Order</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pay-top sin-payment">
                                            <input id="payment-method-4" class="input-radio" type="radio" value="PayPal" name="payment_method">
                                            <label for="payment-method-4">PayPal <img alt="" src="assets/img/icon-img/payment.png"></label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                                <div id="smart-button-container">
                                                    <input type="hidden" id="hasCustomer" value="<?php echo $customerID?>">
                                                    <div style="text-align: center;">
                                                        <div id="place-order"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- compare main wrapper end -->
<?php include_once("includes/footer.php"); ?>
