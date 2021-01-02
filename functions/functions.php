<?php 

// require_once("includes/db.php");

/// begin getRealIpUser functions ///

function getRealIpUser(){
    
    switch(true){
            
            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
            
            default : return $_SERVER['REMOTE_ADDR'];
            
    }
     
}

/// finish getRealIpUser functions ///

function add_inquiry(){
    global $db;
    if(isset($_POST['submit'])){
        
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_message = $_POST['c_message'];
        
        echo "<script>alert('$c_name $c_email $c_message')</script>";
        
        $query = "insert into  inquiry (name,email,message) values ('$c_name','$c_email','$c_message')";
            
        $run_query = mysqli_query($db,$query);
        echo "<script>alert('Thank you for messaging us.')</script>";
        echo "<script>window.open('contact.php','_self')</script>";
    }
}

/// begin add_cart functions ///
function add_carts(){
    
    global $db;
    
    if(isset($_GET['add_carts'])){
        
        if(isset($_SESSION['customer_email'])){
            $session_email = $_SESSION['customer_email'];
            $select_customer = "select * from customers where customer_email='$session_email'";
            $run_customer = mysqli_query($db,$select_customer);
            $row_customer = mysqli_fetch_array($run_customer);
            $c_id = $row_customer['customer_id'];
        }
        else
            $c_id = 0; // 0 = For Guest Customer ID
        
        
        $ip_add = getRealIpUser();
        $p_id = $_GET['add_carts'];
        $product_qty = 1;
        
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id' AND c_id='$c_id'";
        $run_check = mysqli_query($db,$check_product);
        if(mysqli_num_rows($run_check)>0){
            
            echo "<script>alert('This product has already added in your cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
            
        }else{
            $check_product = "delete from wishlist where p_id='$p_id'";
            $run_check = mysqli_query($db,$check_product);
            
            $query = "insert into cart (c_id,p_id,ip_add,qty) values ('$c_id','$p_id','$ip_add','$product_qty')";
            
            $run_query = mysqli_query($db,$query);
            echo "<script>alert('Successfully added in your cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
            if($c_id == 0){
                echo "<script>window.open('index.php','_self')</script>";
            }
            
        }
    }
}
function add_cart(){
    
    global $db;
    
    if(isset($_GET['add_cart'])){
        
        if(isset($_SESSION['customer_email'])){
            $session_email = $_SESSION['customer_email'];
            $select_customer = "select * from customers where customer_email='$session_email'";
            $run_customer = mysqli_query($db,$select_customer);
            $row_customer = mysqli_fetch_array($run_customer);
            $c_id = $row_customer['customer_id'];
        }
        else
            $c_id = 0; // 0 = For Guest Customer ID
        
        
        $ip_add = getRealIpUser();
        $p_id = $_GET['add_cart'];
        $product_qty = 1;
        
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id' AND c_id='$c_id'";
        $run_check = mysqli_query($db,$check_product);
        if(mysqli_num_rows($run_check)>0){
            
            echo "<script>alert('This product has already added in your cart')</script>";
            echo "<script>window.open('shop.php','_self')</script>";
            
        }else{
            $check_product = "delete from wishlist where p_id='$p_id'";
            $run_check = mysqli_query($db,$check_product);
            
            $query = "insert into cart (c_id,p_id,ip_add,qty) values ('$c_id','$p_id','$ip_add','$product_qty')";
            
            $run_query = mysqli_query($db,$query);
            echo "<script>alert('Successfully added in your cart')</script>";
            echo "<script>window.open('shop.php','_self')</script>";
            if($c_id == 0){
                echo "<script>window.open('shop.php','_self')</script>";
            }
            
        }
    }
}
function add_to_cart(){
    
    global $db;
    
    if(isset($_GET['add_to_cart'])){
        
        if(isset($_SESSION['customer_email'])){
            $session_email = $_SESSION['customer_email'];
            $select_customer = "select * from customers where customer_email='$session_email'";
            $run_customer = mysqli_query($db,$select_customer);
            $row_customer = mysqli_fetch_array($run_customer);
            $c_id = $row_customer['customer_id'];
        }
        else
            $c_id = 0; // 0 = For Guest Customer ID
        
        
        $ip_add = getRealIpUser();
        $p_id = $_GET['add_to_cart'];
        $product_qty = $_POST['product_qty'];
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id' AND c_id='$c_id'";
        $run_check = mysqli_query($db,$check_product);
        if(mysqli_num_rows($run_check)>0){
            
            echo "<script>alert('This product has already added in your cart')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }else{
            $check_product = "delete from wishlist where p_id='$p_id'";
            $run_check = mysqli_query($db,$check_product);
            
            $query = "insert into cart (c_id,p_id,ip_add,qty) values ('$c_id','$p_id','$ip_add','$product_qty')";
            
            $run_query = mysqli_query($db,$query);
            echo "<script>alert('Successfully added in your cart')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            if($c_id == 0){
                echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            }
            
        }
    }
}
function add_wishlist(){
    
    global $db;
    
    if(isset($_GET['add_wishlist'])){
        
        $session_email = $_SESSION['customer_email'];
        $select_customer = "select * from customers where customer_email='$session_email'";
        $run_customer = mysqli_query($db,$select_customer);
        $row_customer = mysqli_fetch_array($run_customer);
        $c_id = $row_customer['customer_id'];
        
        $ip_add = getRealIpUser();
        
        $p_id = $_GET['add_wishlist'];
        
        $check_product = "select * from wishlist where ip_add='$ip_add' AND p_id='$p_id' AND c_id='$c_id'";
        
        $run_check = mysqli_query($db,$check_product);
        
        if(mysqli_num_rows($run_check)>0){
            
            echo "<script>alert('This product has already added in your wishlist')</script>";
            // echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }else{
            
            $query = "insert into wishlist (c_id,p_id,ip_add) values ('$c_id','$p_id','$ip_add')";
            
            $run_query = mysqli_query($db,$query);
            echo "<script>alert('Successfully added in your wishlist')</script>";
            // echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }
        
    }
    
}

/// finish add_cart functions ///

/// begin getPro functions ///
//products for Boxes
function getPro_Boxes(){
    
    global $db;
    
    $get_cat = "select * from categories WHERE cat_title = 'Boxes'";
    $run_cat = mysqli_query($db,$get_cat);
    $row_cat=mysqli_fetch_array($run_cat);
    $cat_id = $row_cat['cat_id'];
    
    $get_products = "select * from products WHERE cat_id ='$cat_id' order by 1 DESC LIMIT 8";
    
    $run_products = mysqli_query($db,$get_products);
    echo "<div class='product-slider owl-carousel'>";
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $p_cat_title = $row_products['product_category'];
        $tempPrice = $pro_price + ($pro_price * 0.20);
        echo "
            
                 <div class='product-item'> 

                    <div class='pi-pic'>
                        <a href='details.php?pro_id=$pro_id'>
                        <img src='admin_area/product_images/$pro_img1' alt='' width='270' height='300'>
                        </a>
                        <div class='sale'>Sale</div>
                        <div class='icon'style='padding-top: 19%;margin-right: -8%;width: 65%;'>
                        <ul>
                            <form method='POST' action='
                            ";
                            if(isset($_SESSION['customer_email'])){
                               echo "index.php?add_wishlist=$pro_id";
                            }else
                            echo "customer/my_account.php?my_wishlist";
                            
                            echo"
                            '>
                                <li class='w-icon active'>
                                <button type='submit' name='Submit' id='btnwishlish'><font color='white'>+ Add to Wishlist</font></button>
                                </li>
                            </form>
                            
                        </ul>
                        </div>
                        <ul>    
                            <li class='w-icon active'><a href='index.php?add_carts=$pro_id'><i class='icon_bag_alt'></i></a></li>
                            <li class='quick-view'><a href='details.php?pro_id=$pro_id'>+ Quick View</a></li>
                        </ul>
                    </div>

                    <div class='pi-text'>
                        <div class='catagory-name'>$p_cat_title</div>
                        <a href='#'>
                            <h5>$pro_title</h5>
                        </a>
                        <div class='product-price'>
                            ₱ $pro_price
                            <span>₱ $tempPrice</span>
                        </div>
                    </div>

                </div>
            
            ";
    }
    echo "</div>";
    if(isset($_POST['Submit']))
      echo"<script>window.open('index.php','_self')</script>";
}
//products for Cards
function getPro_Cards(){
    
    global $db;
    
    $get_cat = "select * from categories WHERE cat_title = 'Cards'";
    $run_cat = mysqli_query($db,$get_cat);
    $row_cat=mysqli_fetch_array($run_cat);
    $cat_id = $row_cat['cat_id'];
    
    $get_products = "select * from products WHERE cat_id ='$cat_id' order by 1 DESC LIMIT 8";
    
    $run_products = mysqli_query($db,$get_products);
    echo "<div class='product-slider owl-carousel'>";
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $p_cat_title = $row_products['product_category'];
        $tempPrice = $pro_price + ($pro_price * 0.20);
        echo "
            
                 <div class='product-item'> 

                    <div class='pi-pic'>
                        <a href='details.php?pro_id=$pro_id'>
                        <img src='admin_area/product_images/$pro_img1' alt='' width='270' height='300'>
                        </a>
                        <div class='sale'>Sale</div>
                        <div class='icon'style='padding-top: 19%;;margin-right: -8%;width: 65%;'>
                        <ul>
                            <form method='POST' action='
                            ";
                            if(isset($_SESSION['customer_email'])){
                               echo "index.php?add_wishlist=$pro_id";
                            }else
                            echo "customer/my_account.php?my_wishlist";
                            
                            echo"
                            '>
                                <li class='w-icon active'>
                                <button type='submit' name='Submit' id='btnwishlish'><font color='white'>+ Add to Wishlist</font></button>
                                </li>
                            </form>
                        </ul>
                        </div>
                        <ul>    
                            <li class='w-icon active'><a href='index.php?add_carts=$pro_id'><i class='icon_bag_alt'></i></a></li>
                            <li class='quick-view'><a href='details.php?pro_id=$pro_id'>+ Quick View</a></li>
                        </ul>
                    </div>

                    <div class='pi-text'>
                        <div class='catagory-name'>$p_cat_title</div>
                        <a href='#'>
                            <h5>$pro_title</h5>
                        </a>
                        <div class='product-price'>
                            ₱ $pro_price
                            <span>₱ $tempPrice</span>
                        </div>
                    </div>

                </div>
            
            ";
    }
    echo "</div>";
    if(isset($_POST['Submit']))
      echo"<script>window.open('index.php','_self')</script>";
}
//products for Ribbons
function getPro_Ribbons(){
    
    global $db;
    
    $get_cat = "select * from categories WHERE cat_title = 'Ribbons'";
    $run_cat = mysqli_query($db,$get_cat);
    $row_cat=mysqli_fetch_array($run_cat);
    $cat_id = $row_cat['cat_id'];
    
    $get_products = "select * from products WHERE cat_id ='$cat_id' order by 1 DESC LIMIT 8";
    
    $run_products = mysqli_query($db,$get_products);
    echo "<div class='product-slider owl-carousel'>";
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $p_cat_title = $row_products['product_category'];
        $tempPrice = $pro_price + ($pro_price * 0.20);
        echo "
            
                 <div class='product-item'> 

                    <div class='pi-pic'>
                        <a href='details.php?pro_id=$pro_id'>
                        <img src='admin_area/product_images/$pro_img1' alt='' width='270' height='300'>
                        </a>
                        <div class='sale'>Sale</div>
                        <div class='icon'style='padding-top: 19%;margin-right: -8%;width: 65%;'>
                        <ul>
                            <form method='POST' action='
                            ";
                            if(isset($_SESSION['customer_email'])){
                               echo "index.php?add_wishlist=$pro_id";
                            }else
                            echo "customer/my_account.php?my_wishlist";
                            
                            echo"
                            '>
                                <li class='w-icon active'>
                                <button type='submit' name='Submit' id='btnwishlish'><font color='white'>+ Add to Wishlist</font></button>
                                </li>
                            </form>
                        </ul>
                        </div>
                        <ul>    
                            <li class='w-icon active'><a href='index.php?add_carts=$pro_id'><i class='icon_bag_alt'></i></a></li>
                            <li class='quick-view'><a href='details.php?pro_id=$pro_id'>+ Quick View</a></li>
                        </ul>
                    </div>

                    <div class='pi-text'>
                        <div class='catagory-name'>$p_cat_title</div>
                        <a href='#'>
                            <h5>$pro_title</h5>
                        </a>
                        <div class='product-price'>
                            ₱ $pro_price
                            <span>₱ $tempPrice</span>
                        </div>
                    </div>

                </div>
            
            ";
    }
    echo "</div>";
        if(isset($_POST['Submit']))
      echo"<script>window.open('index.php','_self')</script>";
}
//products for Lasercuts
function getPro_Lasercuts(){
    
    global $db;
    
    $get_cat = "select * from categories WHERE cat_title = 'Lasercut Items'";
    $run_cat = mysqli_query($db,$get_cat);
    $row_cat=mysqli_fetch_array($run_cat);
    $cat_id = $row_cat['cat_id'];
    
    $get_products = "select * from products WHERE cat_id ='$cat_id' order by 1 DESC LIMIT 8";
    
    $run_products = mysqli_query($db,$get_products);
    echo "<div class='product-slider owl-carousel'>";
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $p_cat_title = $row_products['product_category'];
        $tempPrice = $pro_price + ($pro_price * 0.20);
        echo "
            
                 <div class='product-item'> 

                    <div class='pi-pic'>
                        <a href='details.php?pro_id=$pro_id'>
                        <img src='admin_area/product_images/$pro_img1' alt='' width='270' height='300'>
                        </a>
                        <div class='sale'>Sale</div>
                        <div class='icon'style='padding-top: 19%;margin-right: -8%;width: 65%;'>
                        <ul>
                            <form method='POST' action='
                            ";
                            if(isset($_SESSION['customer_email'])){
                               echo "index.php?add_wishlist=$pro_id";
                            }else
                            echo "customer/my_account.php?my_wishlist";
                            
                            echo"
                            '>
                                <li class='w-icon active'>
                                <button type='submit' name='Submit' id='btnwishlish'><font color='white'>+ Add to Wishlist</font></button>
                                </li>
                            </form>
                        </ul>
                        </div>
                        <ul>    
                            <li class='w-icon active'><a href='index.php?add_carts=$pro_id'><i class='icon_bag_alt'></i></a></li>
                            <li class='quick-view'><a href='details.php?pro_id=$pro_id'>+ Quick View</a></li>
                        </ul>
                    </div>

                    <div class='pi-text'>
                        <div class='catagory-name'>$p_cat_title</div>
                        <a href='#'>
                            <h5>$pro_title</h5>
                        </a>
                        <div class='product-price'>
                            ₱ $pro_price
                            <span>₱ $tempPrice</span>
                        </div>
                    </div>

                </div>
            
            ";
    }
    echo "</div>";
        if(isset($_POST['Submit']))
      echo"<script>window.open('index.php','_self')</script>";
}

