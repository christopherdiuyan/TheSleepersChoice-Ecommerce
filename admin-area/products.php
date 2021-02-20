<?php
    session_start(); //start session
    require_once("includes/db.php");
    require_once("assets/php/config.php");

    if(!isset($_SESSION['admin_id'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else
    {
        include_once("includes/header.php");

        $stmt = $connect->query("SELECT COUNT(sku) as total FROM products");
        $row = $stmt->fetch();
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
                            <li class="active open">
                                <a href="#">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span>Products</span>
                                </a>
                                <ul>
                                    <li class="active"><a href="products.php">Products</a></li>
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
                            <li class="">
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
                            <h2 class="page--title h5">Products</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active"><span>Products</span></li>
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
                            <h3 class="h3">Products <a href="javascript:void(0)" class="btn btn-sm btn-outline-info">Manage Products</a></h3>
                            <p>Found Total <?php echo $row['total']?> Products</p>
                        </div>

                        <div class="actions">
                            <form action="#" class="search flex-wrap flex-md-nowrap">
                                <input type="text" class="form-control" placeholder="Product Name..." required>
                                <select name="select" class="form-control">
                                    <?php
                                    $query = "SELECT * FROM product_categories ORDER BY p_cat_title"; 
                                    $statement = $connect->prepare($query);
                                    $statement->execute();
                                    $result = $statement->fetchAll();

                                    foreach($result as $row) 
                                    { 
                                    ?>
                                        <option><?php echo $row['p_cat_title']; ?></option>
                                    
                                    <?php } ?>
                                </select>
                                <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                            </form>

                            <a href="javascript:void(0)" data-toggle="modal" class="addProduct btn btn-lg btn-rounded btn-warning">Add Product</a>
                        </div>
                    </div>
                    <!-- Records Header End -->
                </div>

                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Product Listing">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th class="not-sortable">Image</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stocks</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th class="not-sortable">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "
                                SELECT * FROM products
                                    ";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                foreach($result as $row)
                                {
                                    $prodImg =  file_exists(Config::$productFilepath . $row['product_img1']) ? Config::$productFilepath . $row['product_img1'] : Config::$productFilepath . Config::$defaultProdImg ;
                                    $price = number_format($row["product_price"], 2);
                                    
                                    switch ($row["product_status"]) {
                                        case '1':
                                            if($row["product_stocks"] < 6){
                                                $color = "warning";
                                                $status = "Out of Stocks";
                                            }
                                            else
                                            {
                                                $color = "success";
                                                $status = "Published";
                                            }
                                            break;
                                        case '0':
                                            $color = "danger";
                                            $status = "Not Published";
                                            break;
                                    
                                    }
                                ?>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal" id="<?php echo $row['sku'] ?>" class="btn-link editProduct">#<?php echo $row['sku'] ?></a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal" id="<?php echo $row['sku'] ?>" class="btn-link editProduct">
                                            <img src="<?php echo $prodImg ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal" id="<?php echo $row['sku'] ?>" class="btn-link editProduct"><?php echo $row['product_title'] ?></a>
                                    </td>
                                    <td><?php echo $row['product_category'] ?></td>
                                    <td>₱<?php echo $price ?></td>
                                    <td><?php echo $row['product_stocks'] ?></td>
                                    <td><span class="text-red"><?php echo $row['product_discount'] > 0 ? "-" : ""?><?php echo $row['product_discount'] ?>% OFF</span></td>
                                    <td>
                                        <span class="label label-<?php echo $color ?>"><?php echo $status ?></span>
                                    </td>
                                    <td>
                                        <div class="dropleft">
                                            <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                                            <div class="dropdown-menu">
                                                <a href="javascript:void(0)" class="dropdown-item editProduct" data-toggle="modal" id="<?php echo $row['sku'] ?>">Update</a>
                                                <a href="javascript:void(0)" class="dropdown-item deleteProduct" id="<?php echo $row['sku']?>">Remove</a>
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
                <p>Copyright &copy; <?php echo date('Y') ?> <a href="index.php">SHAPHER</a>. All Rights Reserved.</p>
            </footer>
            <!-- Main Footer End -->
        </main>
        <!-- Main Container End -->

        <!-- Vertically Centered Modal Start -->
    <div id="editProduct" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" id="modal-edit-product">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
            <!-- Vertically Centered Modal Start -->
    <div id="addProduct" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" id="modal-add-product">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
<?php } ?>
<?php include_once("includes/footer.php"); ?>
