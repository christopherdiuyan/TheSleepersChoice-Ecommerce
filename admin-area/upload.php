<?php 
require_once("assets/php/config.php");

// Moves uploaded file to the directory
// if(!empty(basename($_FILES["inpFile1"]["name"])){
// 	$targetPath = Config::$productFilepath . basename($_FILES["inpFile1"]["name"]);
// 	move_uploaded_file($_FILES["inpFile1"]["tmp_name"], $targetPath);
// }
// if(!empty(basename($_FILES["inpFile2"]["name"])){
// 	$targetPath = Config::$productFilepath . basename($_FILES["inpFile2"]["name"]);
// 	move_uploaded_file($_FILES["inpFile2"]["tmp_name"], $targetPath);
// }
// if(!empty(basename($_FILES["inpFile3"]["name"])){
// 	$targetPath = Config::$productFilepath . basename($_FILES["inpFile3"]["name"]);
// 	move_uploaded_file($_FILES["inpFile3"]["tmp_name"], $targetPath);
// }
$targetPath = Config::$productFilepath . basename($_FILES["inpFile3"]["name"]);
	move_uploaded_file($_FILES["inpFile3"]["tmp_name"], $targetPath);



