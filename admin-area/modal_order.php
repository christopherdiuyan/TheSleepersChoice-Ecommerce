<style type="text/css">
    .invoice--order .table > thead > tr > th {
        padding: .5rem;
    }
    .invoice--order .table > tbody > tr > td {
        padding: .5rem;
    }
</style>
<?php 
require_once('includes/db.php');
require_once('assets/php/config.php');

if(isset($_POST['orderID'])){

$orderID = $_POST['orderID'];
$groupedQuery = "
    SELECT *, SUM(prod_subtotal) as prod_subtotal FROM customer_orders WHERE order_id = '$orderID ' GROUP BY order_id ORDER BY order_date DESC
";
$statement = $connect->query($groupedQuery);
$groupRow = $statement->fetch();

$query = "
SELECT * FROM customer_orders WHERE order_id = '$orderID '
";
$statement = $connect->query($query);
$row = $statement->fetch();

$stmt = $connect->query("SELECT * FROM customers WHERE customer_u_id = '". $row['customer_id'] ."'");
$c_row = $stmt->fetch();

$total_amount = number_format($groupRow["prod_subtotal"], 2);
$date = date_create($row["order_date"]);
$order_date = date_format($date,"F d, Y");

//new query
$stmt = $connect->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

?>
<div class="panel">
    <!-- View Order Start -->
    <div class="records--body">
        <div class="title">
            <h6 class="h6">Invoice #<?php echo $orderID?><span class="text-lightergray"> - <?php echo $order_date ?></span></h6>
        </div>

        <!-- Tabs Nav Start -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#tab01" data-toggle="tab" class="nav-link active">Overview</a>
            </li>
            <li class="nav-item">
                <a href="#tab02" data-toggle="tab" class="nav-link">Order Details</a>
            </li>
        </ul>
        <!-- Tabs Nav End -->

        <!-- Tab Content Start -->
        <div class="tab-content">
            <!-- Tab Pane Start -->
            <div class="tab-pane fade show active" id="tab01">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="subtitle">Order Information</h4>

                        <table class="table table-simple">
                            <tbody>
                                <tr>
                                    <td>Customer Name:</td>
                                    <th><a href="#" class="btn-link"><?php echo $c_row['customer_name'] ?></a></th>
                                </tr>
                                <tr>
                                    <td>Invoice Number:</td>
                                    <th>#<?php echo $row['order_id'] ?></th>
                                </tr>
                                <tr>
                                    <td>Order Date:</td>
                                    <th><?php echo $order_date ?></th>
                                </tr>
                                <tr>
                                    <td>Total Amount:</td>
                                    <th>₱<?php echo $total_amount ?></th>
                                </tr>
                                <tr>
                                    <td>Payment Method:</td>
                                    <th><?php echo $row['mode_of_payment'] ?></th>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <th>
                                        <select name="select" id="prodCat" class="form-control">
                                            <option><?php echo $row["order_status"] ?></option>
                                            <?php 
                                            $stat = array("Order Placed", "Order Processing", "Ready for Pickup", "Completed");

                                            switch ($row["order_status"]) {
                                                case 'Completed':
                                                    $stat = array("Completed");
                                                    break;
                                                case 'Ready for Pickup':
                                                    $stat = array( "Ready for Pickup", "Completed");
                                                    break;
                                                case 'Order Processing':
                                                    $stat = array("Order Processing", "Ready for Pickup", "Completed");
                                                    break;
                                                default:
                                                    $stat = array("Order Placed", "Order Processing", "Ready for Pickup", "Completed");
                                                    break;
                                            }

                                            foreach ($stat as $key) {
                                                if($key != $row["order_status"]){
                                                    echo "<option>$key</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row md-6">
                <button class="btn btn-block btn-info">Save Changes</button>
            </div>
            </div>
            <!-- Tab Pane End -->

            <!-- Tab Pane Start -->
            <div class="tab-pane fade" id="tab02">
                <div class="row">
                    <h4 class="col-md-12 subtitle">Other Information</h4>
                    <div class="invoice--order">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
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

                                            $output = <<<EOT
                                            <tr>
                                                <td>#{$row["prod_id"]}</td>
                                                <td>{$rowProd["product_title"]}</td>
                                                <td>{$row["prod_qty"]}</td>
                                                <td>₱{$prodPrice}</td>
                                                <td>₱{$total_price}</td>
                                            </tr>
                                            EOT;
                                            echo $output;
                                        }
                                    ?>
                                <tr>
                                    <td colspan="4"><strong>Subtotal</strong></td>
                                    <td>₱<?php echo $total_amount?></td>
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
                                    <td><strong>₱<?php echo $total_amount?></strong></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
            <!-- Tab Pane End -->
        </div>
        <!-- Tab Content End -->
    </div>
    <!-- View Order End -->
</div>
<?php
}
?>