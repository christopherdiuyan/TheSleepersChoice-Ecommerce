<?php

// require_once("dbcontroller.php");
require_once('includes/db.php');
//require_once('functions/functions.php');

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

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();

	$output = '';
	if($total_row > 0)
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
                                    <li><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Add to Cart</span></a></li>
                                    <li><a  href="#"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip">Add to Wishlist</span></a></li>
                                    <li>
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
		$output = '<div class="col-xl-6 col-md-6 col-lg-6 col-sm-6"><h3>No Data Found</h3></div>';
	}

	echo $output;
    //getPaginator($total_row);

}
?>
<?php
function getPaginator($total_row){

    $per_page=9;
    $aWhere = array();
    $aPath = '';

    /// Begin for Product Categories /// 

    if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

        foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'p_cat_id='.(int)$sVal;
                $aPath .= 'p_cat[]='.(int)$sVal.'&';

            }

        }

    }    

    /// Finish for Product Categories /// 

    /// Begin for Categories /// 

    if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

        foreach($_REQUEST['cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'cat_id='.(int)$sVal;
                $aPath .= 'cat[]='.(int)$sVal.'&';

            }

        }

    }    

    // /// Finish for Categories ///

    $sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'');
    // $query = "select * from product";//.$sWhere;
    // $statement = $connect->prepare($query);
    // $statement->execute();
    // $result = $statement->fetchAll();
    // $total_records = $statement->rowCount();

    $total_pages = ceil($total_row / $per_page);

    echo '<div class="pro-pagination-style text-center mt-30">
    <ul>';
    //echo "<li> <a style='color:#DF7861' href='shop.php?page=1";
    if(!empty($aPath)){

        echo "&".$aPath;

    }
    echo '<li><a class="prev" href="#"><i class="sli sli-arrow-left"></i></a></li>';
    //echo "'>".'First Page'."</a></li>";

    for($i=1; $i<=$total_pages; $i++){

        echo "<li> <a href='shop.php?page=".$i.(!empty($aPath)?'&'.$aPath:'')."'>".$i."</a></li>";
        //echo '<li><a href="shop.php?page=".$i.(!empty($aPath)?'&'.$aPath:'').">".$i."</a></li>';

    };

    echo "<li> <a class='next' href='shop.php?page=$total_pages'>". '<i class="sli sli-arrow-right"></i></a></li>';
    //echo '<li><a class="next" href="shop.php?page=$total_pages"><i class="sli sli-arrow-right"></i></a></li>';
    if(!empty($aPath)){

        echo "&".$aPath;

    }

   // echo "'>".'Last Page'."</a></li>";
    echo '  </ul>
</div>';
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
