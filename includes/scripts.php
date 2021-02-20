<!-- All JS is here
============================================ -->

<!-- jQuery JS -->
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper JS -->
<script src="assets/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>
<!-- Ajax Mail -->
<script src="assets/js/ajax-mail.js"></script> 
<!-- Main JS -->
<script src="assets/js/main.js"></script>
<!-- Sweet Alert JS -->
<script src="assets/js/sweetalert.min.js"></script>
<!-- New JS -->
<script src="https://www.paypal.com/sdk/js?client-id=ASa8wQRrQd_bJea14dVzf7xKE0Hv68N7uW9fzjKVaNU_ZGRz4nG3kUjaT2AyI_1RHlCm8-RhnMAJiMiH&currency=PHP&disable-funding=credit,card" data-sdk-integration-source="button-factory"></script>
<script>
    $(document).ready(function(){
        
        filter_data();
        load_cart_data();
        load_viewcart_data();
        load_checkout_data();
        load_orders_data();
        load_wishlist_data();
        // Customer
        load_billing_address_data();
        load_account_details_data();

        function filter_data()
        {
            $('#shop-products').html('<div id="overlay"></div>');
            var action = 'filter_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var cat = get_filter('cat');
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, cat:cat},
                success:function(data){
                    $('#shop-products').html(data);
                }
            });

            $('#shop-products-list').html('<div id="overlay"></div>');
            var action_list = 'filter_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var cat = get_filter('cat');
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action_list:action_list, minimum_price:minimum_price, maximum_price:maximum_price, cat:cat},
                success:function(data){
                    $('#shop-products-list').html(data);
                }
            });
        }

        function get_filter(class_name)
        {
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function(){
            filter_data();
        });
        /*---------------------
            Price slider
        --------------------- */
        
        var amountprice = $('#amount');
        $('#slider-range').slider({
            range:true,
            min:1000,
            max:10000,
            values:[1000, 10000],
            slide:function(event, ui)
            {
                amountprice.val("₱" + ui.values[0] + " - ₱" + ui.values[1]);
                $('#amount').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                filter_data();
            }
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
        function alertEmptycart(){
            swal({
              title: "Looks like your cart is empty!",
              text: "Do you want to shop now?",
              icon: "warning",
              buttons: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location = "shop.php";
              } else {
                return false;
              }
            });
        }  

        function alertNotLogin(){
            swal({
              title: "Looks like you are not login.",
              text: "Login Now!",
              icon: "info",
              buttons: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location = "login-register.php";
              } else {
                return false;
              }
            });
        } 

        /*-----------------------
            Load Data
        --------------------------- */
        function load_cart_data()
        {
            $.ajax({
                url:"assets/php/fetch_cart.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    $('.cart_details').html(data.cart_details);
                    $('.cart-price').text(data.total_price);
                    $('.count-style').text(data.total_item);
                }
            });
        }

        function load_viewcart_data()
        {
            $.ajax({
                url:"assets/php/fetch_cart_page.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    $('.viewcart_details').html(data.cart_details);
                    $('.total-price').text(data.total_price);
                }
            });
        }

        function load_checkout_data()
        {
            $.ajax({
                url:"assets/php/fetch_checkout.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    $('#checkout_details').html(data.checkout_details);
                }
            });
        }

        function load_orders_data()
        {
            $.ajax({
                url:"assets/php/fetch_orders.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    $('.order_details').html(data.order_details);
                }
            });
        }

        function load_wishlist_data()
        {
            $.ajax({
                url:"assets/php/fetch_wishlist.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    $('.wishlist_details').html(data.wishlist_details);
                    $('.wishlist-count-style').text(data.total_item);
                }
            });
        }

        /*
        Customer
        */
        function load_billing_address_data()
        {
            $.ajax({
                url:"assets/php/fetch_billing_address.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    $('.billing_details').html(data.billing_details);
                }
            });
        }

        function load_account_details_data()
        {
            $.ajax({
                url:"assets/php/fetch_account_details.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    $('.account_details').html(data.account_details);
                }
            });
        }

        /*-----------------------
            Core functions - Cart
        --------------------------- */
        $(document).on('click', '.add_to_cart', function(){
            var product_id = $(this).attr("id");
            var product_img = $('#img'+product_id+'').val();
            var product_name = $('#name'+product_id+'').val();
            var product_price = $('#price'+product_id+'').val();
            var product_quantity = $('input[name="qtybutton"]').val();
            var action = "add";
            
            if(product_quantity > 0)
            {
                $.ajax({
                    url:"assets/php/cart_process.php",
                    method:"POST",
                    data:{product_id:product_id, product_img:product_img, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
                    success:function(data)
                    {
                        load_cart_data();
                        load_viewcart_data();
                        load_checkout_data();
                        notifySuccess("Item has been added into cart.");
                    }
                });
            }
            else
            {
                notifyError();
            }
        });

        $(document).on('click', '.delete', function(){
            var product_id = $(this).attr("id");
            var action = 'remove';
            swal({
              title: "Are you sure?",
              text: "Once deleted, this product will remove from your cart.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url:"assets/php/cart_process.php",
                    method:"POST",
                    data:{product_id:product_id, action:action},
                    success:function()
                    {
                        load_cart_data();
                        load_viewcart_data();
                        load_checkout_data();
                        swal("Product ID: "+product_id+" is successfully removed.", {
                          icon: "success",
                        });
                    }
                })
              } else {
                return false;
              }
            });
        }); 

        $(document).on('click', '#clear_cart', function(){
            var hasItem = $('#hasItem').val();
            var action = 'empty';
            
            if(hasItem > 0)
            {
                swal({
                  title: "Are you sure?",
                  text: "Once deleted, all products will remove from your cart.",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                        $.ajax({
                        url:"assets/php/cart_process.php",
                        method:"POST",
                        data:{action:action},
                        success:function()
                        {
                            load_cart_data();
                            load_viewcart_data();
                            load_checkout_data();
                            swal("All items are successfully removed.", {
                              icon: "success",
                            });
                        }
                    });
                  } else {
                    return false;
                  }
                });
            }
            else
            {
                alertEmptycart();
            }
        });

        /*-----------------------
            Core functions - Wishlist
        --------------------------- */
        $(document).on('click', '.add_to_wishlist', function(){
            var product_id = $(this).attr("id");
            var product_img = $('#img'+product_id+'').val();
            var product_name = $('#name'+product_id+'').val();
            var product_price = $('#price'+product_id+'').val();
            var product_quantity = $('#quantity'+product_id).val();
            var action = "wishlist";
            if(product_quantity > 0)
            {
                $.ajax({
                    url:"assets/php/cart_process.php",
                    method:"POST",
                    data:{product_id:product_id, product_img:product_img, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
                    success:function(data)
                    {
                        load_wishlist_data();
                        notifySuccess("Item has been added into wishlist.");
                    }
                });
            }
            else
            {
                notifyError();
            }
        });

        /*-----------------------
            Core functions - Wishlist to Cart
        --------------------------- */
        $(document).on('click', '.add_wishlist_to_cart', function(){
            var product_id = $(this).attr("id");
            var product_img = $('#img'+product_id+'').val();
            var product_name = $('#name'+product_id+'').val();
            var product_price = $('#price'+product_id+'').val();
            var product_quantity = $('#quantity'+product_id).val();
            var action = "wishlist_to_cart";
            if(product_quantity > 0)
            {
                $.ajax({
                    url:"assets/php/cart_process.php",
                    method:"POST",
                    data:{product_id:product_id, product_img:product_img, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
                    success:function(data)
                    {
                        load_wishlist_data();
                        load_cart_data();
                        load_viewcart_data();
                        load_checkout_data();
                        notifySuccess("Item from your wishlist has been added into cart.");
                    }
                });
            }
            else
            {
                notifyError();
            }
        });

        //Update Customer Address
        $("#form-update-address #update-address").click(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var customer_province = $('#provices').val();
            var customer_address = $('#billing-address').val();
            var customer_contact = $('#contact-number').val();
            var action = "update_address";

             $.ajax({
               type: "POST",
               url: "assets/php/cart_process.php",
               data: {action:action, customer_province:customer_province, customer_address:customer_address, customer_contact:customer_contact},
               success: function(data)
               {
                    load_billing_address_data();
                    swal({
                      title: "Record Successfully Saved!",
                      text: "Your Record is now Updated.",
                      icon: "success",
                    });
               }
            });
        }); 

         //Update Customer Account Details
        $("#form-update-account #update-account").click(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var display_name = $('#display-name').val();
            var email = $('#email').val();
            var action = "update_account";

             $.ajax({
               type: "POST",
               url: "assets/php/cart_process.php",
               data: {action:action, display_name:display_name, email:email},
               success: function(data)
               {
                    console.log(data);
                    load_account_details_data();
                    swal({
                      title: "Record Successfully Saved!",
                      text: "Your Record is now Updated.",
                      icon: "success",
                    });
               },
               error:function(data)
               {
                console.log(data);
               }
            });
        }); 
        /*--
        Display Modal of Product Overview
        -----------------------------------*/
        $(document).on('click', '.show-modal', function(){  
           var prodID = $(this).attr("id");  
           if(prodID != '')  
           {  
                $.ajax({  
                     url:"modal_product.php",  
                     method:"POST",  
                     data:{prodID:prodID},  
                     success:function(data){  
                          $('#prod-details').html(data);  
                          $('#viewProduct').modal('show');  
                     }  
                });  
            }            
        });

        /*--
        Display Modal of Invoice
        -----------------------------------*/
        $(document).on('click', '.view-orders', function(){  
           var orderID = $(this).attr("id");  

           if(orderID != '')  
           {  
                $.ajax({  
                     url:"modal_invoice.php",  
                     method:"POST",  
                     data:{orderID:orderID},  
                     success:function(data){

                          $('#invoice-details').html(data);  
                          $('#viewOrderDetails').modal('show');  
                     },
                     error: function(data){
                        console.log(data);
                     }
                });  
            }            
        });
        /*--
        Cart active
        -----------------------------------*/
        if ($('.cart-wrap').length) {
            var $body = $('body'),
                $cartWrap = $('.cart-wrap'),
                $cartContent = $cartWrap.find('.shopping-cart-content');
            $cartWrap.on('click', '.icon-cart-active', function(e) {
                e.preventDefault();
                var $this = $(this);
                if (!$this.parent().hasClass('show')) {
                    $this.siblings('.shopping-cart-content').addClass('show').parent().addClass('show');
                } else {
                    $this.siblings('.shopping-cart-content').removeClass('show').parent().removeClass('show');
                }
            });
            /*Close When Click Close Button*/
            $cartWrap.on('click', '.cart-close', function(e) {
                e.preventDefault();
                var $this = $(this);
                $this.closest('.cart-wrap').removeClass('show').find('.shopping-cart-content').removeClass('show');
            });
            /*Close When Click Outside*/
            $body.on('click', function(e) {
                var $target = e.target;
                if (!$($target).is('.cart-wrap') && !$($target).parents().is('.cart-wrap') && $cartWrap.hasClass('show')) {
                    $cartWrap.removeClass('show');
                    $cartContent.removeClass('show');
                }
            });
        }

         /*-----------------------
            Place Order - Cash on Delivery
        --------------------------- */
        $(document).on('click', '.place-order-COD', function(){
            var mode_of_payment = $('input[name="payment_method"]:checked').val();
            var action = "checkout";
            var hasCustomer = $('#hasCustomer').val();

            if(hasCustomer != 0){
                    $.ajax({
                    type: "POST",
                    url: "assets/php/cart_process.php",
                    data: {action:action, mode_of_payment:mode_of_payment},
                    success: function(data)
                    {
                            load_cart_data();
                            load_viewcart_data();
                            load_checkout_data();
                            window.location = "thank-you.php";
                    },error:function(data){console.log(data);}
                    });
                }else{
                    alertNotLogin();
                }
        });

         /*--
        Paypal Integration
        -----------------------------------*/
       function initPayPalButton() {
            var total_amount = $('#total-amount').val();
          paypal.Buttons({
            style: {
              shape: 'rect',
              color: 'gold',
              layout: 'vertical',
              label: 'checkout',
              
            },

            createOrder: function(data, actions) {
              return actions.order.create({
                purchase_units: [{"amount":{"currency_code":"PHP","value":total_amount}}]
              });
            },

            onApprove: function(data, actions) {
              return actions.order.capture().then(function(details) {
                var mode_of_payment = $('input[name="payment_method"]:checked').val();
                var action = "checkout";
                
                var hasCustomer = $('#hasCustomer').val();
                
                if(hasCustomer != 0){
                    $.ajax({
                       type: "POST",
                       url: "assets/php/cart_process.php",
                       data: {action:action, mode_of_payment:mode_of_payment},
                       success: function(data)
                       {
                            load_cart_data();
                            load_viewcart_data();
                            load_checkout_data();
                            window.location = "thank-you.php";
                       },error:function(data){console.log(data);}
                     });
                }else{
                    alertNotLogin();
                }
                
              });

            },

            onError: function(err) {
              console.log(err);
            }
          }).render('#place-order');
        }
        initPayPalButton();

         function alertNotLogin(){
            swal({
              title: "Looks like you are not login.",
              text: "Login Now!",
              icon: "info",
              buttons: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location = "login-register.php";
              } else {
                return false;
              }
            });
        } 
        
        /*--
        Setting active
        -----------------------------------*/
        if ($('.setting-wrap').length) {
            var $body2 = $('body'),
                $parloDropdown2 = $('.setting-wrap'),
                $parloDropdownMenu2 = $parloDropdown2.find('.setting-content');
            $parloDropdown2.on('click', '.setting-active', function(e) {
                e.preventDefault();
                var $this = $(this);
                if (!$this.parent().hasClass('show')) {
                    $this.siblings('.setting-content').addClass('show').slideDown().parent().addClass('show');
                } else {
                    $this.siblings('.setting-content').removeClass('show').slideUp().parent().removeClass('show');
                }
            });
            /*Close When Click Outside*/
            $body2.on('click', function(e) {
                var $target = e.target;
                if (!$($target).is('.setting-wrap') && !$($target).parents().is('.setting-wrap') && $parloDropdown2.hasClass('show')) {
                    $parloDropdown2.removeClass('show');
                    $parloDropdownMenu2.removeClass('show').slideUp();
                }
            });
        }

        /*--
        Validations
        -----------------------------------*/
        $(document).ready(function () {
          //called when key is pressed in textbox
          $("#contact-number").keypress(function (e) {
             
             var maxlengthNumber = parseInt($('#contact-number').attr('maxlength'));
             var inputValueLength = $('#contact-number').val().length + 1;
             if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                
                       return false;
            }
            if(maxlengthNumber < inputValueLength) {
                return false;
            }
           });
        });
    });
   
