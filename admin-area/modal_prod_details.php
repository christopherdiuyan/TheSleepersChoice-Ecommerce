
<?php 
require_once('includes/db.php');
require_once('assets/php/config.php');

if(isset($_POST['prodID'])){

$sku = $_POST['prodID'];
$stmt = $connect->query("SELECT * FROM products WHERE sku = '". $sku ."'");
$row = $stmt->fetch();
$prod_name = $row['product_title'];
$prod_desc = $row['product_desc'];
$prod_cat = $row['product_category'];
$prod_color = $row['product_color'];
$prod_size = $row['product_size'];
$price = $row['product_price'];
$discount = $row['product_discount'];
$stock = $row['product_stocks'];
$availability = $row['product_status'];
$prodImgName1 = $row['product_img1'];
$prodImgName2 = $row['product_img2'];
$prodImgName3 = $row['product_img3'];
$prodImg1 =  file_exists(Config::$productFilepath . $row['product_img1']) ? Config::$productFilepath . $row['product_img1'] : Config::$productFilepath . Config::$defaultProdImg ;
$prodImg2 =  file_exists(Config::$productFilepath . $row['product_img2']) ? Config::$productFilepath . $row['product_img2'] : Config::$productFilepath . Config::$defaultProdImg ;
$prodImg3 =  file_exists(Config::$productFilepath . $row['product_img3']) ? Config::$productFilepath . $row['product_img3'] : Config::$productFilepath . Config::$defaultProdImg ;

$priceOld = $row['product_discount'] > 0 ? "₱ ". number_format($row['product_price'], 2, '.', ',') : "";
}
?>
<style type="text/css">
    #upload_link1, #upload_link2, #upload_link3{
    text-decoration:none;
    }
    #upload1, #upload2, #upload3{
        display:none
    }
    .prodImg-size{
        width: 155px; height: 190px
    }
    .custom-file{
        padding-right: 100px;
        margin-top: 20px;
    }
