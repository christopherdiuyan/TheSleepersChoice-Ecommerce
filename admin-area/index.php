<?php
session_start(); //start session
require_once("assets/php/config.php");
require_once("includes/db.php");

$query = "SELECT * FROM customers";
$statement = $connect->prepare($query);
$statement->execute();
$total_customers = $statement->rowCount();

$query = "SELECT * FROM inquiry WHERE email_status = 'Answered'";
$statement = $connect->prepare($query);
$statement->execute();
$total_inquiry = $statement->rowCount();

$query = "SELECT * FROM customer_orders";
$statement = $connect->prepare($query);
$statement->execute();
$total_solds = $statement->rowCount();

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
                        <a href="javascript:void(0)">Your Store</a>
                        <ul>
                            <li class="active"><a href="index.php"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                            <li class="">
                                <a href="javascript:void(0)">
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
                            <li class="">
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
                            <h2 class="page--title h5">SHAPHER Dashboard</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active"><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Page Header End -->

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="row gutter-20">
                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel text-white bg-blue">
                                <div class="miniStats--header" data-overlay="0.1">
                                    <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#fff">5,6,9,4,9,5,3,5,9,15,3,2,2,3,9,11,9,7,20,9,7,6</p>

                                    <p class="miniStats--label text-blue bg-white">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>10%</span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-user text-white"></i>

                                    <p class="miniStats--caption">Monthly</p>
                                    <h3 class="miniStats--title h4 text-white">New Users</h3>
                                    <p class="miniStats--num"><?php echo $total_customers?></p>
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel text-white bg-orange">
                                <div class="miniStats--header" data-overlay="0.1">
                                    <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#fff">2,2,3,9,11,9,7,20,9,7,6,5,6,9,4,9,5,3,5,9,15,3</p>

                                    <p class="miniStats--label text-orange bg-white">
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>10%</span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-white"></i>

                                    <p class="miniStats--caption">Monthly</p>
                                    <h3 class="miniStats--title h4 text-white">Tickets Answered</h3>
                                    <p class="miniStats--num"><?php echo $total_inquiry ?></p>
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel text-white bg-green">
                                <div class="miniStats--header" data-overlay="0.1">
                                    <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#fff">2,2,3,9,11,9,7,20,9,7,6,5,6,9,4,9,5,3,5,9,15,3</p>

                                    <p class="miniStats--label text-green bg-white">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>10%</span>
                                    </p>
                                </div>

                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-white"></i>

                                    <p class="miniStats--caption">Monthly</p>
                                    <h3 class="miniStats--title h4 text-white">Item Solds</h3>
                                    <p class="miniStats--num"><?php echo $total_solds ?></p>
                                </div>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Product Sales</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                        <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                        <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-chart">
                                <!-- Morris Area Chart 03 Start -->
                                <div id="morrisAreaChart03" class="chart--body area--chart style--2"></div>
                                <!-- Morris Area Chart 03 End -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Market Trends</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#">This Week</a></li>
                                        <li><a href="#">Last Week</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-chart">
                                <!-- Morris Area Chart 02 Start -->
                                <div id="morrisAreaChart02" class="chart--body area--chart style--1"></div>
                                <!-- Morris Area Chart 02 End -->

                                <div class="chart--stats style--2">
                                    <ul class="nav">
                                        <li>
                                            <p class="amount">₱56,700</p>
                                            <p data-overlay="1 blue"><span class="label">TOTAL EQUITY</span></p>
                                        </li>
                                        <li>
                                            <p class="amount">₱4,000</p>
                                            <p data-overlay="1 red"><span class="label">TOTAL DEBT</span></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Sales Progress</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#">This Week</a></li>
                                        <li><a href="#">Last Week</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-chart">
                                <!-- Morris Line Chart 01 Start -->
                                <div id="morrisLineChart01" class="chart--body line--chart style--1"></div>
                                <!-- Morris Line Chart 01 End -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Monthly Traffic</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                        <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                        <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-chart">
                                <!-- Morris Line Chart 02 Start -->
                                <div id="morrisLineChart02" class="chart--body line--chart style--2"></div>
                                <!-- Morris Line Chart 02 End -->

                                <div class="chart--stats style--3">
                                    <ul class="nav">
                                        <li>
                                            <p data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#2bb3c0">0,5,9,7,12,15,12,5</p>
                                            
                                            <p><span class="label">Total Visitors</span></p>
                                            <p class="amount">12</p>
                                        </li>
                                        <li>
                                            <p data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">0,15,12,5,5,9,7,12</p>
                                            
                                            <p><span class="label">Total Sales</span></p>
                                            <p class="amount">21</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Total Overdue</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                        <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                        <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-chart">
                                <div class="chart--title text-blue">
                                    <h2 class="h2">₱14,200,000</h2>
                                </div>

                                <!-- Morris Line Chart 03 Start -->
                                <div id="morrisLineChart03" class="chart--body line--chart style--3"></div>
                                <!-- Morris Line Chart 03 End -->

                                <div class="chart--action">
                                    <a href="#" class="btn-link">Export PDF <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-9">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <select name="filter" data-trigger="selectmenu" data-minimum-results-for-search="-1">
                                        <option value="top-search">Recent Orders</option>
                                        <option value="average-search">Latest Orders</option>
                                    </select>
                                </h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                        <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                        <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table style--2">
                                        <thead>
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Product ID</th>
                                                <th>Customer Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Invoice No.</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query = "
                                                SELECT * FROM customer_orders WHERE order_status != 'Completed' ORDER BY order_date DESC LIMIT 3 
                                            ";
                                            $statement = $connect->prepare($query);
                                            $statement->execute();
                                            $result = $statement->fetchAll();
                                            $x = 1;
                                            foreach($result as $row)
                                            {
                                                $stmt = $connect->query("SELECT * FROM products WHERE sku = '". $row['prod_id'] ."'");
                                                $p_row = $stmt->fetch();
                                                $prodImg =  file_exists(Config::$productFilepath . $p_row['product_img1']) ? Config::$productFilepath . $p_row['product_img1'] : Config::$productFilepath . Config::$defaultProdImg ;
                                                $price = number_format($p_row["product_price"], 2);

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
                                            <!-- Table Row Start -->
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal" id="<?php echo $p_row['sku'] ?>" class="btn-link editProduct">
                                                        <img src="<?php echo $prodImg ?>" alt="<?php echo $p_row['product_title']?>" style="max-width: 80px">
                                                    </a>
                                                </td>
                                                <td>#<?php echo $p_row['sku'] ?></td>
                                                <td><a href="javascript:void(0)" class="btn-link viewCustomer" data-toggle="modal" id="<?php echo $c_row['customer_u_id'] ?>"><?php echo $c_row['customer_name'] ?></a></td>
                                                <td>₱<?php echo $price?></td>
                                                <td><?php echo $row["prod_qty"]?></td>
                                                <td><span class="text-muted">#<?php echo $row["order_id"] ?></span></td>
                                                <td><span class="label label-<?php echo $color ?>"><?php echo $row["order_status"] ?></span></td>
                                            </tr>
                                            <!-- Table Row End -->
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">To-Do List</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                        <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="todo--panel">
                                <form action="#">
                                    <ul class="list-group" data-trigger="scrollbar">
                                        <li class="list-group-item">
                                            <label class="todo--label">
                                                <input type="checkbox" name="todo_id" value="1" class="todo--input" checked>
                                                <span class="todo--text">Schedule Meeting</span>
                                            </label>

                                            <a href="#" class="todo--remove">&times;</a>
                                        </li>
                                        <li class="list-group-item">
                                            <label class="todo--label">
                                                <input type="checkbox" name="todo_id" value="2" class="todo--input">
                                                <span class="todo--text">Call Clients To Follow-Up</span>
                                            </label>

                                            <a href="#" class="todo--remove">&times;</a>
                                        </li>
                                        <li class="list-group-item">
                                            <label class="todo--label">
                                                <input type="checkbox" name="todo_id" value="3" class="todo--input" checked>
                                                <span class="todo--text">Book Flight For Holiday</span>
                                            </label>

                                            <a href="#" class="todo--remove">&times;</a>
                                        </li>
                                        <li class="list-group-item">
                                            <label class="todo--label">
                                                <input type="checkbox" name="todo_id" value="4" class="todo--input">
                                                <span class="todo--text">Forward Important Tasks</span>
                                            </label>

                                            <a href="#" class="todo--remove">&times;</a>
                                        </li>
                                        <li class="list-group-item">
                                            <label class="todo--label">
                                                <input type="checkbox" name="todo_id" value="6" class="todo--input">
                                                <span class="todo--text">Important Tasks</span>
                                            </label>

                                            <a href="#" class="todo--remove">&times;</a>
                                        </li>
                                    </ul>

                                    <div class="input-group">
                                        <input type="text" name="todo" placeholder="Add New Task" class="form-control" autocomplete="off" required>

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn-link">+</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Overall Rating</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                        <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                        <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-chart">
                                <div class="chart--body line--chart style--4" data-trigger="sparklineChart01">10,15,15,20,18,20,18,22</div>

                                <div class="chart--stats style--4">
                                    <ul class="nav">
                                        <li>
                                            <span class="text">The product is awesome</span>
                                            <span class="stat">20%</span>
                                        </li>
                                        <li>
                                            <span class="text">I am so pleased</span>
                                            <span class="stat">40%</span>
                                        </li>
                                        <li>
                                            <span class="text">The product is really good</span>
                                            <span class="stat">20%</span>
                                        </li>
                                        <li>
                                            <span class="text">The product is awesome</span>
                                            <span class="stat">60%</span>
                                        </li>
                                        <li>
                                            <span class="text">I am so surprised</span>
                                            <span class="stat">20%</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Events Timeline</h3>

                                <div class="dropdown">
                                    <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                        <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                        <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="cd-horizontal-timeline">
                                    <div class="timeline">
                                        <div class="events-wrapper">
                                            <div class="events">
                                                <ol>
                                                    <li><a href="#0" data-date="10/11/2014" class="older-event">Meeting</a></li>
                                                    <li><a href="#0" data-date="16/11/2014" class="selected">New Project</a></li>
                                                    <li><a href="#0" data-date="06/12/2014">Party</a></li>
                                                    <li><a href="#0" data-date="06/01/2015">Dinner</a></li>
                                                </ol>

                                                <span class="filling-line"></span>
                                            </div>
                                        </div>

                                        <ul class="cd-timeline-navigation">
                                            <li><a href="#0" class="prev inactive"><i class="fa fa-angle-left"></i></a></li>
                                            <li><a href="#0" class="next"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>

                                    <div class="events-content">
                                        <ol>
                                            <li data-date="10/11/2014">
                                                <div class="title">
                                                    <h2 class="h4">Meeting</h2>
                                                </div>

                                                <div class="subtitle">
                                                    <p>10 November 2014, 7:45 PM</p>
                                                </div>

                                                <div class="desc">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure maiores nulla aspernatur. Nemo doloremque a deserunt quas, sunt, voluptate inventore iure? Deserunt sit omnis quas eligendi, nulla architecto alias officia.</p>
                                                </div>
                                            </li>

                                            <li data-date="16/11/2014" class="selected">
                                                <div class="title">
                                                    <h2 class="h4">New Project Lauched</h2>
                                                </div>

                                                <div class="subtitle">
                                                    <p>16 November 2014, 7:45 PM</p>
                                                </div>

                                                <div class="desc">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure maiores nulla aspernatur. Nemo doloremque a deserunt quas, sunt, voluptate inventore iure? Deserunt sit omnis quas eligendi, nulla architecto alias officia.</p>
                                                </div>
                                            </li>
                                            
                                            <li data-date="06/12/2014">
                                                <div class="title">
                                                    <h2 class="h4">Party</h2>
                                                </div>

                                                <div class="subtitle">
                                                    <p>06 December 2014, 7:45 PM</p>
                                                </div>

                                                <div class="desc">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure maiores nulla aspernatur. Nemo doloremque a deserunt quas, sunt, voluptate inventore iure? Deserunt sit omnis quas eligendi, nulla architecto alias officia.</p>
                                                </div>
                                            </li>
                                            
                                            <li data-date="06/01/2015">
                                                <div class="title">
                                                    <h2 class="h4">Dinner</h2>
                                                </div>

                                                <div class="subtitle">
                                                    <p>06 January 2015, 7:45 PM</p>
                                                </div>

                                                <div class="desc">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure maiores nulla aspernatur. Nemo doloremque a deserunt quas, sunt, voluptate inventore iure? Deserunt sit omnis quas eligendi, nulla architecto alias officia.</p>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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