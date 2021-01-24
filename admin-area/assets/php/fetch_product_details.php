<?php
session_start();
require_once('../../includes/db.php');
require_once('config.php');
$query = "
        SELECT * FROM products
    ";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();

$output = '                      
';

if($total_row > 0)
{
    foreach($result as $row)
    {
        $prodImg =  file_exists(Config::$productFilepath . $row['product_img1']) ? Config::$productFilepath . $row['product_img1'] : Config::$productFilepath . Config::$defaultProdImg ;
        $price = number_format($row["product_price"], 2);
        $date = date_create($row["date"]);
        $date_created = date_format($date,"F d, Y");
        $color = "success";
        $status = "Published";
        switch ($row["product_status"]) {
            case '0':
                $color = "success";
                $status = "Published";
                break;
        
        }

        $output .= <<<EOT
            <tr>
                <td>
                    <a href="#" class="btn-link">#{$row['sku']}</a>
                </td>
                <td>
                    <a href="#" class="btn-link">
                        <img src="{$prodImg}" alt="">
                    </a>
                </td>
                <td>
                    <a href="#" class="btn-link">{$row['sku']}</a>
                </td>
                <td>
                    <a href="#" class="btn-link">{$row['product_category']}</a>
                </td>
                <td>₱{$price}</td>
                <td>{$row['product_stocks']}</td>
                <td>{$date_created}</td>
                <td>
                    <span class="label label-{$color}">{$status}</span>
                </td>
                <td>
                    <div class="dropleft">
                        <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Edit</a>
                            <a href="#" class="dropdown-item">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        EOT;
    }
}
else
{
	$output .= '
    	<tr><td colspan=6><h5>You have no items here. <a href="#">Click here to create a new product.</a>.</h5></td></tr>
    ';
} 
//$output .= '</tbody>';
$data = array(
	'product_details'		=>	$output
);	

echo json_encode($data);

?>
