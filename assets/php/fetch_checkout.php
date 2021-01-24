<?php
session_start();

$output = '
<div class="your-order-middle">
    <ul>'; 
                                            
if(!empty($_SESSION["shopping_cart"]))
{
	$_SESSION['hasValue'] = 1;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$output .= '
            <li>'.$values["product_name"].'  X  '.$values["product_quantity"].' <span>₱ '.number_format($values["product_price"], 2).' </span></li>
		';
	}
}
else
{
	$_SESSION['hasValue'] = 0;
	$output .= '
        <li>Your Cart is Empty!</li>
    ';
} 
$output .= '</ul>
        </div>';
$data = array(
	'checkout_details'		=>	$output
);	

echo json_encode($data);


?>