</style>
<div class="panel">
    <!-- Edit Product Start -->
    <div class="records--body">
        <div class="title">
            <h6 class="h6">Product Details</h6>

            <a href="#" class="btn btn-rounded btn-outline-danger">Delete Product</a>
        </div>

        <!-- Tabs Nav Start -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#tab01" data-toggle="tab" class="nav-link active">Basic</a>
            </li>
            <li class="nav-item">
                <a href="#tab02" data-toggle="tab" class="nav-link">Meta/SEO</a>
            </li>
            <li class="nav-item">
                <a href="#tab03" data-toggle="tab" class="nav-link">Images</a>
            </li>
        </ul>
        <!-- Tabs Nav End -->

        <!-- Tab Content Start -->
        <div class="tab-content">
            <!-- Tab Pane Start -->
            <div class="tab-pane fade show active" id="tab01">
                <form id="form-update-basic" action="POST">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                        <div class="col-md-9">
                            <input type="hidden" name="text" id="prodID" value="<?php echo $sku?>">
                            <input type="text" name="text" class="form-control" id="prodName" value="<?php echo $prod_name?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Description: *</span>

                        <div class="col-md-9">
                            <textarea name="textarea" class="form-control" id="prodDesc" required><?php echo $prod_desc?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Category:</span>
                        <div class="col-md-9">
                        <select name="select" id="prodCat" class="form-control">
                        <option><?php echo $prod_cat ?></option>
                        <?php
                        $query = "SELECT * FROM product_categories WHERE p_cat_title != '$prod_cat' ORDER BY p_cat_title"; 
                        $statement = $connect->prepare($query);
                        $statement->execute();
                        $result = $statement->fetchAll();

                        foreach($result as $row) 
                        { 
                        ?>
                            <option><?php echo $row['p_cat_title']; ?></option>
                        
                        <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Color: *</span>

                        <div class="col-md-9">
                            <input type="text" name="text" class="form-control" id="prodColor" value="<?php echo $prod_color?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Size: *</span>

                        <div class="col-md-9">
                            <input type="text" name="text" class="form-control" id="prodSize" value="<?php echo $prod_size?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Price: *</span>
                        <div class="input-group col-md-9">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="number" name="number" id="prodPrice" value="<?php echo $price ?>" min="0" max="100000" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Discount: *</span>
                        <div class="input-group col-md-9">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input type="number" name="number" id="prodDiscount" value="<?php echo $discount ?>" min="0" max="100" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Stocks: *</span>
                        <div class="input-group col-md-9">
                            <input type="number" name="number" id="prodStock" value="<?php echo $stock ?>"   class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Availability: *</span>
                        <div class="col-md-9 form-inline">
                            <label class="form-radio mr-3">
                                <input type="radio" name="prodAvailability" value="1" class="form-radio-input" <?php echo $availability > 0 ? "checked" : ""?>>
                                <span class="form-radio-label">Publish</span>
                            </label>

                            <label class="form-radio">
                                <input type="radio" name="prodAvailability" value="0" class="form-radio-input" <?php echo $availability > 0 ? "" : "checked"?> >
                                <span class="form-radio-label">Don't Publish</span>
                            </label>
                        </div>
                    </div>
                     <div class="row mt-3">
                        <div class="col-md-9 offset-md-3"> 
                            <input value="Update Product" id="<?php echo $sku?>" class="btn btn-block btn-success update-basic">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Tab Pane End -->

            <!-- Tab Pane Start -->
            <div class="tab-pane fade" id="tab02">
                <form action="#">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">SEO Description:</span>

                        <div class="col-md-9">
                            <textarea name="textarea" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3"> 
                            <input type="submit" value="Update Product" class="btn btn-block btn-success">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Tab Pane End -->

            <!-- Tab Pane Start -->
            <div class="tab-pane fade" id="tab03">
                <form enctype="multipart/form-data" id="uploadImg">
                    <div class="row md-6">
                        <div class="col-md-6">
                            <div class="pricing--item text-center text-white mb-4">
                                
                                <div class="pricing--header text-uppercase">
                                    <button type="button" class="close delete_prodImg">&times;</button>
                                    <h3 class="text-lightergray h6"><?php echo $prodImgName1 ?></h6>
                                </div>
                                <div class="pricing--features">
                                    <img src="<?php echo $prodImg1 ?>" class="prodImg-size">
                                    <input type="hidden" name="hidden_img" id="img2" value="<?php echo $prodImg2?>" />
                                </div>

                                <div class="col-md-14">
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*">
                                        <span class="custom-file-label"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pricing--item text-center text-white mb-4">
                                
                                <div class="pricing--header text-uppercase">
                                    <button type="button" class="close delete_prodImg">&times;</button>
                                    <h3 class="text-lightergray h6"><?php echo $prodImgName2 ?></h6>
                                </div>
                                <div class="pricing--features">
                                    <img src="<?php echo $prodImg2 ?>" class="prodImg-size">
                                    <input type="hidden" name="hidden_img" id="img2" value="<?php echo $prodImg2?>" />
                                </div>

                                <div class="col-md-14">
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*">
                                        <span class="custom-file-label"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pricing--item text-center text-white mb-4">
                                
                                <div class="pricing--header text-uppercase">
                                    <button type="button" class="close delete_prodImg">&times;</button>
                                    <h3 class="text-lightergray h6"><?php echo $prodImgName3 ?></h6>
                                </div>
                                <div class="pricing--features">
                                    <img src="<?php echo $prodImg3 ?>" class="prodImg-size">
                                    <input type="hidden" name="hidden_img" id="img2" value="<?php echo $prodImg2?>" />
                                </div>

                                <div class="col-md-12">
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*">
                                        <span class="custom-file-label"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pricing--item text-center text-white mb-4">
                                
                                <div class="pricing--header text-uppercase">
                                    <button type="button" class="close delete_prodImg">&times;</button>
                                    <h3 class="text-lightergray h6"><?php echo $prodImgName1 ?></h6>
                                </div>
                                <div class="pricing--features">
                                    <img src="<?php echo $prodImg1 ?>" class="prodImg-size">
                                    <input type="hidden" name="hidden_img" id="img2" value="<?php echo $prodImg2?>" />
                                </div>

                                <div class="col-md-14">
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*">
                                        <span class="custom-file-label"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row md-6">
                        <button class="btn btn-block btn-info">Save Changes</button>
                    </div>
                </form>
            </div>
            <!-- Tab Pane End -->
        </div>
        <!-- Tab Content End -->
    </div>
    <!-- Edit Product End -->
</div>
<?php 
if (isset($_POST['UploadPhoto'])) {
    // $target = "images/".basename($_FILES['image']['name']);
    // $ImageName = $_FILES['photo']['name'];
    // $fileElementName = 'image';
    // $path = 'images/';
    // $location = $path . $_FILES['image']['name'];
    // move_uploaded_file($_FILES['image']['tmp_name'], $location);
    // $image = $_FILES['image']['name'];
    // if (!empty($_FILES['image']['name'])) {
    //     $sqlUploadPhoto = "UPDATE employee SET image='$image' WHERE EmpId = '$EmpId'";
    // }
    // mysqli_query($con, $sqlUploadPhoto);
    // $page = $_SERVER['REQUEST_URI'];
    // echo '<script type="text/javascript">';
    // echo 'window.location.href="pm-profile.php";';
    // echo '</script>';
}
?>
<script type="text/javascript">
$(function(){
    // $("#upload_link1").on('click', function(e){
    //     e.preventDefault();
    //     $("#upload1:hidden").trigger('click');
    // });
    // $("#upload_link2").on('click', function(e){
    //     e.preventDefault();
    //     $("#upload2:hidden").trigger('click');
    // });
    // $("#upload_link3").on('click', function(e){
    //     e.preventDefault();
    //     $("#upload3:hidden").trigger('click');
    // });
});
</script>
<script>
const uploadImg = document.getElementById("uploadImg");
const inpFile3 = document.getElementById("inpFile3");

uploadImg.addEventListener("submit", e => {
    e.preventDefault();

    const endpoint = "upload.php";
    const formData = new FormData();

    formData.append("inpFile3", inpFile3.files[0]);

    fetch(endpoint, {
        method: "post",
        body: formData
    }).catch(console.error);
});
</script>