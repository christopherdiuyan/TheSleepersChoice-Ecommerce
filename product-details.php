<?php 
include_once("includes/header.php"); 

if(isset($_GET['prodID']))
{
    $sku = $_GET['prodID'];
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
    $discount = $row['product_discount'] > 0 ? "<span>-".$row['product_discount'] ."%</span>" : "";
    $stmt = $connect->query("SELECT * FROM product_categories WHERE p_cat_title = '". $prod_cat ."'");
    $row = $stmt->fetch();
    $category_img =  file_exists(Config::$categoryFilepath . $row['p_cat_img']) ? Config::$categoryFilepath . $row['p_cat_img'] : Config::$categoryFilepath . Config::$defaultCategoryImg ;

}
else
{
    echo "<script>window.open('shop.php','_self')</script>";
}

?>
    <link rel="stylesheet" href="custom.css">
     <div id="notification-area" style="z-index: 9999">
    </div>
    <div class="breadcrumb-area pt-35 pb-35 bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">Product Details </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-details-area pt-100 pb-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-img">
                        <div class="zoompro-border zoompro-span" style="width:570px; height:570px">
                            <img class="zoompro" width="470px" height="570px" src="<?php echo $prodImg1 ?>" data-zoom-image="<?php echo $prodImg1 ?>"  <?php echo $prodImg1 ?>/>           
                            <?php echo $discount ?>
                        </div>
                        <div id="gallery" class="mt-20 product-dec-slider">
                            <a data-image="<?php echo $prodImg1 ?>" data-zoom-image="<?php echo $prodImg1 ?>">
                                <img src="<?php echo $prodImg1 ?>" width="90" height="90" alt="<?php echo $prod_name ?>">
                            </a>
                            <a data-image="<?php echo $prodImg2 ?>" data-zoom-image="<?php echo $prodImg2 ?>">
                                <img src="<?php echo $prodImg2 ?>" width="90" height="90" alt="<?php echo $prod_name ?>">
                            </a>
                            <a data-image="<?php echo $prodImg3 ?>" data-zoom-image="<?php echo $prodImg3 ?>">
                                <img src="<?php echo $prodImg3 ?>" width="90" height="90" alt="<?php echo $prod_name ?>">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-content ml-30">
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
                                <i class="sli sli-star yellow"></i>
                                <i class="sli sli-star yellow"></i>
                            </div>
                            <span><a data-toggle="tab" href="#des-details2">3 Reviews</a></span>
                        </div>
                        <p><?php echo $prod_desc ?></p>
                        <div class="pro-details-list">
                            <ul>
                                <li>- 0.5 mm Dail</li>
                                <li>- Inspired vector icons</li>
                                <li>- Very modern style  </li>
                            </ul>
                        </div>
                        <div class="pro-details-size-color">
                            <div class="pro-details-color-wrap">
                                <span>Color</span>
                                <div class="pro-details-color-content">
                                    <ul>
                                        - <?php echo $prod_color ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="pro-details-size">
                                <span>Size</span>
                                <div class="pro-details-size-content">
                                    <ul>
                                        <li><a href="#">s</a></li>
                                        <li><a href="#">m</a></li>
                                        <li><a href="#">l</a></li>
                                        <li><a href="#">xl</a></li>
                                        <li><a href="#">xxl</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" id="quantity<?php echo $sku ?>" value="1">
                            </div>
                            <div class="pro-details-cart btn-hover">
                                 <input type="button" name="add_to_cart" id="<?php echo $sku ?>" class="add_to_cart" value="Add to Cart" />
                            </div>
                            <div class="pro-details-wishlist">
                                <a href="javascript:void(0)"><i class="sli sli-heart add_to_wishlist" title="Add To Wishlist"  id="<?php echo $sku ?>"></i></a>
                            </div>
                        </div>
                        <div class="pro-details-meta">
                            <span>Categories :</span>
                            <ul>
                                <li><a href="#"><?php echo $prod_cat ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="description-review-area pb-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="description-review-wrapper">
                        <div class="description-review-topbar nav">
                            <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                            <a data-toggle="tab" href="#des-details3">Additional information</a>
                            <a data-toggle="tab" href="#des-details2">Reviews (3)</a>
                        </div>
                        <div class="tab-content description-review-bottom">
                            <div id="des-details1" class="tab-pane active">
                                <div class="product-description-wrapper">
                                    <p>Pellentesque orci lectus, bibendum iaculis aliquet id, ullamcorper nec ipsum. In laoreet ligula vitae tristique viverra. Suspendisse augue nunc, laoreet in arcu ut, vulputate malesuada justo. Donec porttitor elit justo, sed lobortis nulla interdum et. Sed lobortis sapien ut augue condimentum, eget ullamcorper nibh lobortis. Cras ut bibendum libero. Quisque in nisl nisl. Mauris vestibulum leo nec pellentesque sollicitudin.</p>
                                    <p>Pellentesque lacus eros, venenatis in iaculis nec, luctus at eros. Phasellus id gravida magna. Maecenas fringilla auctor diam consectetur placerat. Suspendisse non convallis ligula. Aenean sagittis eu erat quis efficitur. Maecenas volutpat erat ac varius bibendum. Ut tincidunt, sem id tristique commodo, nunc diam suscipit lectus, vel</p>
                                </div>
                            </div>
                            <div id="des-details3" class="tab-pane">
                                <div class="product-anotherinfo-wrapper">
                                    <ul>
                                        <li><span>Weight</span> 400 g</li>
                                        <li><span>Dimensions</span>10 x 10 x 15 cm </li>
                                        <li><span>Materials</span> 60% cotton, 40% polyester</li>
                                        <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress</li>
                                    </ul>
                                </div>
                            </div>
                            <div id="des-details2" class="tab-pane">
                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-1.jpg" alt="">
                                        </div>
                                        <div class="review-content">
                                            <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4>Stella McGee</h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-2.jpg" alt="">
                                        </div>
                                        <div class="review-content">
                                            <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4>Stella McGee</h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/img/product-details/client-3.jpg" alt="">
                                        </div>
                                        <div class="review-content">
                                            <p>“In convallis nulla et magna congue convallis. Donec eu nunc vel justo maximus posuere. Sed viverra nunc erat, a efficitur nibh”</p>
                                            <div class="review-top-wrap">
                                                <div class="review-name">
                                                    <h4>Stella McGee</h4>
                                                </div>
                                                <div class="review-rating">
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                    <i class="sli sli-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ratting-form-wrapper">
                                    <span>Add a Review</span>
                                    <p>Your email address will not be published. Required fields are marked <span>*</span></p>
                                    <div class="star-box-wrap">
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <div class="single-ratting-star">
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                    </div>
                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                        <label>Your review <span>*</span></label>
                                                        <textarea name="Your Review"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                       <label>Name <span>*</span></label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                       <label>Email <span>*</span></label>
                                                        <input type="email">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-submit">
                                                        <input type="submit" value="Submit">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="pro-dec-banner">
                        <a href="#"><img src="<?php echo $category_img?>" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2>Related products</h2>
                <p> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical</p>
            </div>
            <div class="arrivals-wrap scroll-zoom">
                <div class="ht-products product-slider-active owl-carousel">
                    <!--Product Start-->
                    <?php
                            
                            $query = "
                                    SELECT * FROM products WHERE product_status = '1' AND product_category = '$prod_cat'
                                ";

                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                $total_row = $statement->rowCount();
                                $output = '';

                                if($total_row > 0)
                                {
                                    foreach($result as $row)
                                    {   
                                        $prodSKU = $row['sku'];
                                        $selling_price = $row['product_price'] - ($row['product_price'] * ($row['product_discount'] / 100));

                                        $prodImg =  file_exists(Config::$productFilepath . $row['product_img1']) ? Config::$productFilepath . $row['product_img1'] : Config::$productFilepath . Config::$defaultProdImg ;
                                    

                                        $priceOld = $row['product_discount'] > 0 ? "₱ ". number_format($row['product_price'], 2, '.', ',') : "";
                                        
                                        $output .= '

                                      <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                        <div class="ht-product-inner">
                                            <div class="ht-product-image-wrap">
                                                <a href="product-details.php?prodID='. $row["sku"].'" class="ht-product-image"> <img src="'. $prodImg .'" alt='. $row['product_title'] .'> </a>
                                                <div class="ht-product-action">
                                                    <ul>
                                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#viewProduct" id="'. $row['sku'] .'" class="show-modal"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
                                                       <li><a  href="javascript:void(0)"><i class="sli sli-heart add_to_wishlist"  id="'. $row['sku'] .'"></i><span class="ht-product-action-tooltip" name="add_to_wishlist">Add to Wishlist</span></a>
                                                        <li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ht-product-content">
                                                <div class="ht-product-content-inner">
                                                    <input type="hidden" name="hidden_name" id="img'. $row['sku'] .'" value="'. $prodImg .'" />
                                                    <input type="hidden" name="hidden_name" id="name'. $row['sku'] .'" value="'. $row['product_title'] .'" />
                                                    <input type="hidden" name="hidden_price" id="price'. $row['sku'] .'" value="'. $selling_price .'" />
                                                    <input type="hidden" name="qty" id="quantity'. $row['sku'] .'" value="1">
                                                    <div class="ht-product-categories"><a href="javascript:void(0)">'. $row['product_category'] .'</a></div>
                                                    <h4 class="ht-product-title"><a href="product-details.php">'. $row['product_title'] .'</a></h4>
                                                    <div class="ht-product-price">
                                                        <span class="new">₱'. number_format($selling_price, 2, '.', ',') .'</span>
                                                        <span class="old">'. $priceOld .'</span>
                                                    </div>
                                                    <div class="ht-product-ratting-wrap">
                                                        <span class="ht-product-ratting">
                                                            <span class="ht-product-user-ratting" style="width: 100%;">
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                            </span>
                                                        <i class="sli sli-star"></i>
                                                        <i class="sli sli-star"></i>
                                                        <i class="sli sli-star"></i>
                                                        <i class="sli sli-star"></i>
                                                        <i class="sli sli-star"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ht-product-action">
                                                    <ul>
                                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#viewProduct"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
                                                        <li><a  href="javascript:void(0)"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip">Add to Wishlist</span></a></li>
                                                        <li>
                                                    </ul>
                                                </div>
                                                <div class="ht-product-countdown-wrap">
                                                    <div class="ht-product-countdown" data-countdown="2020/01/01"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        ';

                                    }
                                }
                                else
                                {
                                    $output = '<div class="col-xl-6 col-md-6 col-lg-6 col-sm-6"><h3>No Data Found</h3></div>';
                                }

                               echo $output;
                        ?>
                    <!--Product End-->
                </div>
            </div>
        </div>
    </div>

    <?php include_once("includes/footer.php"); ?>