<?php
session_start();
require_once('../../includes/db.php');
require_once('config.php');

if(isset($_POST["action"]))
{
	switch ($_POST["action"]) {
		case 'update_prodBasic':

			$data = [
			    'prodID' => $_POST['prodID'],
			    'prodName' => $_POST['prodName'],
			    'prodDesc' => $_POST['prodDesc'],
			    'prodCat' => $_POST['prodCat'],
			    'prodColor' => $_POST['prodColor'],
			    'prodSize' => $_POST['prodSize'],
			    'prodPrice' => $_POST['prodPrice'],
			    'prodDiscount' => $_POST['prodDiscount'],
			    'prodStock' => $_POST['prodStock'],
			    'prodAvailability' => $_POST['prodAvailability'],
				];
			$sql = "UPDATE products SET 
			product_title=:prodName, 
			product_desc=:prodDesc, 
			product_category=:prodCat,
			product_color=:prodColor, 
			product_size=:prodSize,
			product_price=:prodPrice, 
			product_discount=:prodDiscount,
			product_stocks=:prodStock, 
			product_status=:prodAvailability
			WHERE sku=:prodID";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);

			break;

		case 'update_prodImg':

			$data = [
				'prodID' => $_POST['prodID'],
			    'img1' => $_POST['img1'],
			    'img2' => $_POST['img2'],
			    'img3' => $_POST['img3'],
				];
			$sql = "UPDATE products SET 
			product_img1=:img1, 
			product_img2=:img2, 
			product_img3=:img3
			WHERE sku=:prodID";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);

			break;
	}
}

?>