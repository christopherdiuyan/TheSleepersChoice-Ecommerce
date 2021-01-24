<?php
session_start();
require_once('../../includes/db.php');

$customerID = $_SESSION['user_uni_no'];
$stmt = $connect->query("SELECT * FROM customers WHERE customer_u_id = '". $customerID ."'");
$row = $stmt->fetch();

$output = <<<EOT
	<div class="single-input-item">
        <label for="display-name" class="required">Display Name</label>
        <input type="text" id="display-name" value="{$row['customer_name']}" required/>
    </div>    
    <div class="single-input-item">
        <label for="email" class="required">Email Addres</label>
        <input type="email" id="email" value="{$row['customer_email']}" required/>
    </div>    
    <fieldset>
        <legend>Password change</legend>
        <div class="single-input-item">
            <label for="current-pwd" class="required">Current Password</label>
            <input type="password" id="current-pwd" required/>
        </div>   
        <div class="row">
            <div class="col-lg-6">
                <div class="single-input-item">
                    <label for="new-pwd" class="required">New Password</label>
                    <input type="password" id="new-pwd" required/>
                </div>
            </div>    
            <div class="col-lg-6">
                <div class="single-input-item">
                    <label for="confirm-pwd" class="required">Confirm Password</label>
                    <input type="password" id="confirm-pwd" required/>
                </div>
            </div>
        </div>
    </fieldset>
EOT;

$data = array(
	'account_details'		=>	$output
);	

echo json_encode($data);


?>
