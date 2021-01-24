<?php
session_start();

$total_price = 0;
$total_item = 0;

$output = '
<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Until Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>';
if(!empty($_SESSION["shopping_cart"]))
{
    $_SESSION['hasItem'] = 1;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$output .= '
		  <tr>
            <td class="product-thumbnail">
                <a href="product-details.php?prodID='. $values["product_id"].'"><img alt="'.$values["product_name"].'" src="'.$values["product_img"].'" width="138" height="138"></a>
            </td>
            <td class="product-name"><a href="product-details.php?prodID='. $values["product_id"].'">'.$values["product_name"].'</a></td>
            <td class="product-price-cart"><span class="amount">₱ '.number_format($values["product_price"], 2).'</span></td>
            <td class="product-quantity">
                <div class="cart-plus-minus">
                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="'.$values["product_quantity"].'" readonly>
                </div>
            </td>
            <td class="product-subtotal">₱ '.number_format(($values["product_quantity"] * $values["product_price"]), 2).'</td>
            <td class="product-remove">
                <a href="javascript:void(0)" class="delete" id="'. $values["product_id"].'"><i class="sli sli-close"></i></a>
           </td>
        </tr>
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
	}
}
else
{
	$_SESSION['hasItem'] = 0;
	$output .= '
    	<tr><td colspan=6><h5>Your Cart is Empty!<br><a href="shop.php"> Click here proceed to shopping</a>.</h5></td></tr>
    ';
} 
$_SESSION['total_amount'] = $total_price;
$output .= '</tbody>
		</table>';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	'₱' . number_format($total_price, 2)
);	

echo json_encode($data);


?>