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

		case 'update_order':
			$data = [
			    'orderID' => $_POST['orderID'],
			    'orderStatus' => $_POST['orderStatus'],
				];
			$sql = "UPDATE customer_orders SET 
			order_status=:orderStatus
			WHERE order_id=:orderID";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);
			break;

		case 'add_prodBasic':
			$data = [
			    'sku' => $_POST['prodID'],
			    'date' => date("Y-m-d H:i:s"),
			    'product_title' => $_POST['prodName'],
			    'product_desc' => $_POST['prodDesc'],
			    'product_category' => $_POST['prodCat'],
			    'product_img1' => "N/A",
			    'product_img2' => "N/A",
			    'product_img3' => "N/A",	
			    'product_color' => $_POST['prodColor'],
			    'product_size' => $_POST['prodSize'],
			    'product_price' => $_POST['prodPrice'],
			    'product_discount' => $_POST['prodDiscount'],
			    'product_stocks' => $_POST['prodStock'],
			    'product_keywords' => "N/A",
			    'product_status' => $_POST['prodAvailability'],
				];

			$sql = "INSERT INTO products 
			(sku, date, product_title, product_desc, product_category, product_img1, product_img2, product_img3, product_color, product_size, product_price, product_discount, product_stocks, product_keywords, product_status) 
			VALUES 
			(:sku, :date, :product_title, :product_desc, :product_category, :product_img1, :product_img2, :product_img3, :product_color, :product_size, :product_price, :product_discount, :product_stocks, :product_keywords, :product_status)";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);

			break;
		case 'delete_product':
			$data = [
			    'sku' => $_POST['prodID'],
				];

			$sql = "DELETE FROM products WHERE sku =:sku";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);

			break;

		case 'delete_category':
			$data = [
			    'p_cat_id' => $_POST['catID'],
				];

			$sql = "DELETE FROM product_categories WHERE p_cat_id =:p_cat_id";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);

			break;

		case 'update_category':
			// $catID = $_POST['catID'];
			// $catName = $_POST['catName'];
			// $isEditMode = $_POST['editMode'];
			// $filename = $_POST['filename'];
			// $filepath = $_POST['filepath'];
			
			// if(is_uploaded_file($filepath))
			// {
			// 	$file_name = $_FILES['catImg']['name'];
			// 	$file_temp = $_FILES['catImg']['tmp_name'];
			// 	$allowed_ext = array("jpeg", "jpg", "gif", "png");
			// 	$exp = explode(".", $file_name);
			// 	$ext = end($exp);
			// 	$path = Config::$categoryFilepath.$file_name;

			// 	if(in_array($ext, $allowed_ext))
			// 	{
			// 		if(move_uploaded_file($file_temp, $path))
			// 		{
			// 			if($isEditMode > 0)
			// 			{
			// 				try
			// 				{
			// 					$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// 					$sql = "UPDATE product_categories SET p_cat_title = '$catName',  p_cat_img = '$file_name' WHERE p_cat_id = '$catID'";
			// 					$connect->exec($sql);

			// 				}
			// 				catch(PDOException $e)
			// 				{
			// 					echo $e->getMessage();
			// 				}
			// 			}
			// 			else
			// 			{
			// 				try
			// 				{
			// 					$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// 					$sql = "INSERT INTO `product_categories`(p_cat_title, p_cat_img)  VALUES ('$catName', '$file_name')";
			// 					$connect->exec($sql);
			// 				}
			// 				catch(PDOException $e)
			// 				{
			// 					echo $e->getMessage();
			// 				}
			// 			}

			// 			$connect = null;
			// 		}
			// 	}else{
			// 		echo "<script>alert('Only image format can be upload')</script>";
			// 	}
			// }
			// else
			// {
			// 	try
			// 	{
			// 		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// 		$sql = "UPDATE product_categories SET p_cat_title = '$catName' WHERE p_cat_id = '$catID'";
			// 		$connect->exec($sql);
			// 	}
			// 	catch(PDOException $e)
			// 	{
			// 		echo $e->getMessage();
			// 	}

			// 	$connect = null;
			// }

			break;
			
		case 'delete_inquiry':
			$data = [
			    'inquiryID' => $_POST['inquiryID'],
				];

			$sql = "DELETE FROM inquiry WHERE inquiry_id =:inquiryID";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);

			break;

        case 'update_webite_content':
			$data = [
			    'id' => $_POST['id'],
			    'logo' => $_POST['logo'],
                'footer' => $_POST['footer'],
				];
			$sql = "UPDATE settings SET 
			company_logo=:logo,
            company_footer=:footer
			WHERE id=:id";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);
			break;

        case 'update_shop_details':
			$data = [
			    'id' => $_POST['id'],
			    'companyName' => $_POST['companyName'],
                'companyAddress' => $_POST['companyAddress'],
                'companyContact' => $_POST['companyContact'],
                'companyEmail' => $_POST['companyEmail'],
				];
			$sql = "UPDATE settings SET 
			company_name=:companyName,
            company_address=:companyAddress,
            company_contact=:companyContact,
            company_email=:companyEmail
			WHERE id=:id";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);
			break;

        case 'update_user_details':
			$data = [
			    'id' => $_POST['id'],
			    'admin_name' => $_POST['admin_name'],
                'admin_email' => $_POST['admin_email'],
			    'admin_address' => $_POST['admin_address'],
                'admin_contact' => $_POST['admin_contact'],
				];
			$sql = "UPDATE admins SET 
			admin_name=:admin_name,
            admin_email=:admin_email,
            admin_address=:admin_address,
            admin_contact=:admin_contact
			WHERE admin_id=:id";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);
			break;
	}
}
?>