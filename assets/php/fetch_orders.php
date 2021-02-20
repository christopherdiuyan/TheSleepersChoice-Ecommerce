<?php
session_start();
?>

<?php
require_once('../../includes/db.php');

$customerID = $_SESSION['user_uni_no'];
$query = "
        SELECT *, SUM(prod_subtotal) as prod_subtotal FROM customer_orders WHERE customer_id = '$customerID' GROUP BY order_id ORDER BY order_date DESC
    ";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();

$output = '

<table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>Invoice No.</th>
            <th>Order Date</th>
            <th>Mode of Payment</th>
            <th>Status</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>    
    <tbody>';

if($total_row > 0)
{
    foreach($result as $row)
    {
        $total = number_format($row["prod_subtotal"], 2);
        $date=date_create($row["order_date"]);
        $order_date = date_format($date,"F d, Y");
       
        switch ($row["order_status"]) {
            case 'Completed':
                $color = "success";
                break;
            case 'Ready for Pickup':
                $color = "info";
                break;
            case 'Order Processing':
                $color = "warning";
                break;
            default:
                $color = "danger";
                break;
        }

        $output .= '
            <tr>
                <td>#'. $row["order_id"] .'</td>
                <td>'.$order_date.'</td>
                <td>'.$row["mode_of_payment"].'</td>
                <td><span class="label label-'.$color.'">'.$row["order_status"].'</span></td>
                <td>₱'.$total.'</td>
                <td><a href="javascript:void(0)" data-toggle="modal" data-target="#viewOrderDetails" class="view-orders" id="'.$row["order_id"].'"><i class="fa fa-search"></i><span class="ht-product-action-tooltip"> View</span></a></td>
            </tr>
        ';
    }
}
else
{
	$output .= '
    	<tr><td colspan=6><h5>You have no items here. <a href="shop.php">Click here proceed to shopping</a>.</h5></td></tr>
    ';
} 
$output .= '</tbody>
		</table>';
$data = array(
	'order_details'		=>	$output
);	

echo json_encode($data);

?>