</script>
<script>
    /*--
        PHPMailer
        -----------------------------------*/
        function sendEmail() {   
        var name = $("#cf_name").val();
        var email = $("#cf_email").val();
        var subject = $("#cf_subject").val();
        var message = $("#cf_message").val();
        
            if(name != '' && email != '' && subject != '' && message != ''){
                $.ajax({
              url: '../mail.php',
              method: 'POST',
              dataType: 'json',
              data: {
                  name: name,
                  email: email,
                  subject: subject,
                  message: message
              }, success: function (response) {
                    $('#contact-form')[0].reset();
                    swal({
                      title: "Thank you!",
                      text: "Your Response has been sent.",
                      icon: "success",
                      button: "No Prob!",
                    });
              },error:function(response){
                  $('#contact-form')[0].reset();
                    swal({
                      title: "Thank you!",
                      text: "Your Response has been sent.",
                      icon: "success",
                      button: "No Prob!",
                    });
                   
              }
                    
            });
            }else
            {
                swal({
                  title: "Missing Fields!",
                  text: "Looks like you have missed some fields.",
                  icon: "warning",
                  button: "Okay",
                });
            }
        }
            var validateEmail = function(elementValue) {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(elementValue);
        }
        $('#email').keyup(function() {
        
            var value = $(this).val();
            var valid = validateEmail(value);
        
            if (!valid) {
                $(this).css('color', 'red');
                $('.addbut1').prop('disabled', true);
            } else {
                $(this).css('color', '#2bb673');
                $('.addbut1').prop('disabled', false);
            }
        });
        
        const newsletter = {};
        
        newsletter.main = document.querySelector('.main');
        newsletter.form = document.querySelector('.main > #singular-form');
        newsletter.subs = document.querySelector('.main > #singular-form > button#subs');
        newsletter.input = document.querySelector('.main>#singular-form>#email-input>input');
        newsletter.submitButton = document.querySelector('.main > #singular-form > #email-input > button');
        newsletter.successMessage = document.querySelector('.main > #singular-form > #success');
        
        newsletter.submitDelay = 1000;
        
        newsletter.clickHandler = (e) => {
            switch (e.target) {
                case newsletter.subs:
                    console.log('case subs');
                    newsletter.main.style.width = '30rem'
                    e.target.classList.remove('shown');
                    newsletter.input.classList.add('shown');
                    newsletter.submitButton.classList.add('shown');
                    newsletter.input.focus();
                    break;
                case newsletter.submitButton:
                    newsletter.submitForm();
                    break;
            }
        }
        newsletter.handleInputKeypress = (e) => {
            if (e.keyCode === 13) {
                e.preventDefault();
                newsletter.submitForm();
            }
        }
        newsletter.submitForm = () => {
            newsletter.input.style.transition = 'all .6s ease';
            newsletter.submitButton.style.transition = 'all .6s ease';
            newsletter.input.classList.remove('shown');
            newsletter.submitButton.classList.remove('shown');
            newsletter.main.style.transition = 'all .6s cubic-bezier(0.47, 0.47, 0.27, 1.20) .4s';
            newsletter.main.style.width = '';
            newsletter.successMessage.classList.add('shown');
            let submission = setTimeout(() => newsletter.form.submit(), newsletter.submitDelay);
        }
        
        newsletter.input.addEventListener('keypress', (e) => newsletter.handleInputKeypress(e));
        document.addEventListener('click', (e) => newsletter.clickHandler(e));
</script>