<?php 
include_once("includes/header.php"); 
$stmt = $connect->query("SELECT * FROM settings");
$row = $stmt->fetch();
?>
   
    <div class="breadcrumb-area pt-35 pb-35 bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">contact us </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="contact-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="contact-info-area">
                        <h2>Get In Touch</h2>
                        <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elituis. </p>
                        <div class="contact-info-wrap">
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-location-pin"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p><?php echo $row['company_address'] ?></p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-envelope"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p><a href="mailto:<?php echo $row['company_email'] ?>"><?php echo $row['company_email'] ?></a></p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-screen-smartphone"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p><a href="tel:<?php echo $row['company_contact'] ?>"><?php echo $row['company_contact'] ?></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="contact-from contact-shadow">
                        <form id="contact-form">
                            <input name="name" id="cf_name" type="text" placeholder="Name" required>
                            <input name="email" id="cf_email" type="email" placeholder="Email" required>
                            <input name="subject" id="cf_subject" type="text" placeholder="Subject" required>
                            <textarea name="message" id="cf_message" placeholder="Your Message" required></textarea>
                            <button class="submit" type="button" onclick="sendEmail()" >Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <?php include_once("includes/footer.php"); ?>