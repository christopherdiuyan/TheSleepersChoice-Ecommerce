<?php 
session_start();
require_once('includes/db.php');
require_once('assets/php/config.php');
?>
<style type="text/css">
    .sinvoice--order {
        max-height: 340px;
    }
</style>
<?php

if(isset($_POST['orderID'])){

$customerID = $_SESSION['user_uni_no'];
$stmt = $connect->query("SELECT * FROM customers WHERE customer_u_id = '". $customerID ."'");
$row = $stmt->fetch();
$customer_name = $row['customer_name'];
$customer_province = $row['customer_province'];
$customer_address = $row['customer_address'];
$customer_contact = $row['customer_contact'];

$invoiceNo = $_POST['orderID'];
$query = "SELECT * FROM customer_orders WHERE order_id = '". $invoiceNo ."'";
$stmt = $connect->query($query);
$row = $stmt->fetch();

$groupedQuery = "
    SELECT *, SUM(prod_subtotal) as prod_subtotal FROM customer_orders WHERE order_id = '$invoiceNo ' GROUP BY order_id ORDER BY order_date DESC
";
$statement = $connect->query($groupedQuery);
$groupRow = $statement->fetch();

$sku = $row['prod_id'];
$prod_subtotal = $groupRow["prod_subtotal"];
$date = date_create($row["order_date"]);
$order_date = date_format($date,"F d, Y");
$mode_of_payment = $row['mode_of_payment'];

//new query
$stmt = $connect->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

}
?>
<link rel="stylesheet" href="custom.css">
<!-- Invoice Start -->
<div class="invoice">
    <div class="invoice--header">
        <div class="invoice--logo">
            <img src="assets/img/logo/logo.png" width="190" height="92" alt="">
        </div>

        <div class="invoice--address">
            <h5 class="h5">Address</h5>
            <p><?php echo Config::$companyAddress?></p>
            <p>Phone: <?php echo Config::$companyContact?></p>
        </div>
    </div>

    <div class="invoice--billing">
        <div class="invoice--address">
            <h3 class="h3"><span>To:</span></h3>

            <h5 class="h5"><?php echo $customer_name ?></h5>

            <p><?php echo $customer_address?></p>
            <p><?php echo $customer_province?></p>
            <p>Phone: <?php echo $customer_contact?></p>
        </div>

        <div class="invoice--info">
            <h5 class="h5"><span>Invoice:</span> #<?php echo $invoiceNo?></h5>
            <p>Invoice Date: <strong><?php echo $order_date?></strong></p>
            <p><strong>Payment Method:</strong> <?php echo $mode_of_payment?></p>
        </div>
    </div>
    <div class="invoice--order">
        <table class="table">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($result as $row)
                    {
                        $sku = $row["prod_id"];
                        $stmt = $connect->query("SELECT * FROM products WHERE sku = '". $sku ."'");
                        $rowProd = $stmt->fetch();
                        $prodPrice = number_format($rowProd["product_price"], 2);
                        $total_price = number_format(($row["prod_qty"] * $rowProd["product_price"]), 2);

                        $output = '
                        <tr>
                            <td>#'.$row["prod_id"].'</td>
                            <td>'.$rowProd["product_title"].'</td>
                            <td>'.$row["prod_qty"].'</td>
                            <td>₱'.$prodPrice.'</td>
                            <td>₱'.$total_price.'</td>
                        </tr>
                        ';
                        echo $output;
                    }
                ?>
                <tr>
                    <td colspan="4"><strong>Subtotal</strong></td>
                    <td>₱<?php echo number_format($prod_subtotal, 2)?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Shipping</strong></td>
                    <td>₱0.00</td>
                </tr>
                <tr>
                    <td colspan="4"><strong>VAT</strong></td>
                    <td>₱0.00</td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Total</strong></td>
                    <td><strong>₱<?php echo number_format($prod_subtotal, 2)?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="invoice--footer">
        

        <div class="invoice--actions">
            <a href="#" class="btn btn-rounded btn-outline-secondary print-invoice" onclick="window.addEventListener('load', window.print())">Print</a>
        </div>
    </div>
</div>
<!-- Invoice End -->