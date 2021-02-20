<?php
session_start();
require_once('includes/db.php');
require_once('assets/php/config.php');

if(isset($_POST["action"]))
{

	$query = "
		SELECT * FROM products WHERE product_status = '1'
	";

	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		  AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}

	if(isset($_POST["cat"]))
	{
		$cat_filter = implode("','", $_POST["cat"]);
		$query .= "
		 AND product_category IN('".$cat_filter."')
		";
	}
    $query .= ' LIMIT 6';
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
           
            <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                    <form class="form-item">
                    <div class="ht-product-inner">
                        <div class="ht-product-image-wrap">
                            <a href="product-details.php?prodID='. $row["sku"].'" class="ht-product-image"> <img src="'. $prodImg .'" alt="'. $row['product_title'] .'"> </a>

                            <div class="ht-product-action">
                                <ul>
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#viewProduct" id="'. $row['sku'] .'" class="show-modal"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
                                    <li><a  href="javascript:void(0)"><i class="sli sli-heart add_to_wishlist"  id="'. $row['sku'] .'"></i><span class="ht-product-action-tooltip" name="add_to_wishlist">Add to Wishlist</span></a></li>
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
                                <div class="ht-product-categories"><a href="#">'. $row['product_category'] .'</a></div>
                                <h4 class="ht-product-title"><a href="product-details.php?prod_id='. $row['sku'] .'">'. $row['product_title'] .'</a></h4>
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
                    </form> 
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
	

}
if(isset($_POST["action_list"]))
{

    $query = "
        SELECT * FROM products WHERE product_status = '1'
    ";

    if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
    {
        $query .= "
          AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
        ";
    }

    if(isset($_POST["cat"]))
    {
        $cat_filter = implode("','", $_POST["cat"]);
        $query .= "
         AND product_category IN('".$cat_filter."')
        ";
    }
    $query .= "LIMIT 3";
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
             <div class="shop-list-wrap shop-list-mrg2 shop-list-mrg-none mb-30">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="product-list-img">
                            <a href="#">
                                <img src="'. $prodImg .'" alt='. $row['product_title'] .'>
                            </a>
                            <div class="product-quickview">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#viewProduct" id="'. $row['sku'] .'" class="show-modal"><i class="sli sli-magnifier-add"></i></a>
                            </div>  
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 align-self-center">
                        <div class="shop-list-content">
                            <h3><a href="product-details.php">'. $row['product_title'] .'</a></h3>
                            <p>'. $row['product_desc'] .'</p>
                            <span>'. $row['product_category'] .'</span>
                            <div class="shop-list-price-action-wrap">
                                <div class="shop-list-price-ratting">
                                    <div class="ht-product-list-price">
                                        <span class="new">₱'. number_format($selling_price, 2, '.', ',') .'</span>
                                        <span class="old">'. $priceOld .'</span>
                                    </div>
                                    <div class="ht-product-list-ratting">
                                        <i class="sli sli-star"></i>
                                        <i class="sli sli-star"></i>
                                        <i class="sli sli-star"></i>
                                        <i class="sli sli-star"></i>
                                        <i class="sli sli-star"></i>
                                    </div>
                                </div>
                                <div class="ht-product-list-action">
                                    <input type="hidden" name="hidden_name" id="img'. $row['sku'] .'" value="'. $prodImg .'" />
                                    <input type="hidden" name="hidden_name" id="name'. $row['sku'] .'" value="'. $row['product_title'] .'" />
                                    <input type="hidden" name="hidden_price" id="price'. $row['sku'] .'" value="'. $selling_price .'" />
                                    <input type="hidden" name="qty" id="quantity'. $row['sku'] .'" value="1">
                                    <a class="list-wishlist add_to_wishlist" title="Add To Wishlist" id="'. $row['sku'] .'" href="javascript:void(0)"><i class="sli sli-heart"></i></a>
                                    <a href="javascript:void(0)" class="list-cart show-modal" title="Add To Cart" data-toggle="modal" data-target="#viewProduct" id="'. $row['sku'] .'"><i class="sli sli-basket-loaded"></i> Add to Cart</a>
                                    
                                </div>
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
    //getPaginator($total_row);

}


?>
