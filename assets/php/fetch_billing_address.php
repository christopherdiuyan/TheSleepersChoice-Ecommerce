<?php
session_start();
require_once('../../includes/db.php');

$customerID = $_SESSION['user_uni_no'];
$stmt = $connect->query("SELECT * FROM customers WHERE customer_u_id = '". $customerID ."'");
$row = $stmt->fetch();

$output = <<<EOT
	<h3>Billing Address</h3>    
    <address>
        <p><strong>Customer Name: {$row['customer_name']}</strong></p>
        <p>Province: {$row['customer_province']}</p>
        <p>Address: {$row['customer_address']}</p>
        <p>Mobile: {$row['customer_contact']}</p>
    </address> 
EOT;

$data = array(
	'billing_details'		=>	$output
);	

echo json_encode($data);


?>
