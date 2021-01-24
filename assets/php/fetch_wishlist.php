<?php
session_start();

$output = '
<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Until Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Add To Cart</th>
        </tr>
    </thead>
    <tbody>';
if(!empty($_SESSION["shopping_wishlist"]))
{
    $_SESSION['hasItem'] = 1;
    foreach($_SESSION["shopping_wishlist"] as $keys => $values)
    {
        $output .= '
        <tr>
            <input type="hidden" name="hidden_name" id="img'. $values["product_id"] .'" value="'. $values["product_img"] .'" />
            <input type="hidden" name="hidden_name" id="name'. $values["product_id"] .'" value="'. $values["product_name"] .'" />
            <input type="hidden" name="hidden_price" id="price'. $values["product_id"] .'" value="'. $values["product_price"] .'" />
            <input type="hidden" name="qty" id="quantity'. $values["product_id"] .'" value="'.$values["product_quantity"].'">
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
            <td class="product-wishlist-cart">
                <a href="javascript:void(0)" class="add_wishlist_to_cart" id="'. $values["product_id"].'">add to cart</a>
            </td>
        </tr>
        ';
    }
}
else
{
    $_SESSION['hasItem'] = 0;
    $output .= '
        <tr><td colspan=6><h5>Your Wishlist is Empty!<br><a href="shop.php"> Click here proceed to shopping</a>.</h5></td></tr>
    ';
} 
$output .= '</tbody>
        </table>';
$data = array(
    'wishlist_details'      =>  $output);  

echo json_encode($data);

?>

