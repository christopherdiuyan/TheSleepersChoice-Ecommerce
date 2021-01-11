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
<style>
    #overlay{
        text-align:center; 
        background: url('loading.gif') no-repeat center; 
        height: 150px;
    }
    </style>

    <script>
    $(document).ready(function(){

        filter_data();

        function filter_data()
        {
            $('#shop-products').html('<div id="overlay"></div>');
            var action = 'filter_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            //var brand = get_filter('brand');
            var cat = get_filter('cat');
            //var storage = get_filter('storage');
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, cat:cat},
                // data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, cat:cat, storage:storage},
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
            max:65000,
            values:[1000, 65000],
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
            Product details slider
        --------------------------- */
        

    });
    </script>