/// finish getPro functions ///

/// begin getPCats functions ///

function getPCats(){
    
    global $db;
    
    $get_p_cats = "select * from product_categories";
    
    $run_p_cats = mysqli_query($db,$get_p_cats);
    
    while($row_p_cats=mysqli_fetch_array($run_p_cats)){
        
        $p_cat_id = $row_p_cats['p_cat_id'];
        
        $p_cat_title = $row_p_cats['p_cat_title'];
        
        echo "
            <div class='bc-item'>
                <label for='bc-diesel'>
                 <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a>
                    <input type='checkbox' id='bc-diesel'>
                    <span class='checkmark'></span>
                </label>
            </div>
        
        ";
        
    }
    
}
    
/// finish getPCats functions ///

/// begin getCats functions ///

function getCats(){
    
    global $db;
    
    $get_cats = "select * from categories";
    
    $run_cats = mysqli_query($db,$get_cats);
    
    while($row_cats=mysqli_fetch_array($run_cats)){
        
        $cat_id = $row_cats['cat_id'];
        
        $cat_title = $row_cats['cat_title'];
        
        echo "
        
            <li>
            
                <a href='shop.php?cat=$cat_id'> $cat_title </a>
            
            </li>
        
        ";
        
    }
    
}
    
/// finish getCats functions ///

