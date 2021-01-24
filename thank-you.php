<?php 
include_once("includes/header.php"); 
if(!isset($_SESSION['user_uni_no']))
{
     echo "<script>window.open('login-register.php','_self')</script>";
}
else
{

    // PREPARE THE BODY OF THE MESSAGE
    // $message = '<html><body>';
    // $message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
    // $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    // $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['req-name']) . "</td></tr>";
    // $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['req-email']) . "</td></tr>";
    // $message .= "<tr><td><strong>Type of Change:</strong> </td><td>" . strip_tags($_POST['typeOfChange']) . "</td></tr>";
    // $message .= "<tr><td><strong>Urgency:</strong> </td><td>" . strip_tags($_POST['urgency']) . "</td></tr>";
    // $message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . $_POST['URL-main'] . "</td></tr>";
    // $addURLS = $_POST['addURLS'];
    // if (($addURLS) != '') {
    //     $message .= "<tr><td><strong>URL To Change (additional):</strong> </td><td>" . strip_tags($addURLS) . "</td></tr>";
    // }
    // $curText = htmlentities($_POST['curText']);           
    // if (($curText) != '') {
    //     $message .= "<tr><td><strong>CURRENT Content:</strong> </td><td>" . $curText . "</td></tr>";
    // }
    // $message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . htmlentities($_POST['newText']) . "</td></tr>";
    // $message .= "</table>";
    // $message .= "</body></html>";
    
    // //   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
     
    // $to = 'tophe.diuyan@gmail.com';
    
    // $subject = 'New Order';
    
    // $headers = "From: " . $cleanedFrom . "\r\n";
    // $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // if (mail($to, $subject, $message, $headers)) {
    //   echo 'Your message has been sent.';
    // } else {
    //   echo 'There was a problem sending the email.';
    // }
}
?>

    <div class="breadcrumb-area pt-35 pb-35 bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">Checkout </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="team-area pt-95 pb-70" style="text-align: center;">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h1 style="font-weight: 700">Thank you!</h1>
                <h5>Your order was completed successfully.</h5>
            </div>
            <div class="row" style="display: flex;align-items: center;justify-content: center;">
                <div class="col-xl-8 col-lg-8 col-md-8">
                    <div class="single-feature mb-40">
                        <div class="feature-icon">
                            <img src="assets/img/icon-img/email.png" alt="">
                        </div>
                        <div class="feature-content">
                            <p>An email receipt including the details about your order has been sent to the email address you provided. Please keep it for your records.</p>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row" style="display: flex;align-items: center;justify-content: center;">
                <div class="col-xl-8 col-lg-8 col-md-8">
                    <div class="single-feature mb-40">
                      
                        <div class="feature-content">
                            <p>You can visit <a href="my-account.php">My Account page</a> at any time to check the status of your order.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

<?php include_once("includes/footer.php"); ?>