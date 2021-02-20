<?php session_start();
require_once('../../includes/db.php');
require_once('config.php');

if(isset($_POST["action"]))
{
	switch ($_POST["action"]) {
		case 'add':
			if(isset($_SESSION["shopping_cart"]))
			{
				$is_available = 0;
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
					if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])
					{
						$is_available++;
						$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
					}
				}
				if($is_available == 0)
				{
					$item_array = array(
						'product_img'              =>     $_POST["product_img"], 
						'product_id'               =>     $_POST["product_id"],  
						'product_name'             =>     $_POST["product_name"],  
						'product_price'            =>     $_POST["product_price"],  
						'product_quantity'         =>     $_POST["product_quantity"]
					);
					$_SESSION["shopping_cart"][] = $item_array;
				}
			}
			else
			{
				$item_array = array(
					'product_img'              =>     $_POST["product_img"], 
					'product_id'               =>     $_POST["product_id"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],  
					'product_quantity'         =>     $_POST["product_quantity"]
				);
				$_SESSION["shopping_cart"][] = $item_array;
			}
			break;
		case 'remove':
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				if($values["product_id"] == $_POST["product_id"])
				{
					unset($_SESSION["shopping_cart"][$keys]);
				}
			}
			break;
		case 'empty':
			unset($_SESSION["shopping_cart"]);
			break;
		case 'checkout':
			$alph = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $orderID='';
            for($i=0;$i<6;$i++){
               $orderID .= $alph[rand(0, 35)];
            }
            $customerID = $_SESSION['user_uni_no'];
            $mode_of_payment = $_POST['mode_of_payment'];
            $order_status = "Order Placed";
            
            if(!empty($_SESSION["shopping_cart"]))
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
    				$sql = "INSERT INTO customer_orders
    				(order_id, customer_id, prod_id, prod_qty, prod_subtotal, mode_of_payment, order_date, order_status) 
				    VALUES
				    (:order_id, :customer_id, :prod_id, :prod_qty, :prod_subtotal, :mode_of_payment, :order_date, :order_status)";

				    $query = $connect->prepare($sql);
				    $prod_subtotal = ($values["product_quantity"] * $values["product_price"]);
				    $query->bindparam(':order_id', $orderID, PDO::PARAM_STR);
				    $query->bindparam(':customer_id', $customerID, PDO::PARAM_STR);
				    $query->bindparam(':prod_id', $values["product_id"], PDO::PARAM_STR);
				    $query->bindparam(':prod_qty', $values["product_quantity"], PDO::PARAM_STR);
				    $query->bindparam(':prod_subtotal', $prod_subtotal, PDO::PARAM_STR);
				    $query->bindparam(':mode_of_payment', $mode_of_payment, PDO::PARAM_STR);
				    $query->bindparam(':order_date', date("Y-m-d H:i:s"), PDO::PARAM_STR);
				    $query->bindparam(':order_status', $order_status, PDO::PARAM_STR);
				    $query->execute();

				    $lastInsertId = $connect->lastInsertId();
				}
				unset($_SESSION["shopping_cart"]);
			}
			break;
		case 'wishlist':
			if(isset($_SESSION["shopping_wishlist"]))
			{
				$is_available = 0;
				foreach($_SESSION["shopping_wishlist"] as $keys => $values)
				{
					if($_SESSION["shopping_wishlist"][$keys]['product_id'] == $_POST["product_id"])
					{
						$is_available++;
						$_SESSION["shopping_wishlist"][$keys]['product_quantity'] = $_SESSION["shopping_wishlist"][$keys]['product_quantity'] + $_POST["product_quantity"];
					}
				}
				if($is_available == 0)
				{
					$item_array = array(
						'product_img'              =>     $_POST["product_img"], 
						'product_id'               =>     $_POST["product_id"],  
						'product_name'             =>     $_POST["product_name"],  
						'product_price'            =>     $_POST["product_price"],  
						'product_quantity'         =>     $_POST["product_quantity"]
					);
					$_SESSION["shopping_wishlist"][] = $item_array;
				}
			}
			else
			{
				$item_array = array(
					'product_img'              =>     $_POST["product_img"], 
					'product_id'               =>     $_POST["product_id"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],  
					'product_quantity'         =>     $_POST["product_quantity"]
				);
				$_SESSION["shopping_wishlist"][] = $item_array;
			}
			break;
		case 'wishlist_to_cart':
			if(isset($_SESSION["shopping_cart"]))
			{
				$is_available = 0;
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
					if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])
					{
						$is_available++;
						$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
					}
				}
				if($is_available == 0)
				{
					$item_array = array(
						'product_img'              =>     $_POST["product_img"], 
						'product_id'               =>     $_POST["product_id"],  
						'product_name'             =>     $_POST["product_name"],  
						'product_price'            =>     $_POST["product_price"],  
						'product_quantity'         =>     $_POST["product_quantity"]
					);
					$_SESSION["shopping_cart"][] = $item_array;
				}
			}
			else
			{
				$item_array = array(
					'product_img'              =>     $_POST["product_img"], 
					'product_id'               =>     $_POST["product_id"],  
					'product_name'             =>     $_POST["product_name"],  
					'product_price'            =>     $_POST["product_price"],  
					'product_quantity'         =>     $_POST["product_quantity"]
				);
				$_SESSION["shopping_cart"][] = $item_array;
			}
			foreach($_SESSION["shopping_wishlist"] as $keys => $values)
			{
				if($values["product_id"] == $_POST["product_id"])
				{
					unset($_SESSION["shopping_wishlist"][$keys]);
				}
			}
			break;
		case 'update_address':

			$data = [
			    'customer_contact' => $_POST['customer_contact'],
			    'customer_province' => $_POST['customer_province'],
			    'customer_address' => $_POST['customer_address'],
			    'customer_u_id' => $_SESSION['user_uni_no'],
				];
			$sql = "UPDATE customers SET customer_contact=:customer_contact, customer_province=:customer_province, customer_address=:customer_address WHERE customer_u_id=:customer_u_id";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);

			break;
		case 'update_account':
			$data = [
			    'display_name' => $_POST['display_name'],
			    'email' => $_POST['email'],
			    'customer_u_id' => $_SESSION['user_uni_no'],
				];
			$sql = "UPDATE customers SET customer_name=:display_name, customer_email=:email WHERE customer_u_id=:customer_u_id";
			$stmt= $connect->prepare($sql);
			$stmt->execute($data);
			
			break;
	}
}

?>