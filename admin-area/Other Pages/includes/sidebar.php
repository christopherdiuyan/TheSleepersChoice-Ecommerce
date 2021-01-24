<div class="col-lg-3">
    <div class="sidebar-style mr-30">
        <div class="sidebar-widget">
            <h4 class="pro-sidebar-title">Search </h4>
            <div class="pro-sidebar-search mb-50 mt-25">
                <form class="pro-sidebar-search-form" action="#">
                    <input type="text" id="searchProd" autocomplete="off" placeholder="Search here...">
                    <button>
                        <i class="sli sli-magnifier"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="sidebar-widget">
            <h4 class="pro-sidebar-title">Product Category </h4>
            <div class="sidebar-widget-list mt-30">
                <ul>
                    <?php
                    $query = "SELECT * FROM product_categories ORDER BY p_cat_title";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();

                    foreach($result as $row) 
                    { 
                        $query = "SELECT * FROM products WHERE product_category = '" . $row['p_cat_title'] . "'";
                        $statement = $connect->prepare($query);
                        $statement->execute();
                    ?>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" class="common_selector cat" value="<?php echo $row['p_cat_title']; ?>"> <a ><?php echo $row['p_cat_title']; ?> <span><?php echo $statement->rowCount() ?></span> </a> 
                            <span class="checkmark"></span>
                        </div>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
        <div class="sidebar-widget mt-45">
            <h4 class="pro-sidebar-title">Filter By Price </h4>
            <div class="price-filter mt-10">
                <div class="price-slider-amount">
                    <input type="text" id="amount" name="price"  placeholder="₱1000 - ₱10000" />
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="10000" />
                </div>
                <div id="slider-range"></div>
            </div>
        </div>
 <!--        <div class="sidebar-widget mt-50">
            <h4 class="pro-sidebar-title">Colour </h4>
            <div class="sidebar-widget-list mt-20">
                <ul>
                    <?php
                    $query = "
                    SELECT DISTINCT(product_storage) FROM product WHERE product_status = '1' ORDER BY product_storage DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox"class="common_selector storage" value="<?php echo $row['product_storage']; ?>"> <a href="#"><?php echo $row['product_storage']; ?> GB <span>7</span> </a>
                            <span class="checkmark"></span> 
                        </div>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
        <div class="sidebar-widget mt-40">
            <h4 class="pro-sidebar-title">Size </h4>
            <div class="sidebar-widget-list mt-20">
                <ul>
                    <?php

                    $query = "SELECT DISTINCT(product_brand) FROM product WHERE product_status = '1' ORDER BY product_id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" class="common_selector brand" value="<?php echo $row['product_brand']; ?>"> <a href="#"><?php echo $row['product_brand']; ?> <span>4</span> </a>
                            <span class="checkmark"></span> 
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div> -->
        <div class="sidebar-widget mt-50">
            <h4 class="pro-sidebar-title">Tag </h4>
            <div class="sidebar-widget-tag mt-25">
                <ul>
                    <li><a href="#">Clothing</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">For Men</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Fashion</a></li>
                </ul>
            </div>
        </div>
    </div>  
</div>