/// finish getRealIpUser functions ///

function items(){
    
    global $db;
    
    if(isset($_SESSION['customer_email'])){
        $session_email = $_SESSION['customer_email'];
        $select_customer = "select * from customers where customer_email='$session_email'";
        $run_customer = mysqli_query($db,$select_customer);
        $row_customer = mysqli_fetch_array($run_customer);
        $c_id = $row_customer['customer_id'];
    }
    else
        $c_id = 0; // 0 = For Guest Customer ID
    
    $ip_add = getRealIpUser();
    
    $get_items = "select * from cart where ip_add='$ip_add' AND c_id='$c_id'";
    
    $run_items = mysqli_query($db,$get_items);
    
    $count_items = mysqli_num_rows($run_items);
    
    echo $count_items;
    
}

function items_wishlist(){
    
    global $db;
    
    $session_email = $_SESSION['customer_email'];
    $select_customer = "select * from customers where customer_email='$session_email'";
    $run_customer = mysqli_query($db,$select_customer);
    $row_customer = mysqli_fetch_array($run_customer);
    $c_id = $row_customer['customer_id'];
    
    $ip_add = getRealIpUser();
    
    $get_items = "select * from wishlist where ip_add='$ip_add' AND c_id='$c_id'";
    
    $run_items = mysqli_query($db,$get_items);
    
    $count_items = mysqli_num_rows($run_items);
    
    echo $count_items;
    
}

