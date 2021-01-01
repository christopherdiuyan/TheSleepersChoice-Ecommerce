<?php

//fetch_data.php
require_once("dbcontroller.php");
//require_once('includes/db.php');
require_once("pagination.class.php");
$db_handle = new DBController();
    $perPage = new PerPage();
// $per_page = 6;
// $current_page = !empty($_POST['page']) ? (int)$_POST['page'] : '1';
// $offset = ($current_page - 1) * $per_page;

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM product WHERE product_status = '1'
	";

	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND product_brand IN('".$brand_filter."')
		";
	}
	if(isset($_POST["ram"]))
	{
		$ram_filter = implode("','", $_POST["ram"]);
		$query .= "
		 AND product_ram IN('".$ram_filter."')
		";
	}
	if(isset($_POST["storage"]))
	{
		$storage_filter = implode("','", $_POST["storage"]);
		$query .= "
		 AND product_storage IN('".$storage_filter."')
		";
	}

	//$query .= "LIMIT {$per_page} ";
    //$query .= "OFFSET {$offset}";

	// $statement = $connect->prepare($query);
	// $statement->execute();
	// $result = $statement->fetchAll();
	// $total_row = $statement->rowCount();
	//$total_pages = ceil($total_row / $per_page);

	// $output = '';
	// if($total_row > 0)
	// {
	// 	foreach($result as $row)
	// 	{	
	// 		$selling_price = $row['product_price'] - ($row['product_price'] * (10 / 100));
	// 		$output .= '
           
 //            <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
 //                <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
 //                    <form class="form-item">
 //                    <div class="ht-product-inner">
 //                        <div class="ht-product-image-wrap">
 //                            <a href="product-details.php" class="ht-product-image"> <img src="image/'. $row['product_image'] .'" alt="Universal Product Style"> </a>

 //                            <div class="ht-product-action">
 //                                <ul>
 //                                    <li><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="sli sli-magnifier"></i><span class="ht-product-action-tooltip">Quick View</span></a></li>
 //                                    <li><a  href="javascript:;" class="addtowishlist"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip">Add to Wishlist</span></a></li>
 //                                    <li>
 //                                    <input name="product_code" type="hidden" value="{$row["product_id"]}">
 //                                    <button type="submit">Add to Cart</button>
 //                                    <a type="submit"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
 //                                </ul>
 //                            </div>
 //                        </div>

 //                        <div class="ht-product-content">
 //                            <div class="ht-product-content-inner">
 //                                <div class="ht-product-categories"><a href="#">Category </a></div>
 //                                <h4 class="ht-product-title"><a href="product-details.php">'. $row['product_name'] .'</a></h4>
 //                                <div class="ht-product-price">
 //                                    <span class="new">₱'. number_format($selling_price, 2, '.', ',') .'</span>
 //                                    <span class="old">₱'. number_format($row['product_price'], 2, '.', ',') .'</span>
 //                                </div>
 //                                <div class="ht-product-ratting-wrap">
 //                                    <span class="ht-product-ratting">
 //                                        <span class="ht-product-user-ratting" style="width: 100%;">
 //                                            <i class="sli sli-star"></i>
 //                                            <i class="sli sli-star"></i>
 //                                            <i class="sli sli-star"></i>
 //                                            <i class="sli sli-star"></i>
 //                                            <i class="sli sli-star"></i>
 //                                        </span>
 //                                    <i class="sli sli-star"></i>
 //                                    <i class="sli sli-star"></i>
 //                                    <i class="sli sli-star"></i>
 //                                    <i class="sli sli-star"></i>
 //                                    <i class="sli sli-star"></i>
 //                                    </span>
 //                                </div>
 //                            </div>
 //                            <div class="ht-product-action">
 //                                <ul>
 //                                    <li><a href="#"><i class="sli sli-magnifier"></i><span class="ht-product-action-tooltip">Quick View</span></a></li>
 //                                    <li><a href="#"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip">Add to Wishlist</span></a></li>
 //                                    <li><a href="#"><i class="sli sli-refresh"></i><span class="ht-product-action-tooltip">Add to Compare</span></a></li>
 //                                    <li><a href="#"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
 //                                </ul>
 //                            </div>
 //                            <div class="ht-product-countdown-wrap">
 //                                <div class="ht-product-countdown" data-countdown="2020/01/01"></div>
 //                            </div>
 //                        </div>
 //                    </div>
 //                    </form> 
 //                </div>
 //            </div>     
                
 //            ';

			
	// 	}
	// }
	// else
	// {
	// 	$output = '<div class="col-xl-6 col-md-6 col-lg-6 col-sm-6"><h3>No Data Found</h3></div>';
	// }

	// echo $output;

    // $sql = "SELECT * from php_interview_questions";
    
    $paginationlink = "fetch_data.php?page=";

    $page = 1;
    if(!empty($_GET["page"])) {
    $page = $_GET["page"];
    }

    $start = ($page-1)*$perPage->perpage;
    if($start < 0) $start = 0;

    $sql =  $query . " limit " . $start . "," . $perPage->perpage; 
    $result = $db_handle->runQuery($sql);

    if(empty($_GET["rowcount"])) {
    $_GET["rowcount"] = $db_handle->numRows($query);    
    } 

    $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink); 
    // echo "<script>alert('$result')</script>";
    $output = '';
    if($_GET["rowcount"] > 0)
    {
        foreach($result as $row)
        {   
            $selling_price = $row['product_price'] - ($row['product_price'] * (10 / 100));
            $output .= '
           
            <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                    <form class="form-item">
                    <div class="ht-product-inner">
                        <div class="ht-product-image-wrap">
                            <a href="product-details.php" class="ht-product-image"> <img src="image/'. $row['product_image'] .'" alt="Universal Product Style"> </a>

                            <div class="ht-product-action">
                                <ul>
                                    <li><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="sli sli-magnifier"></i><span class="ht-product-action-tooltip">Quick View</span></a></li>
                                    <li><a  href="javascript:;" class="addtowishlist"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip">Add to Wishlist</span></a></li>
                                    <li>
                                    <input name="product_code" type="hidden" value="{$row["product_id"]}">
                                    <button type="submit">Add to Cart</button>
                                    <a type="submit"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="ht-product-content">
                            <div class="ht-product-content-inner">
                                <div class="ht-product-categories"><a href="#">Category </a></div>
                                <h4 class="ht-product-title"><a href="product-details.php">'. $row['product_name'] .'</a></h4>
                                <div class="ht-product-price">
                                    <span class="new">₱'. number_format($selling_price, 2, '.', ',') .'</span>
                                    <span class="old">₱'. number_format($row['product_price'], 2, '.', ',') .'</span>
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
                                    <li><a href="#"><i class="sli sli-magnifier"></i><span class="ht-product-action-tooltip">Quick View</span></a></li>
                                    <li><a href="#"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip">Add to Wishlist</span></a></li>
                                    <li><a href="#"><i class="sli sli-refresh"></i><span class="ht-product-action-tooltip">Add to Compare</span></a></li>
                                    <li><a href="#"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
                                </ul>
                            </div>
                            <div class="ht-product-countdown-wrap">
                                <div class="ht-product-countdown" data-countdown="2020/01/01"></div>
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
        $output = '<div class="col-xl-4 col-md-6 col-lg-6 col-sm-6"><h3>No Data Found</h3></div>';
    }

    if(!empty($perpageresult)) {
    $output .= '<div style="padding-left: 150px" id="paginatiosn"' . $perpageresult . '</div>';
    } 
    print $output;
 }

?>

<!-- <div class="pro-pagination-style text-center mt-30">
    <ul>
        <li><a class="prev" href="#"><i class="sli sli-arrow-left"></i></a></li>
        <li><a class="active" href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a class="next" href="#"><i class="sli sli-arrow-right"></i></a></li>
    </ul>
</div> -->
