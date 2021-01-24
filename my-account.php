<?php 
include_once("includes/header.php"); 


if(isset($_SESSION['user_uni_no']))
{
    $customerID = $_SESSION['user_uni_no'];
    $stmt = $connect->query("SELECT * FROM customers WHERE customer_u_id = '". $customerID ."'");
    $row = $stmt->fetch();
}
else
{
    $customerID = 0;
    echo "<script>window.open('login-register.php','_self')</script>";
}

?>
<style type="text/css">
.label {
    display: inline-block;
    padding: 1px 15px;
    border-radius: 25px;
    color: #fff;
    font-size: 13px;
    line-height: 23px;
    font-weight: 400;
    white-space: nowrap;
    cursor: default;
}
.label-danger {
    background-color: #ff4040;
}
.label-warning {
    background-color: #e16123;
}
.label-success {
    background-color: #009378;
}
.label-info {
    background-color: #5bc0de;
}
</style>
<link rel="stylesheet" href="custom.css">
<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li class="active">My account </li>
            </ul>
        </div>
    </div>
</div>
<!-- my account wrapper start -->
<div class="my-account-wrapper pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>   
                                <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>   
                              <!--   <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
                                    Method</a>    --> 
                                <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>    
                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>    
                                <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->    
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>    
                                        <div class="welcome">
                                            <p>Hello, <strong><?php echo $row['customer_name'] ?></strong> (If Not <strong><?php echo $row['customer_name'] ?>!</strong><a href="logout.php" class="logout"> Logout</a>)</p>
                                        </div>

                                        <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->    
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>    
                                        <div class="myaccount-table table-responsive text-center">
                                            <span class="order_details"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                               <!--  <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Payment Method</h3>
                                        <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                    </div>
                                </div> -->
                                <!-- Single Tab Content End -->    
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <span class="billing_details"></span>
                                        <a href="#" data-toggle="modal" data-target="#editDetails" id="<?php echo $customerID?>"><i class="fa fa-edit"></i><span class="ht-product-action-tooltip"> Edit Address</span></a>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->    
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>    
                                        <div class="account-details-form">
                                            <form action="POST" id="form-update-account">   
                                                <span class="account_details"></span>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn " id="update-account">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->

 <!-- Modal -->
<div class="modal fade" id="editDetails" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="myaccount-content col-md-12 col-sm-12 col-xs-12">
                    <h3>Contact Details</h3>    
                    <div class="account-details-form">
                        <form action="POST" id="form-update-address">  
                            <div class="single-input-item">
                                <label>Province <abbr class="required" title="required">*</abbr></label>
                                <input type="text" placeholder="Province" list="provinces" id="provices" value="<?php echo $row['customer_province']?>" required>
                                <datalist id="provinces">
                                    <option>Abra</option>
                                    <option>Agusan del Norte</option>
                                    <option>Agusan del Sur</option>
                                    <option>Aklan</option>
                                    <option>Albay</option>
                                    <option>Antique</option>
                                    <option>Apayao</option>
                                    <option>Aurora</option>
                                    <option>Basilan</option>
                                    <option>Bataan</option>
                                    <option>Batanes</option>
                                    <option>Batangas</option>
                                    <option>Benguet</option>
                                    <option>Biliran</option>
                                    <option>Bohol</option>
                                    <option>Bukidnon</option>
                                    <option>Bulacan</option>
                                    <option>Cagayan</option>
                                    <option>Camarines Norte</option>
                                    <option>Camarines Sur</option>
                                    <option>Camiguin</option>
                                    <option>Capiz</option>
                                    <option>Catanduanes</option>
                                    <option>Cavite</option>
                                    <option>Cebu</option>
                                    <option>Cotabato</option>
                                    <option>Davao de Oro</option>
                                    <option>Davao del Norte</option>
                                    <option>Davao del Sur</option>
                                    <option>Davao Occidental</option>
                                    <option>Davao Oriental</option>
                                    <option>Dinagat Islands</option>
                                    <option>Eastern Samar</option>
                                    <option>Guimaras</option>
                                    <option>Ifugao</option>
                                    <option>Ilocos Norte</option>
                                    <option>Ilocos Sur</option>
                                    <option>Iloilo</option>
                                    <option>Isabela</option>
                                    <option>Kalinga</option>
                                    <option>La Union</option>
                                    <option>Laguna</option>
                                    <option>Lanao del Norte</option>
                                    <option>Lanao del Sur</option>
                                    <option>Leyte</option>
                                    <option>Maguindanao</option>
                                    <option>Marinduque</option>
                                    <option>Masbate</option>
                                    <option>Metro Manila</option>
                                    <option>Misamis Occidental</option>
                                    <option>Misamis Oriental</option>
                                    <option>Mountain Province</option>
                                    <option>Negros Occidental</option>
                                    <option>Negros Oriental</option>
                                    <option>Northern Samar</option>
                                    <option>Nueva Ecija</option>
                                    <option>Nueva Vizcaya</option>
                                    <option>Occidental Mindoro</option>
                                    <option>Oriental Mindoro</option>
                                    <option>Palawan</option>
                                    <option>Pampanga</option>
                                    <option>Pangasinan</option>
                                    <option>Quezon</option>
                                    <option>Quirino</option>
                                    <option>Rizal</option>
                                    <option>Romblon</option>
                                    <option>Samar</option>
                                    <option>Sarangani</option>
                                    <option>Siquijor</option>
                                    <option>Sorsogon</option>
                                    <option>South Cotabato</option>
                                    <option>Southern Leyte</option>
                                    <option>Sultan Kudarat</option>
                                    <option>Sulu</option>
                                    <option>Surigao del Norte</option>
                                    <option>Surigao del Sur</option>
                                    <option>Tarlac</option>
                                    <option>Tawi-Tawi</option>
                                     <option>Zambales</option>
                                    <option>Zamboanga del Norte</option>
                                    <option>Zamboanga del Sur</option>
                                    <option>Zamboanga Sibugay</option>
                                </datalist>
                            </div>
                            <div class="single-input-item">
                                <label>City/Municipality, House Number, Building and Street Name <abbr class="required" title="required">*</abbr></label>
                                <input class="billing-address" placeholder="City/Municipality, House number and street name" id="billing-address" type="text" value="<?php echo $row['customer_address'] ?>" required>
                            <div class="single-input-item">
                            </div>
                                <label>Phone <abbr class="required" title="required">*</abbr></label>
                                <input type="number" maxlength="11" value="<?php echo $row['customer_contact']?>" id="contact-number" required>
                            </div>
                            <div class="single-input-item">
                                <button class="check-btn sqr-btn " id="update-address">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<?php include_once("includes/footer.php"); ?>