/// finish getRealIpUser functions ///

/// begin total_price functions ///

function total_price(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $total = 0;
    
    $select_cart = "select * from cart where ip_add='$ip_add'";
    
    $run_cart = mysqli_query($db,$select_cart);
    
    while($record=mysqli_fetch_array($run_cart)){
        
        $pro_id = $record['p_id'];
        
        $pro_qty = $record['qty'];
        
        $get_price = "select * from products where product_id='$pro_id'";
        
        $run_price = mysqli_query($db,$get_price);
        
        while($row_price=mysqli_fetch_array($run_price)){
            
            $sub_total = $row_price['product_price']*$pro_qty;
            
            $total += $sub_total;
            
        }
        
    }
    
    echo "₱" . $total;
    
}

/// finish total_price functions ///

/// Begin getProducts(); functions ///

function getSortedProducts(){

    
    global $db;
    $aWhere = array();
    

    /// Begin for Product Categories /// 

    if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

        foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'p_cat_id='.(int)$sVal;

            }

        }

    }    

    /// Finish for Product Categories /// 

    /// Begin for Categories /// 

    if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

        foreach($_REQUEST['cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'cat_id='.(int)$sVal;

            }

        }

    }    

    /// Finish for Categories /// 

    $per_page=9;

    if(isset($_GET['page'])){

        $page = $_GET['page'];

    }else{
        $page=1;
    }
    $cat_id = $_POST['cat'];
    
    $start_from = ($page-1) * $per_page;
    $sLimit = " LIMIT $start_from,$per_page";
    
    $sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):''). 'AND cat_id=$cat_id' .$order_by .$sLimit;
    $get_products = "select * from products ".$sWhere;
    
    $run_products = mysqli_query($db,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $pro_cat_title = $row_products['product_category'];
        $tempPrice = $pro_price + ($pro_price * 0.20);
                            

        echo "
        
        <div class='col-lg-4 col-sm-6' >
        <div class='product-item' >
            <div class='pi-pic'>
                <img src='admin_area/product_images/$pro_img1' alt='' width='900px' height='300px'>
                <div class='sale pp-sale'>Sale</div>
                <div class='icon'style='padding-top: 10%;margin-right: -8%;width: 65%;'>
                <ul>
                    <form method='POST' action='
                    ";
                        if(isset($_SESSION['customer_email'])){
                           echo "shop.php?add_wishlist=$pro_id";
                        }else{
                        echo "customer/my_account.php?my_wishlist";
                        }
                        echo"
                    '>
                        <li class='w-icon active' >
                        <button type='submit' name='Submit' id='btnwishlish'><font color='white'style='font-size:.8em'>+ Add to Wishlist</font></button>
                        </li>
                    </form>
                </ul>
                </div>
                <ul>
                    <li class='w-icon active'>
                    <a href='details.php?pro_id=$pro_id'> 
                    <i class='icon_bag_alt'></i>
                    </a>
                    </li>
                    <li class='quick-view'><a href='details.php?pro_id=$pro_id'>+ Quick View</a></li>
                    
                </ul>
            </div>
            <div class='pi-text'>
                <div class='catagory-name'>$pro_cat_title</div>
                <a href='details.php?pro_id=$pro_id'>
                    <h5>$pro_title</h5>
                </a>
                <div class='product-price'>
                    ₱ $pro_price
                    <span>₱ $tempPrice </span>
                </div>
            </div>
        </div>
    </div>
        
        ";

    }
        if(isset($_POST['Submit']))
      echo"<script>window.open('shop.php','_self')</script>";

}

