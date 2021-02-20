<?php 

define('DB_HOST','sql312.epizy.com');
define('DB_USER','epiz_27931618');
define('DB_PASS','H82w9ix0F3f60e');
define('DB_NAME','epiz_27931618_thesleeperschoice');

// Establish database connection using PDO.
try
{
	$connect = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
	exit("Error: " . $e->getMessage());
}

?>
