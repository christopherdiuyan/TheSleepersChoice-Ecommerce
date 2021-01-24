<?php
    session_start(); //start session
    require_once("includes/db.php");
    require_once("assets/php/config.php");

    if(!isset($_SESSION['admin_id'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else
    {
        include_once("includes/header.php");
?>
        <!-- Sidebar Start -->
        <aside class="sidebar" data-trigger="scrollbar">
            <!-- Sidebar Navigation Start -->
            <div class="sidebar--nav">
                <ul>
                    <li>
                        <a href="#">Your Store</a>
                        <ul>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-home"></i>
                                    <span>Dashboard</span>
                                </a>

                                <ul>
                                    <li class=""><a href="index.php">Dashboard</a></li>
                                    
                                </ul>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span>Products</span>
                                </a>
                                <ul>
                                    <li class=""><a href="products.php">Products</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-list"></i>
                                    <span>Categories</span>
                                </a>

                                <ul>
                                    <li class=""><a href="ecommerce.php">Add Category</a></li>
                                    
                                </ul>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-fw fa-users"></i>
                                    <span>Customers</span>
                                </a>

                                <ul>
                                    <li class=""><a href="ecommerce.php">Customer</a></li>
                                    
                                </ul>
                            </li>
                            <li class="active open">
                                <a href="#">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Orders</span>
                                </a>
                                <ul>
                                    <li class="active"><a href="orders.php">Orders</a></li>
                                    <li><a href="order-view.php">Order View</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-comments"></i>
                                    <span>Inquiries</span>
                                </a>

                                <ul>
                                    <li class="active"><a href="ecommerce.php">Inquiries</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Your Website</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    <span>Extra Pages</span>
                                </a>

                                <ul>
                                    <li><a href="pricing-tables.php">Pricing Tables</a></li>
                                    <li><a href="profile.php">Profile</a></li>
                                    <li><a href="invoice.php">Invoice</a></li>
                                    <li><a href="login.php">Login</a></li>
                                    <li><a href="register.php">Register</a></li>
                                    <li><a href="forgot-password.php">Forgot Password</a></li>
                                    <li><a href="lock-screen.php">Lock Screen</a></li>
                                    <li><a href="404.php">404 Error</a></li>
                                    <li><a href="500.php">500 Error</a></li>
                                    <li><a href="maintenance.php">Maintenance</a></li>
                                    <li><a href="coming-soon.php">Coming Soon</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Configuration</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    <span>Extra Pages</span>
                                </a>

                                <ul>
                                    <li><a href="pricing-tables.php">Pricing Tables</a></li>
                                    <li><a href="profile.php">Profile</a></li>
                                    <li><a href="invoice.php">Invoice</a></li>
                                    <li><a href="login.php">Login</a></li>
                                    <li><a href="register.php">Register</a></li>
                                    <li><a href="forgot-password.php">Forgot Password</a></li>
                                    <li><a href="lock-screen.php">Lock Screen</a></li>
                                    <li><a href="404.php">404 Error</a></li>
                                    <li><a href="500.php">500 Error</a></li>
                                    <li><a href="maintenance.php">Maintenance</a></li>
                                    <li><a href="coming-soon.php">Coming Soon</a></li>
                                </ul>
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
                            <p>Found Total 0 Orders</p>
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
                                    <th>Purchesed On</th>
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
                                        <a href="javascript:void(0)" class="dropdown-item editOrder" data-toggle="modal" id="<?php echo $row['order_id'] ?>" class="btn-link">#<?php echo $row['order_id'] ?></a>
                                    </td>
                                    <td><?php echo $order_date ?></td>
                                    <td>
                                        <a href="#" class="btn-link"><?php echo $c_row['customer_name'] ?></a>
                                    </td>
                                    <td><?php echo $c_row['customer_province'] ." ".$c_row['customer_address'] ?></td>
                                    <td>₱<?php echo $total_amount ?></td>
                                    <td><?php echo $row['mode_of_payment'] ?></td>
                                    <td>
                                        <span class="label label-<?php echo $color ?>"><?php echo $row["order_status"] ?></span>
                                    </td>
                                    <td>
                                        <div class="dropleft">
                                            <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                                            <div class="dropdown-menu">
                                                <a href="javascript:void(0)" class="dropdown-item editOrder" data-toggle="modal" id="<?php echo $row['order_id'] ?>">Edit</a>
                                            </div>
                                        </div>
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
                <p>Copyright &copy; <a href="#">DAdmin</a>. All Rights Reserved.</p>
            </footer>
            <!-- Main Footer End -->
        </main>
        <!-- Main Container End -->

           <!-- Vertically Centered Modal Start -->
    <div id="editOrder" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" id="modal-edit-order">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
<?php } ?>
<?php include_once("includes/footer.php"); ?>