function getProducts(){

    
    global $db;
    $aWhere = array();
    
    if(isset($_POST['order']))
      $order_by = ($_POST['order']);
    else
        $order_by = "latest_prod";
      switch($order_by) {
        
        case 'latest_prod':
          $order_by = " ORDER BY product_id DESC "; 
          break;
        case 'oldest_prod':
          $order_by = " ORDER BY product_id "; 
          break;
        case 'highest_price':
          $order_by = " ORDER BY product_price DESC ";
          break;
        case 'lowest_price':
          $order_by = " ORDER BY product_price ";
          break;
        default:
          $order_by = " ORDER BY product_id DESC "; 
          break;
          
      }

    /// Begin for Manufacturer ///
    
    // if(isset($_REQUEST['man'])&&is_array($_REQUEST['man'])){

    //     foreach($_REQUEST['man'] as $sKey=>$sVal){

    //         if((int)$sVal!=0){

    //             $aWhere[] = 'manufacturer_id='.(int)$sVal;

    //         }

    //     }

    // }

    /// Finish for Manufacturer ///  

    /// Begin for Product Categories /// 

    if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

        foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'p_cat_id='.(int)$sVal;

            }

        }

    }    

    /// Finish for Product Categories /// 

    /// Begin for Categories /// 

    if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

        foreach($_REQUEST['cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'cat_id='.(int)$sVal;

            }

        }

    }    

    /// Finish for Categories /// 

    $per_page=9;

    if(isset($_GET['page'])){

        $page = $_GET['page'];

    }else{
        $page=1;
    }
    
    
    $start_from = ($page-1) * $per_page;
    $sLimit = " LIMIT $start_from,$per_page";
    
    $sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):''). $order_by .$sLimit;
    $get_products = "select * from products ".$sWhere;
    // echo "<script>alert('$get_products')</script>";
    $run_products = mysqli_query($db,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $pro_cat_title = $row_products['product_category'];
        $tempPrice = $pro_price + ($pro_price * 0.20);
                            
    // TEST
        echo "
        
        <div class='col-lg-4 col-md-3'>
        <div class='product-item' >
        
            <div class='pi-pic'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                <img class='img-cont' src='admin_area/product_images/$pro_img1' alt='Image not Found' width='900px' height='300px'>
                
                </a>
                <div class='sale pp-sale'style='margin-top: 10%;'>Sale</div>
                <div class='icon'style='padding-top: 21.5%;margin-right: -8%;width: 65%;'>
                <ul>
                    <form method='POST' action='
                    ";
                        if(isset($_SESSION['customer_email'])){
                           echo "shop.php?add_wishlist=$pro_id";
                        }else{
                        echo "customer/my_account.php?my_wishlist";
                        }
                        echo"
                    '>
                        <li class='w-icon active' >
                        <button type='submit' name='Submit' id='btnwishlish'><font color='white'style='font-size:.8em'>+ Add to Wishlist</font></button>
                        </li>
                    </form>
                </ul>
                </div>
                <ul>
                    <li class='w-icon active'>
                    <a href='shop.php?add_cart=$pro_id'> 
                    <i class='icon_bag_alt'></i>
                    </a>
                    </li>
                    <li class='quick-view'><a href='details.php?pro_id=$pro_id'>+ Quick View</a></li>
                    
                </ul>
            </div>
            <div class='pi-text'>
                <div class='catagory-name'>$pro_cat_title</div>
                <a href='details.php?pro_id=$pro_id'>
                    <h5>$pro_title</h5>
                </a>
                <div class='product-price'>
                    ₱ $pro_price
                    <span>₱ $tempPrice </span>
                </div>
            </div>
        </div>
    </div>
        
        ";

    }
        if(isset($_POST['Submit']))
      echo"<script>window.open('shop.php','_self')</script>";

}

