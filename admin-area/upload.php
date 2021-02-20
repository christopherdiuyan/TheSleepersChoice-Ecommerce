<?php
require_once("includes/db.php");
require_once("assets/php/config.php");
 
if(isset($_POST['upload'])){

	$catName = $_POST['catName'];
	$isEditMode = $_POST['editMode'];
    if($isEditMode == 1){$catID = $_POST['catID'];}
	if(is_uploaded_file($_FILES['catImg']['tmp_name']))
	{
		$file_name = $_FILES['catImg']['name'];
		$file_temp = $_FILES['catImg']['tmp_name'];
		$allowed_ext = array("jpeg", "jpg", "gif", "png");
		$exp = explode(".", $file_name);
		$ext = end($exp);
		$path = Config::$categoryFilepath.$file_name;

		if(in_array($ext, $allowed_ext))
		{
			if(move_uploaded_file($file_temp, $path))
			{
				if($isEditMode == 0)
				{
    				try
    				{
    					$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    					$sql = "INSERT INTO `product_categories`(p_cat_title, p_cat_img)  VALUES ('$catName', '$file_name')";
    					$connect->exec($sql);
    				}
    				catch(PDOException $e)
    				{
    					echo $e->getMessage();
    				}
				}
				else
				{
				    try
            		{
            			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            			$sql = "UPDATE product_categories SET p_cat_title = '$catName', p_cat_img = '$file_name' WHERE p_cat_id = '$catID'";
            			$connect->exec($sql);
            		}
            		catch(PDOException $e)
            		{
            			echo $e->getMessage();
            		}
				}

				$connect = null;
				header('location: categories.php');
			}
		}else{
			echo "<script>alert('Only image format can be upload')</script>";
		}
	}
	else
	{
		try
		{
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE product_categories SET p_cat_title = '$catName' WHERE p_cat_id = '$catID'";
			$connect->exec($sql);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}

		$connect = null;
		header('location: categories.php');
	}
}
