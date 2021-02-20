<?php //require_once("includes/db.php"); ?>
  <!-- Vertically Centered Modal Start -->
    <div id="editOrder" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" id="modal-edit-order">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
   <!-- Vertically Centered Modal Start -->
    <div id="viewCustomer" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" id="modal-view-customer">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
   <!-- Vertically Centered Modal Start -->
    <div id="viewInquiry" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" >
                     <div class="panel">
                        <!-- App Start -->
                        <div class="app_wrapper row">
                            <!-- App Content Start -->
                            <div class="app_content col-lg-12">
                                <!-- Mail Compose Start -->
                                <div class="mail-compose">
                                    <h3 class="mail-compose__title">Reply Inquiry</h3>
                                    <form action="#" method="post">
                                        <span id="modal-view-inquiry"></span>
                                        <div class="btn-list pt-3"  style="text-align:center">
                                            <button type="button" onclick="sendEmail()" class="btn btn-lg btn-rounded btn-success w-50">Send <i class="far fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Mail Compose End -->
                            </div>
                            <!-- App Content End -->
                        </div>
                        <!-- App Sidebar End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
    <!-- Vertically Centered Modal Start -->
    <div id="addInquiry" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" >
                     <div class="panel">
                        <!-- App Start -->
                        <div class="app_wrapper row">
                            <!-- App Content Start -->
                            <div class="app_content col-lg-12">
                                <!-- Mail Compose Start -->
                                <div class="mail-compose">
                                    <h3 class="mail-compose__title">Compose New Message</h3>
                                    <form action="#" method="post">
                                        <span id="modal-add-inquiry"></span>
                                        <div class="btn-list pt-3"  style="text-align:center">
                                            <button type="button" onclick="sendEmail()" class="btn btn-lg btn-rounded btn-success w-50">Send <i class="far fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Mail Compose End -->
                            </div>
                            <!-- App Content End -->
                        </div>
                        <!-- App Sidebar End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
     <!-- Vertically Centered Modal Start -->
    <div id="editUser" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" id="modal-edit-user">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
     <!-- Vertically Centered Modal Start -->
    <div id="addUser" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" id="modal-add-user">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically Centered Modal End -->
  </div>
    <!-- Wrapper End -->
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <script src="assets/js/raphael.min.js"></script>
    <script src="assets/js/morris.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery-jvectormap.min.js"></script>
    <script src="assets/js/jquery-jvectormap-world-mill.min.js"></script>
    <script src="assets/js/horizontal-timeline.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/jquery.steps.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script src="assets/js/ion.rangeSlider.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetalert.min-1.js"></script>
    <!-- Page Level Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/phpmailer.js"></script>
    <script src="assets/js/summernote-bs4.min.js"></script>
    <script src="assets/js/summernote-bs4-init.js"></script>
</body>

</html>