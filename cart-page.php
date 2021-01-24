<?php include_once("includes/header.php"); ?>
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            <span class="viewcart_details"></span>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="shop.php">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <input type="hidden" name="" id="hasItem" value="<?php echo $_SESSION['hasItem'] ?>">
                                        <a href="javascript:void(0)" id="clear_cart">Clear Shopping Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                   <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4> 
                                </div>
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <form>
                                        <input type="text" required="" name="name">
                                        <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Total products <span class="total-price">₱0.00</span></h5>
                                <div class="total-shipping">
                                    <h5>Total shipping</h5>
                                    <ul>
                                        <li><input type="checkbox"> Standard <span>₱20.00</span></li>
                                        <li><input type="checkbox"> Express <span>₱30.00</span></li>
                                    </ul>
                                </div>
                                <h4 class="grand-totall-title">Grand Total  <span class="total-price">₱0.00</span></h4>
                                <a href="checkout.php">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once("includes/footer.php"); ?>