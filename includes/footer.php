<?php 
require_once("db.php"); 
$stmt = $connect->query("SELECT * FROM settings");
$row = $stmt->fetch()
?>

<style type="text/css">
    .modal-header h5{
    font-weight: 700;
}
</style>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .modal-content * {
            visibility: visible;
            overflow: visible;
        }
        .modal-header * {
            visibility: hidden;
            overflow: hidden;
        }
        .invoice--actions * {
            visibility: hidden;
            overflow: hidden;
        }
        .main-page * {
            display: none;
        }
        .modal {
            position: absolute;
            left: 0;
            top: 0;
            margin: 0;
            padding: 0;
            min-height: 550px;
            visibility: visible;
            overflow: visible !important; /* Remove scrollbar for printing. */
        }
        .modal-dialog {
            visibility: visible !important;
            overflow: visible !important; /* Remove scrollbar for printing. */
        }
        @page {
            size: auto;   /* auto is the initial value */
            size: A4 portrait;
            margin: 0;  /* this affects the margin in the printer settings */
            border: 1px solid red;  /* set a border for all printed pages */
        }
    }

    </style>  
<footer class="footer-area bg-paleturquoise">
    <div class="footer-bottom border-top-1 pt-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="footer-social pb-20">
                        <a href="#">Facebok</a>
                        <a href="#">Twitter</a>
                        <a href="#">Linkedin</a>
                        <a href="#">Instagram</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="copyright text-center pb-20">
                        <p>Copyright © <?php echo date('Y'); echo " "; echo $row['company_footer'] ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-12">
                    <div class="payment-mathod pb-20">
                        <a href="#"><img src="assets/img/icon-img/payment.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="viewProduct" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Product Overview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body" id="prod-details">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewOrderDetails" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="myaccount-content col-md-12 col-sm-12 col-xs-12" id="invoice-details">
                    
                </div>
            </div>
        </div>
    </div>
</div>
  
</div>
 
<?php include_once("scripts.php");?>

</body>

</html>