/// finish getProducts(); functions ///

/// begin getPaginator(); functions ///

function getPaginator(){

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
    $query = "select * from product";//.$sWhere;
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_records = $statement->rowCount();

    $total_pages = ceil($total_records / $per_page);

    echo "<li> <a style='color:#DF7861' href='shop.php?page=1";
    if(!empty($aPath)){

        echo "&".$aPath;

    }

    echo "'>".'First Page'."</a></li>";

    for($i=1; $i<=$total_pages; $i++){

        echo "<li> <a style='color:#DF7861' href='shop.php?page=".$i.(!empty($aPath)?'&'.$aPath:'')."'>".$i."</a></li>";

    };

    echo "<li> <a style='color:#DF7861' href='shop.php?page=$total_pages";

    if(!empty($aPath)){

        echo "&".$aPath;

    }

    echo "'>".'Last Page'."</a></li>";


//  <div class="pro-pagination-style text-center mt-30">
//     <ul>
//         <li><a class="prev" href="#"><i class="sli sli-arrow-left"></i></a></li> 
//         <li><a class="active" href="#">1</a></li>
//         <li><a href="#">2</a></li>
//         <li><a class="next" href="#"><i class="sli sli-arrow-right"></i></a></li>
//     </ul>
// </div>

}

/// finish getPaginator(); functions ///
function getRelatedProducts(){
    
    global $db;
    global $temp_id3;
    $get_products = "select * from products WHERE p_cat_id ='$temp_id3' LIMIT 4";
            
    $run_products = mysqli_query($db,$get_products);

    while($row_products=mysqli_fetch_array($run_products)){

    $pro_id = $row_products['product_id'];
    $pro_title = $row_products['product_title'];
    $pro_price = $row_products['product_price'];
    $pro_img1 = $row_products['product_img1'];
    $p_cat_title = $row_products['product_category'];
    $tempPrice = $pro_price + ($pro_price * 0.20);
    echo "
        <div class='col-lg-3 col-sm-6'>
            <div class='product-item' >
            <div class='pi-pic'>
                <img src='admin_area/product_images/$pro_img1' alt='' width='900px' height='300px'>
                <div class='sale pp-sale'>Sale</div>
                <div class='icon'style='padding-top: 10%;margin-right: -8%;width: 65%;'>
                <ul>
                    <a href='
                    ";
                        if(isset($_SESSION['customer_email'])){
                           echo "details.php?add_wishlist=$pro_id";
                        }else
                            echo "customer/my_account.php?my_wishlist";
                        echo"
                    '>
                        <li class='w-icon active' >
                        <button type='submit' name='Submit' id='btnwishlish'><font color='white'style='font-size:.8em'>+ Add to Wishlist</font></button>
                        </li>
                    </a>
                </ul>
                </div>
                <ul>
                    <li class='w-icon active'>
                    <a href='details.php?pro_id=$pro_id'> 
                    <i class='icon_bag_alt'></i>
                    </a>
                    </li>
                    <li class='quick-view'><a href='details.php?pro_id=$pro_id'>+ Quick View</a></li>
                    
                </ul>
            </div>
            <div class='pi-text'>
                <div class='catagory-name'>$p_cat_title</div>0
                <a href='details.php?pro_id=$pro_id'>
                    <h5>$pro_title</h5>
                </a>
                <div class='product-price'>
                    ₱ $pro_price
                    <span>₱ $tempPrice </span>
                </div>
            </div>
        </div>
        </div>
    ";
    }
}
?>
