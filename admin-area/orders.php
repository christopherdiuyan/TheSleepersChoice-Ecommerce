<?php
    session_start(); //start session
    require_once("includes/db.php");
    require_once("assets/php/config.php");

    if(!isset($_SESSION['admin_id'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else
    {
        include_once("includes/header.php");
        $query = "SELECT order_id FROM customer_orders GROUP BY order_id";
        $statement = $connect->prepare($query);
        $statement->execute();
        $total_row = $statement->rowCount();
?>
        <!-- Sidebar Start -->
        <aside class="sidebar" data-trigger="scrollbar">
            <!-- Sidebar Navigation Start -->
            <div class="sidebar--nav">
                <ul>
                    <li>
                        <a href="#">Your Store</a>
                        <ul>
                            <li class=""><a href="index.php"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span>Products</span>
                                </a>
                                <ul>
                                    <li class=""><a href="products.php">Products</a></li>
                                </ul>
                                <ul>
                                    <li class=""><a href="categories.php">Product Categories</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="customers.php">
                                    <i class="fa fa-fw fa-users"></i>
                                    <span>Customers</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="orders.php">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="inquiries.php">
                                    <i class="fa fa-comments"></i>
                                    <span>Inquiries</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="#">Your Website</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    <span>Pages</span>
                                </a>

                                <ul>
                                    <li><a href="page-home.php">Home</a></li>
                                    <li><a href="profile.php">Shop</a></li>
                                    <li><a href="invoice.php">About</a></li>
                                    <li><a href="login.php">Contact Us</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                     <li>
                        <a href="javascript:void(0)">Reports</a>
                        <ul>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-file"></i>
                                    <span>Reports</span>
                                </a>

                                <ul>
                                    <li ><a href="report_stocks.php">Stocks Report</a></li>
                                    <li ><a href="report_customers.php">Customers</a></li>
                                    <li ><a href="report_orders.php">Customer Orders</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Configuration</a>

                        <ul>
                            <li class="">
                                <a href="users.php">
                                    <i class="fa fa-fw fa-users"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="settings.php">
                                    <i class="fa fa-cogs"></i>
                                    <span>General Settings</span>
                                </a>
                            </li>
                        </ul>   
                    </li>
                </ul>
            </div>
            <!-- Sidebar Navigation End -->
        </aside>
        <!-- Sidebar End -->

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Page Header Start -->
            <section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Orders</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active"><span>Orders</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Page Header End -->

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records Header Start -->
                    <div class="records--header">
                        <div class="title fa-shopping-bag">
                            <h3 class="h3">Customer Orders <a href="#" class="btn btn-sm btn-outline-info">Manage Orders</a></h3>
                            <p>Found Total <?php echo $total_row?> Orders</p>
                        </div>

                        <div class="actions">
                            <form action="#" class="search">
                                <input type="text" class="form-control" placeholder="Order ID or Customer Name..." required>
                                <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Records Header End -->
                </div>

                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Orders Listing">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Invoice No</th>
                                    <th>Purchased On</th>
                                    <th>Customer Name</th>
                                    <th>Customer Address</th>
                                    <th>Total Price</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = "
                                    SELECT *, SUM(prod_subtotal) as prod_subtotal FROM customer_orders GROUP BY order_id ORDER BY order_date DESC
                                ";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                $x = 1;
                                foreach($result as $row)
                                {
                                    $stmt = $connect->query("SELECT * FROM customers WHERE customer_u_id = '". $row['customer_id'] ."'");
                                    $c_row = $stmt->fetch();

                                    $total_amount = number_format($row["prod_subtotal"], 2);
                                    $date = date_create($row["order_date"]);
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
                                ?>
                                <tr>
                                    <td><?php echo $x++ ?></td>
                                    <td>
                                        <a href="javascript:void(0)"  data-toggle="modal" id="<?php echo $row['order_id'] ?>" class="btn-link editOrder">#<?php echo $row['order_id'] ?></a>
                                    </td>
                                    <td><?php echo $order_date ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn-link viewCustomer" data-toggle="modal" id="<?php echo $c_row['customer_u_id'] ?>"><?php echo $c_row['customer_name'] ?></a>
                                    </td>
                                    <td><?php echo $c_row['customer_province'] ." ".$c_row['customer_address'] ?></td>
                                    <td>₱<?php echo $total_amount ?></td>
                                    <td><?php echo $row['mode_of_payment'] ?></td>
                                    <td>
                                        <span class="label label-<?php echo $color ?>"><?php echo $row["order_status"] ?></span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-info btn-sm editOrder" data-toggle="modal" id="<?php echo $row['order_id'] ?>">Update</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <footer class="main--footer main--footer-light">
                <p>Copyright &copy; <?php echo date('Y') ?> <a href="index.php">SHAPHER</a>. All Rights Reserved.</p>
            </footer>
            <!-- Main Footer End -->
        </main>
        <!-- Main Container End -->

<?php } ?>
<?php include_once("includes/footer.php"); ?>
