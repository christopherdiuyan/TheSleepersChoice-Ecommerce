<?php 
    if(isset($_POST['product_id'])) {  
    $addmemberid = $_SESSION['member_id'];
    $addproductid = $_POST['product_id'];

    $result = mysql_query("SELECT count(w_p_id) cnt FROM wishlist WHERE w_m_id = '$addmemberid' AND w_p_id = '$addproductid'") or die(mysql_error());
    $countid = mysql_fetch_assoc($result);
    if($countid['cnt'] == 1){
        mysql_query("DELETE FROM wishlist WHERE w_p_id = '$addproductid' AND w_m_id = '$addmemberid'") or die(mysql_error()); // If product has already added to wishlist then remove from Database
        echo '0';
    } else {
        mysql_query("INSERT INTO wishlist SET w_p_id = '$addproductid', w_m_id = '$addmemberid'") or die(mysql_error()); // If product has not in wishlist then add to Database
         echo '1';
    }
}
?>