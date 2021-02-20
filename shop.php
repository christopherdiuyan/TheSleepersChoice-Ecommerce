<?php
include_once("includes/header.php");
include_once("includes/db.php");

$stmt = $connect->query("SELECT COUNT(sku) as total FROM products");
$row = $stmt->fetch();
?>
    <div class="breadcrumb-area pt-35 pb-35 bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">Shop </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">

                    <div class="shop-top-bar">
                        <div class="select-shoing-wrap">
                            <div class="shop-select">
                                <select>
                                    <option value="">Sort by newness</option>
                                    <option value="">A to Z</option>
                                    <option value=""> Z to A</option>
                                </select>
                            </div>
                            <p id="total-prod-items">Showing 1–6 of <?php echo $row['total']?> result</p>
                        </div>
                        <div class="shop-tab nav">
                            <a class="active" href="#shop-grid" data-toggle="tab">
                                <i class="sli sli-grid"></i>
                            </a>
                            <a href="#shop-list" data-toggle="tab">
                                <i class="sli sli-menu"></i>
                            </a>
                        </div>
                    </div>
                    <link rel="stylesheet" href="custom.css"> 
                    <div id="notification-area" style="z-index: 9999">
                    </div>
                    <div class="shop-bottom-area mt-35">
                        <div class="tab-content jump">

                            <div id="shop-grid" class="tab-pane active">
                                <div class="row ht-products" id="shop-products">
                                    
                                </div>
                            </div>

                            <div id="shop-list" class="tab-pane">
                                <div class="row ht-products" id="shop-products-list">
                                   
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <!-- Sidebar -->
                <?php include_once("includes/sidebar.php"); ?>

            </div>
        </div>
    </div>
    
    <?php include_once("includes/footer.php"); ?>
