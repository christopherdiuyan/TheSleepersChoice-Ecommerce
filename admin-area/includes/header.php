<?php
include_once("assets/php/config.php");
require_once("db.php");
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return '1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return $t . ' ' . $str . ( $t > 1 ? 's' : '' );
        }
    }
}
$dateNow = date('Y-m-d H:i:s');
$adminImg = file_exists(Config::$adminImgFilepath . $_SESSION['admin_image']) ? 
        Config::$adminImgFilepath . $_SESSION['admin_image'] : Config::$adminImgFilepath.Config::$defaultImg;
$query = "
        SELECT * FROM inquiry ORDER BY date DESC LIMIT 4
    ";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();

?>
<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<?php include_once("includes/stylesheet.php"); ?>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Navbar Start -->
        <header class="navbar navbar-fixed">
            <!-- Navbar Header Start -->
            <div class="navbar--header">
                <!-- Logo Start -->
                <a href="index.php" class="logo">
                    <img src="assets/img/sleepers-choice-logo.jpg" alt="">
                </a>
                <!-- Logo End -->

                <!-- Sidebar Toggle Button Start -->
                <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- Sidebar Toggle Button End -->
            </div>
            <!-- Navbar Header End -->

            <!-- Sidebar Toggle Button Start -->
            <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <!-- Sidebar Toggle Button End -->

            <!-- Navbar Search Start -->
            <div class="navbar--search">
                <a href="../index.php" target="_blank" class="btn-link"><i class="fa fa-eye"></i> Visit My Store</a>
            </div>
            <!-- Navbar Search End -->

            <div class="navbar--nav ml-auto">
                <ul class="nav">
                    <li class="nav-item nav--user">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="badge text-white bg-blue"><?php echo $total_row?></span>
                        </a>
                        <ul class="dropdown-menu user--list">
                            <?php 
                                if($total_row > 0)
                                    {
                                        foreach($result as $row)
                                        {
                                            switch(rand(1,5)){
                                                case '1':
                                                    $color = "bg-blue";
                                                    break;
                                                case '2':
                                                    $color = "bg-darker";
                                                    break;
                                                case '3':
                                                    $color = "bg-green";
                                                    break;
                                                case '4':
                                                    $color = "bg-orange";
                                                    break;
                                                default:
                                                    $color = "bg-red";
                                                    break;
                                            }
                                            $avatar = $row['name'];
                                    ?>
                                <li>
                                    <a href="inquiries.php" class="list-link"> 
                                    <div class="avatar"> <span class="avatar-text <?php echo $color ?>"><?php echo ucfirst($avatar[0]) ?></span></div>
                                    <div class="info"> 
                                        <h4 class="title"> 
                                        <span class="title-text"><?php echo $row['name'] ?></span> 
                                        <span class="time"><?php echo get_time_ago(strtotime($row['date'])) ?></span> 
                                        </h4> 
                                        <p class="subtitle" style="max-width: 120px"><?php echo $row['message'] ?></p>
                                        <p class="desc"> 
                                        <span class="desc-text"><?php echo $row['email'] ?></span>
                                        </p>
                                    </div>
                                    </a> 
                                </li>
                                <?php 
                                    }
                                }
                                else
                                {
                                    ?>
                                    <li>
                                        <a href="#" class="list-link text-center" style="padding-left: 10px"> 
                                        <div class="info"> 
                                            <p class="subtitle">It’s Quiet here.</p>
                                        </div>
                                        </a> 
                                    </li>
                               <?php } ?>
                               <li class="dropdown-divider"></li>
                               <li>
                                <a href="inquiries.php" class="list-link text-center" style="padding-left: 10px"> 
                                <div class="info">
                                    <strong><p class="subtitle">See All in Inquiries</p></strong>
                                </div>
                                </a> 
                            </li>
                        </ul>
                    </li>

                    <!-- Nav User Start -->
                    <li class="nav-item dropdown nav--user online">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown">
                            <img src="<?php echo $adminImg ?>" alt="" class="rounded-circle">
                            <span><?php echo $_SESSION['admin_name']?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li> <a href="javascript:void(0)" class="btn-link editUser" data-toggle="modal" id="<?php echo $_SESSION['admin_id'] ?>"><i class="far fa-user"></i>Profile</a></li>
                            <li><a href="settings.php"><i class="fa fa-cog"></i>Settings</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </li>
                    <!-- Nav User End -->
                </ul>
            </div>
        </header>
        <!-- Navbar End -->