<?php //require_once("includes/db.php"); ?>

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
    <script type="text/javascript">
        $(document).ready(function(){

        /*--
        Display Modal of Product Details
        -----------------------------------*/
        $(document).on('click', '.editProduct', function(){  
           var prodID = $(this).attr("id");  
           if(prodID != '')  
           {  
                $.ajax({  
                     url:"modal_prod_details.php",  
                     method:"POST",  
                     data:{prodID:prodID},  
                     success:function(data){  

                          $('#modal-edit-product').html(data);  
                          $('#editProduct').modal('show');  
                     }
                });  
            }            
        });

        /*--
        Display Modal of Customer Order
        -----------------------------------*/
        $(document).on('click', '.editOrder', function(){  
           var orderID = $(this).attr("id");  
           if(orderID != '')  
           {  
                $.ajax({  
                     url:"modal_order.php",  
                     method:"POST",  
                     data:{orderID:orderID},  
                     success:function(data){  

                          $('#modal-edit-order').html(data);  
                          $('#editOrder').modal('show');  
                     }
                });  
            }            
        });

        /*--
        Update Product Details
        -----------------------------------*/
        $(document).on('click', '.update-basic', function(e){

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var prodID = $(this).attr("id");
            var prodName = $('#prodName').val();
            var prodDesc = $('#prodDesc').val();
            var prodCat = $('#prodCat').val();
            var prodColor = $('#prodColor').val();
            var prodSize = $('#prodSize').val();
            var prodPrice = $('#prodPrice').val();
            var prodDiscount = $('#prodDiscount').val();
            var prodStock = $('#prodStock').val();
            var prodAvailability = $('input[name="prodAvailability"]:checked').val();

            var action = "update_prodBasic";

             $.ajax({
               type: "POST",
               url: "assets/php/process.php",
               data: {action:action, prodID:prodID, prodName:prodName, prodDesc:prodDesc, prodCat:prodCat, prodColor:prodColor, prodSize:prodSize, prodPrice:prodPrice, prodDiscount:prodDiscount, prodStock:prodStock, prodAvailability:prodAvailability},
               success: function(data)
               {
                    swal({
                      title: "Record Successfully Saved!",
                      text: "Your Record is now Updated.",
                      icon: "success",
                    });
                    setTimeout(function(){
                       window.location.reload(1);
                    }, 1000);
               }
            });
        }); 

        $(document).on('click', '.suploadPhoto', function(e){

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var prodID = $('#prodID').val();
            var upload11 = document.getElementById("upload1").value;
            var upload2 = document.getElementById("upload1");
            var upload3 = document.getElementById("upload1");
            var img1 = $('#img1').val();
            var img2 = $('#img2').val();
            var img3 = $('#img3').val();

            var upload1 = upload11 != '' ? document.getElementById("upload1").value : $('#img1').val();
            var action = "update_prodImg";
            alert(upload1);
            //  $.ajax({
            //    type: "POST",
            //    url: "assets/php/process.php",
            //    data: {action:action, prodID:prodID, img1:img1, img2:img2, img3:img3},
            //    success: function(data)
            //    {
            //         swal({
            //           title: "Record Successfully Saved!",
            //           text: "Your Record is now Updated.",
            //           icon: "success",
            //         });
            //         setTimeout(function(){
            //            window.location.reload(1);
            //         }, 1000);
            //    }
            // });
        }); 


        /*-----------------------
        Notification
        --------------------------- */

        function notify(type,message){
              (()=>{
                let n = document.createElement("div");
                let id = Math.random().toString(36).substr(2,10);
                n.setAttribute("id",id);
                n.classList.add("notification",type);
                n.innerText = message;
                document.getElementById("notification-area").appendChild(n);
                setTimeout(()=>{
                  var notifications = document.getElementById("notification-area").getElementsByClassName("notification");
                  for(let i=0;i<notifications.length;i++){
                    if(notifications[i].getAttribute("id") == id){
                      notifications[i].remove();
                      break;
                    }
                  }
                },5000);
              })();
          }

          function notifySuccess(message){
            notify("success", message);
          }
          function notifyError(){
            notify("error","Please Enter Number of Quantity");
          }
          function notifyInfo(){
            notify("info","This is demo info notification message");
          }


        });

    </script>

</body>

</html>