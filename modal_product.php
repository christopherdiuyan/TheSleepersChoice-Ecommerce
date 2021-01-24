
<?php 
require_once('includes/db.php');
require_once('assets/php/config.php');
?>

<?php

if(isset($_POST['prodID'])){

$sku = $_POST['prodID'];
$stmt = $connect->query("SELECT * FROM products WHERE product_status = '1' AND sku = '". $sku ."'");
$row = $stmt->fetch();
$prod_name = $row['product_title'];
$prod_desc = $row['product_desc'];
$prod_cat = $row['product_category'];
$selling_price = $row['product_price'] - ($row['product_price'] * ($row['product_discount'] / 100));
$prod_color = $row['product_color'];
$prod_size = $row['product_size'];

$prodImg1 =  file_exists(Config::$productFilepath . $row['product_img1']) ? Config::$productFilepath . $row['product_img1'] : Config::$productFilepath . Config::$defaultProdImg ;
$prodImg2 =  file_exists(Config::$productFilepath . $row['product_img2']) ? Config::$productFilepath . $row['product_img2'] : Config::$productFilepath . Config::$defaultProdImg ;
$prodImg3 =  file_exists(Config::$productFilepath . $row['product_img3']) ? Config::$productFilepath . $row['product_img3'] : Config::$productFilepath . Config::$defaultProdImg ;

$priceOld = $row['product_discount'] > 0 ? "₱ ". number_format($row['product_price'], 2, '.', ',') : "";
}
?>
<link rel="stylesheet" href="custom.css">
<div id="notification-area" style="z-index: 9999">
</div>
<form class="form-item">
    <div class="row">
        <div class="col-md-5 col-sm-12 col-xs-12 ">
            <div class="tab-content quickview-big-img">
                <div id="pro-1" class="tab-pane fade show active">
                    <img src="<?php echo $prodImg1 ?>" alt="<?php echo $prod_name ?>">
                </div>
                <div id="pro-2" class="tab-pane fade">
                    <img src="<?php echo $prodImg2 ?>" alt="<?php echo $prod_name ?>">
                </div>
                <div id="pro-3" class="tab-pane fade">
                    <img src="<?php echo $prodImg3 ?>" alt="<?php echo $prod_name ?>">
                </div>
            </div>
           
            <div class="quickview-wrap mt-15">
                <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                    <a class="active" data-toggle="tab" href="#pro-1"><img src="<?php echo $prodImg1 ?>" alt="<?php echo $prod_name ?>"></a>
                    <a data-toggle="tab" href="#pro-2"><img src="<?php echo $prodImg2 ?>" alt="<?php echo $prod_name ?>"></a>
                    <a data-toggle="tab" href="#pro-3"><img src="<?php echo $prodImg3 ?>" alt="<?php echo $prod_name ?>"></a>
                    <a data-toggle="tab" href="#pro-2"><img src="<?php echo $prodImg2 ?>" alt="<?php echo $prod_name ?>"></a>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-12 col-xs-12">
            <div class="product-details-content quickview-content">
                <h2><?php echo $prod_name ?></h2>
                <div class="product-details-price">
                    <span class="new">₱<?php echo number_format($selling_price, 2, '.', ',') ?></span>
                    <span class="old"><?php echo $priceOld ?></span>
                </div>
                <input type="hidden" name="hidden_name" id="img<?php echo $sku ?>" value="<?php echo $prodImg1 ?>" />
                <input type="hidden" name="hidden_name" id="name<?php echo $sku ?>" value="<?php echo $prod_name ?>" />
                <input type="hidden" name="hidden_price" id="price<?php echo $sku ?>" value="<?php echo $selling_price ?>" />
                <div class="pro-details-rating-wrap">
                    <div class="pro-details-rating">
                        <i class="sli sli-star yellow"></i>
                        <i class="sli sli-star yellow"></i>
                        <i class="sli sli-star yellow"></i>
                        <i class="sli sli-star"></i>
                        <i class="sli sli-star"></i>
                    </div>
                    <span>3 Reviews</span>
                </div>
                <p><?php echo $prod_desc ?></p>
                <div class="pro-details-list">
                    <ul>
                        <li><strong>Size</strong></li>
                        <li>- <?php echo $prod_size ?></li>
                    </ul>
                </div>
                <div class="pro-details-size-color">
                    <div class="pro-details-color-wrap">
                        <span>Color</span>
                        <div class="pro-details-color-content">
                            - <?php echo $prod_color ?>
                        </div>
                    </div>
                    <div class="pro-details-size">
                        <span>Size</span>
                        <div class="pro-details-size-content">
                            <ul>
                                <li><a href="#" active>s</a></li>
                                <li><a href="#">m</a></li>
                                <li><a href="#">l</a></li>
                                <li><a href="#">xl</a></li>
                                <li><a href="#">xxl</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <style type="text/css">
                  
                </style>
                <div class="pro-details-quality">
                    <div class="cart-plus-minus">
                        <input class="cart-plus-minus-box" type="text" name="qtybutton" id="quantity<?php echo $sku ?>" value="1">
                    </div>
                    <div class="pro-details-cart">
                        <input type="button" name="add_to_cart" id="<?php echo $sku ?>" class="add_to_cart" value="Add to Cart" />
                    </div>
                    <div class="pro-details-wishlist">
                        <a title="Add To Wishlist" name="add_to_wishlist" id="<?php echo $sku ?>" href="javascript:void(0)"><i class="sli sli-heart"></i></a>
                    </div>
                </div>
                <div class="pro-details-meta">
                    <span>Categories :</span>
                    <?php echo $prod_cat?>
                </div>
                <div class="pro-details-meta">
                    <span>Tag :</span>
                    <ul>
                        <li><a href="#">Fashion, </a></li>
                        <li><a href="#">Furniture,</a></li>
                        <li><a href="#">Electronic</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
 
<script src="assets/js/main.js"></script>