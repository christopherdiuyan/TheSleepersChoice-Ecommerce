<?php
session_start(); //start session
include_once("config.php"); 
include_once("../../includes/db.php"); 

if(isset($_POST['login'])){
    
    $admin_email = $_POST['user-email'];
    $admin_pass = $_POST['user-password'];

    $sql = "SELECT * FROM admins WHERE admin_email='$admin_email'";
    $stmt = $connect->query($sql);
    $row = $stmt->fetch();

    if(password_verify($admin_pass, $row["admin_pass"]))  
    {  
        $_SESSION['admin_id'] = $row["admin_id"];
        $_SESSION['admin_name'] = $row["admin_name"];
        $_SESSION['admin_email']  = $row["admin_email"];
        $_SESSION['admin_image'] =  $row['admin_image'];
        
        echo "<script>window.open('../../index.php','_self')</script>";
    }  
    else  
    {  
        //return false; 
        echo "<script>alert('Wrong User Details')</script>";
        echo "<script>window.open('../../login.php','_self')</script>";
    }
}

if(isset($_POST['register'])){
    $id = "SHAPHER" . "-" . rand(1000, 9999);
    $name = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $c_pass = password_hash($pass, PASSWORD_DEFAULT); 
    $na = "N/A";
    $sql = "INSERT INTO admins(admin_id, admin_name, admin_email, admin_pass, admin_image, admin_address, admin_contact) 
    VALUES
    (:admin_id, :admin_name, :admin_email, :admin_pass, :admin_image, :admin_address, :admin_contact)";

    $query = $connect->prepare($sql);
    
    $query->bindparam(':admin_id', $id, PDO::PARAM_STR);
    $query->bindparam(':admin_name', $name, PDO::PARAM_STR);
    $query->bindparam(':admin_email', $email, PDO::PARAM_STR);
    $query->bindparam(':admin_pass', $c_pass, PDO::PARAM_STR);
    $query->bindparam(':admin_image', Config::$defaultImg, PDO::PARAM_STR);
    $query->bindparam(':admin_address', $na, PDO::PARAM_STR);
    $query->bindparam(':admin_contact', $na, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $connect->lastInsertId();
    if($lastInsertId)
    {
        echo "<script>alert('Registration successfull. Now you can login');</script>";
        echo "<script>window.open('../../login.php','_self')</script>";
    }
    else 
    {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }

    
}