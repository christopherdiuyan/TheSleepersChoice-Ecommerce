<?php include_once("includes/header.php"); ?>
    <link rel="stylesheet" href="custom.css">
    <div id="notification-area" style="z-index: 9999">
    </div>
    <div class="breadcrumb-area pt-35 pb-35 bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">wishlist </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <h3 class="cart-page-title">Your Wishlist items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            <span class="wishlist_details"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
<?php include_once("includes/footer.php"); ?>