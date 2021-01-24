<?php

//fetch_cart.php

session_start();

$total_price = 0;
$total_item = 0;

$output = '
<div class="shopping-cart-top">
	    <h4>Shoping Cart</h4>
	    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
	</div>
	<ul>
';
if(!empty($_SESSION["shopping_cart"]))
{
	$_SESSION["hasValue"] = 1;
	$_SESSION["total_item"] = 1;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$output .= '
		<li class="single-shopping-cart">
            <div class="shopping-cart-img">
                <a href="product-details.php?prodID='. $values["product_id"].'"><img alt="'.$values["product_name"].'" src="'.$values["product_img"].'"></a>
                <div class="item-close">
                    <a href="javascript:void(0)" class="delete" id="'. $values["product_id"].'"><i class="sli sli-close"></i></a>
                </div>
            </div>
            <div class="shopping-cart-title">
                <h4><a href="product-details.php?prodID='. $values["product_id"].'">'.$values["product_name"].'</a></h4>
                <span>'.$values["product_quantity"].' x ₱'.number_format($values["product_price"], 2).'</span>
            </div>
        </li>
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;
	}

}
else
{
	$_SESSION["hasValue"] = 0;
	$_SESSION["total_item"] = 0;
	$output .= '
    	<p>Your Cart is Empty!</p>
    ';
}
$output .= '
	</ul>
	<div class="shopping-cart-bottom">
	    <div class="shopping-cart-total">
	        <h4>Total : <span class="shop-total">₱ '.number_format($total_price, 2).'</span></h4>
	    </div>
	    <div class="shopping-cart-btn btn-hover text-center">
	        <a class="default-btn" href="checkout.php">checkout</a>
	        <a class="default-btn" href="cart-page.php">view cart</a>
	    </div>
	</div>
';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	'₱' . number_format($total_price, 2),
	'total_item'		=>	$total_item
);	

echo json_encode($data);


?>