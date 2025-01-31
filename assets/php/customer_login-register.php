<?php
session_start(); //start session
include_once("../../functions/functions.php"); 
include_once("config.php"); 
include_once("../../includes/db.php"); 

if(isset($_POST['login'])){
    
    $customer_email = $_POST['user-email'];
    $customer_pass = $_POST['user-password'];

    $sql = "select * from customers where customer_email='$customer_email'";  
    $run_customer = $connect->prepare($sql);
    $run_customer->execute();
    if($run_customer->rowCount() > 0)
    {
        while($row = $run_customer -> fetch())  
            {  
                if(password_verify($customer_pass, $row["customer_pass"]))  
                {  
                    //return true; 
                    $sql = "select * from customers where customer_email='$customer_email'";
                    $query = $connect->prepare($sql);
                    $query->execute();
                    $total_row = $query->rowCount();
                    $row_customer = $query->fetch(PDO::FETCH_ASSOC);
                    $c_id = $row_customer['customer_id'];
                    $c_name = $row_customer['customer_name'];
                    $c_u_id = $row_customer['customer_u_id'];
                    
                    if($total_row > 0){
                        $_SESSION['customer_email']=$customer_email;
                        $_SESSION['user_name'] = $c_name;
                        $_SESSION['user_uni_no'] = $c_u_id;
                        
                       echo "<script>window.open('../../my-account.php','_self')</script>";

                    }
                }  
                else  
                {  
                     echo "<script>alert('Wrong User Details')</script>";
                     echo "<script>window.open('../../login-register.php','_self')</script>";
                }  
            }  
    }
    else  
    {  
        //return false; 
        echo "<script>alert('Wrong User Details')</script>";
        echo "<script>window.open('../../login-register.php','_self')</script>";
    }
}


if(isset($_POST['register'])){
    $c_u_id = date("Y") . "-" . date("m") . "-" . date("d") . rand(1000, 9999);
    $c_name = $_POST['user-name'];
    $c_email = $_POST['user-email'];
    $pass = $_POST['user-password'];
    $c_pass = password_hash($pass, PASSWORD_DEFAULT); 
    $c_ip = getRealIpUser();
    $na = "N/A";
    $sql = "INSERT INTO customers(customer_u_id, customer_name, customer_image, customer_contact, customer_province, customer_address, customer_email, customer_pass, customer_ip) 
    VALUES
    (:customer_u_id, :customer_name, :customer_image, :customer_contact, :customer_province, :customer_address, :customer_email, :customer_pass, :customer_ip)";

    $query = $connect->prepare($sql);
    
    $query->bindparam(':customer_u_id', $c_u_id, PDO::PARAM_STR);
    $query->bindparam(':customer_name', $c_name, PDO::PARAM_STR);
    $query->bindparam(':customer_image', Config::$defaultImg, PDO::PARAM_STR);
    $query->bindparam(':customer_contact', $na, PDO::PARAM_STR);
    $query->bindparam(':customer_province', $na, PDO::PARAM_STR);
    $query->bindparam(':customer_address', $na, PDO::PARAM_STR);
    $query->bindparam(':customer_email', $c_email, PDO::PARAM_STR);
    $query->bindparam(':customer_pass', $c_pass, PDO::PARAM_STR);
    $query->bindparam(':customer_ip', $c_ip, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $connect->lastInsertId();
    if($lastInsertId)
    {
        echo "<script>alert('Registration successfull. Now you can login');</script>";
        echo "<script>window.open('../../login-register.php','_self')</script>";
    }
    else 
    {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }

    
}

?>