   <?php 
   include_once("includes/header.php");

   ?>
    
    <div class="slider-area section-padding-1">
        <div class="slider-active owl-carousel nav-style-1">
            <div class="single-slider slider-height-1 bg-paleturquoise">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-content slider-animated-1">
                                <h1 class="animated">UNIQUE AND TIMELESS SLEEPWEAR AND LOUNGEWEAR</h1>
                                <p class="animated">Shameepher sets combine glamour, comfort, and affordability. Everything the modern woman dreams of.</p>
                                <div class="slider-btn btn-hover">
                                    <a class="animated" href="shop.php">Shop Now <i class="sli sli-basket-loaded"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-single-img slider-animated-1">
                                <img class="animated" src="Product Images/SOFIA3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider slider-height-1 bg-paleturquoise">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-content slider-animated-1">
                                <h1 class="animated">UNIQUE AND TIMELESS SLEEPWEAR AND LOUNGEWEAR</h1>
                                <p class="animated">Shameepher sets combine glamour, comfort, and affordability. Everything the modern woman dreams of.</p>
                                <div class="slider-btn btn-hover">
                                    <a class="animated" href="shop.php">Shop Now <i class="sli sli-basket-loaded"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-single-img slider-animated-1">
                                <img class="animated" src="Product Images/SOFIA2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="banner-area pt-100 pb-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="product-details.php"><img class="animated" src="Product Images/BLACK HOLIDAY COMBO2.png" alt=""></a>
                        <div class="banner-content banner-position-1">
                            <h3>35% off <br>Black Monday</h3>
                            <h2>BLACK HOLIDAY <br> COMBO</h2>
                            <a href="product-details.php">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="product-details.php"><img class="animated" src="Product Images/OLD ROSE HOLIDAY COMBO5.png" alt=""></a>
                        <div class="banner-content banner-position-2">
                            <h3>15% off</h3>
                            <h2>OLD ROSE HOLIDAY  <br>COMBO</h2>
                            <a href="product-details.php">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center pb-40">
                <h2>All Products</h2>
                <p> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical</p>
            </div>
            <div class="product-tab-list nav pb-60 text-center">
                <a class="active" href="#product-1" data-toggle="tab">
                    <h4>Pajama Sets</h4>
                </a>
                <a href="#product-2" data-toggle="tab">
                    <h4>Robes</h4>
                </a>
                <a href="#product-3" data-toggle="tab">
                    <h4>Shorts</h4>
                </a>
            </div>
            <div class="tab-content jump-2">
                <div id="product-1" class="tab-pane active">
                    <div class="ht-products product-slider-active owl-carousel ">
                        <?php

                            $query = "
                                    SELECT * FROM products WHERE product_status = '1' AND product_category = 'Pajama Sets'
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
                                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#viewProduct" id="'. $row['sku'] .'" class="show-modal"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a>
                                                        </li>
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
                    </div>
                </div>
                <div id="product-2" class="tab-pane">
                    <div class="ht-products product-slider-active owl-carousel">
                        <!--Product Start-->
                       <?php

                            $query = "
                                    SELECT * FROM products WHERE product_status = '1' AND product_category = 'Robes'
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
                                                        <li><a href="javascript:void(0)" data-toggle="modal"data-target="#viewProduct" id="'. $row['sku'] .'" class="show-modal"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
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

                <div id="product-3" class="tab-pane">
                    <div class="ht-products product-slider-active owl-carousel">
                        <!--Product Start-->
                        <?php

                            $query = "
                                    SELECT * FROM products WHERE product_status = '1' AND product_category = 'Shorts'
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
                                                        <li><a href="javascript:void(0)" data-toggle="modal"data-target="#viewProduct" id="'. $row['sku'] .'" class="show-modal"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
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
    </div>

    <div class="testimonial-area pt-80 pb-95 section-margin-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ml-auto mr-auto">
                    <div class="testimonial-active owl-carousel nav-style-1">
                        <div class="single-testimonial text-center">
                            <img src="assets/img/testimonial/team1.png" alt="">
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable. Lorem ipsum dolor sit amet, consectetur adipiscing elit, didunt.</p>
                            <div class="client-info">
                                <img src="assets/img/icon-img/testi.png" alt="">
                                <h5>Nikolas Dehlli</h5>
                            </div>
                        </div>
                        <div class="single-testimonial text-center">
                            <img src="assets/img/testimonial/team2.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit.</p>
                            <div class="client-info">
                                <img src="assets/img/icon-img/testi.png" alt="">
                                <h5>Grace Alvarado</h5>
                            </div>
                        </div>
                        <div class="single-testimonial text-center">
                            <img src="assets/img/testimonial/team3.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit.</p>
                            <div class="client-info">
                                <img src="assets/img/icon-img/testi.png" alt="">
                                <h5>Grace Alvarado</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="custom.css">
    <div id="notification-area" style="z-index: 9999">
    </div>
    <div class="product-area pt-95 pb-70">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2>New Arrivals</h2>
                <p> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical</p>
            </div>
            <div class="arrivals-wrap scroll-zoom">
                <div class="ht-products product-slider-active owl-carousel">
                    <!--Product Start-->
                     <?php

                            $query = "
                                    SELECT * FROM products WHERE product_status = '1' ORDER BY product_id DESC LIMIT 10
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
                                        $selling_price = $row['product_price'] - ($row['product_price'] * ($row['product_discount'] / 100));

                                        $prodImg =  file_exists(Config::$productFilepath . $row['product_img1']) ? Config::$productFilepath . $row['product_img1'] : Config::$productFilepath . Config::$defaultProdImg ;
                                    

                                        $priceOld = $row['product_discount'] > 0 ? "₱ ". number_format($row['product_price'], 2, '.', ',') : "";
                                        $output .= '

                                      <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                        <div class="ht-product-inner">
                                            <div class="ht-product-image-wrap">
                                                <a href="product-details.php" class="ht-product-image"> <img src="'. $prodImg .'" alt='. $row['product_title'] .'> </a>
                                                <div class="ht-product-action">
                                                    <ul>
                                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#viewProduct"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a>
                                                        </li>
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

    <!-- <div class="banner-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="product-details.php"><img src="Product Images/CELINA MASK1.png" alt=""></a>
                        <div class="banner-content banner-position-3">
                            <h3>Black Monday</h3>
                            <h2>Wooden Category <br>Save 30%</h2>
                            <a href="product-details.php">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="product-details.php"><img src="Product Images/TERESITA MASK1.png" alt=""></a>
                        <div class="banner-content banner-position-4">
                            <h3>Black Monday</h3>
                            <h2>Wooden Category <br>Save 30%</h2>
                            <a href="product-details.php">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="feature-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature mb-40">
                        <div class="feature-icon">
                            <img src="assets/img/icon-img/free-shipping.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4>Free Shipping</h4>
                            <p>Most product are free <br>shipping.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-4 col-md-4">
                    <div class="single-feature mb-40 pl-50">
                        <div class="feature-icon">
                            <img src="assets/img/icon-img/support.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4>Customer Support</h4>
                            <p>24x7 Customer Support</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="single-feature mb-40">
                        <div class="feature-icon">
                            <img src="assets/img/icon-img/security.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4>Secure Payment</h4>
                            <p>Most Secure Payment <br>for customer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!--  <div class="blog-area pt-50 pb-65">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2>New Blog Posts</h2>
                <p> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical</p>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="blog-wrap mb-30 mr-20 text-center scroll-zoom">
                        <div class="blog-img mb-25">
                            <a href="blog-details.php"><img src="assets/img/blog/blog-1.svg" alt=""></a>
                        </div>
                        <div class="blog-content">
                            <h3><a href="blog-details.php">Distracted by the readable content</a></h3>
                            <div class="blog-meta blog-mrg-border">
                                <ul>
                                    <li><a href="javascript:void(0)">23 December 2019 </a></li>
                                    <li><a href="javascript:void(0)"> 24 View </a></li>
                                    <li><a href="javascript:void(0)">4 likes</a></li>
                                </ul>
                            </div>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="blog-wrap mb-30 ml-20 text-center scroll-zoom">
                        <div class="blog-img mb-25">
                            <a href="blog-details.php"><img src="assets/img/blog/blog-2.svg" alt=""></a>
                        </div>
                        <div class="blog-content">
                            <h3><a href="blog-details.php">There are many variations of passages of Lorem</a></h3>
                            <div class="blog-meta blog-mrg-border">
                                <ul>
                                    <li><a href="javascript:void(0)">23 December 2019 </a></li>
                                    <li><a href="javascript:void(0)"> 24 View </a></li>
                                    <li><a href="javascript:void(0)">4 likes</a></li>
                                </ul>
                            </div>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    
    <?php include_once("includes/footer.php"); ?>