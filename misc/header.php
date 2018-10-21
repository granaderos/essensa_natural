<?php
    if(isset($_SESSION["currentUsername"])) {
        echo "<input type='hidden' name='currentUsername' id='currentUsername' value='".$_SESSION["currentUsername"]."'  />
          <input type='hidden' name='currentUserID' id='currentUserID' value='".$_SESSION["currentUserID"]."' />
          <input type='hidden' name='currentUserType' id='currentUserType' value='".$_SESSION["currentUserType"]."' />";
    } else {
        echo "<input type='hidden' name='currentUsername' id='currentUsername' value=''  />
          <input type='hidden' name='currentUserID' id='currentUserID' value='' />
          <input type='hidden' name='currentUserType' id='currentUserType' value='' />";
    }
?>

<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
<!--<link type="text/css" rel="stylesheet" href="../css/layout.css">-->
<link rel="icon" type="image/gif" href="../files/systemImages/EssensaNaturale.gif">
<link rel="stylesheet" type="text/css" href="../css/header.css" />

<!--<div id="bannerSection" class="hidden-xs hidden-md hidden-sm"></div>-->
<div class="hidden-lg">
    <nav style="background: #32cd32;" class="navbar navbar-default navbar-left navbar-fixed-top hidden-lg" role="navigation">
        <div class="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menuBar">
                    <span class="glyphicon glyphicon-menu-hamburger"></span>
                </button>

                <span class="navbar-brand hidden-lg" href="">Essensa Naturale</span>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="menuBar">
                <ul id="ulNavMD" class="nav nav-pa navbar-nav navbar-left">
                    <li class="clickable" id="liHome" onclick="window.location.assign('../home');"><a href="../home">Home</a></li>
                    <li class="clickable" id="liAbout" onclick="window.location.assign('../about-us');"><a href="../about-us">About Us</a></li>
                    <li class="clickable" id="liProducts" onclick="window.location.assign('../products');"><a href="../products">Products</a></li>
                    <li class="clickable" id="liTestimonies" onclick="window.location.assign('../testimonials');"><a href="../testimonials">Testimonies</a></li>
                    <li class="clickable" id="liHowToBeAMember" onclick="window.location.assign('../how-to-become-a-member');"><a href="../how-to-become-a-member">How To Be A Dealer</a></li>
                    <li class="clickable" id="liHowToOrder" onclick="window.location.assign('../how-to-order');"><a href="../how-to-order">How To Order</a></li>
                    <li class="clickable" id="liContactUs" onclick="window.location.assign('../contact-us');"><a href="../contact-us">Contact Us</a></li>
                    <li class="clickable" id="liFAQ" onclick="window.location.assign('../faq');"><a href="../faq">FAQ</a></li>
                    <?php
                    if(isset($_SESSION["currentUsername"])) {
                        if($_SESSION["currentUserType"] == "admin") {
                            echo "<li class='dropdown  clickable' id='liAdministration' >
                                    <a href='../a-orders' class='dropdown-toggle' data-toggle='dropdown' id='aAdmin' >Administration<span class='caret'></span></a>
                                    <ul class='dropdown-menu'>
                                        <li>
                                           <a style='color: green;' role='button' id='btnShowOrder' href='../a-orders'><span class='glyphicon glyphicon-shopping-cart'>&nbsp;</span>Orders</a>
                                        </li>
                                        <li>
                                            <a  role='button' style='color: green;' id='btnShowMessages' href='../a-messages'><span class='glyphicon glyphicon-envelope'>&nbsp;</span>Messages</a>
                                        </li>
                                        <li>
                                            <a role='button' style='color: green;' id='btnShowProducts' href='../a-products'><span class='glyphicon glyphicon-shopping-cart'>&nbsp;</span>Products</a>
                                        </li>
                                        <li>
                                            <a  role='button' style='color: green;' id='btnShowPackages' href='../a-packages'><span class='glyphicon glyphicon-briefcase'>&nbsp;</span>Packages</a>
                                        </li>
                                        <li>
                                            <a  role='button' style='color: green;' id='btnShowTestimonials' href='../a-testimonials'><span class='glyphicon glyphicon-pencil'>&nbsp;</span>Testimonials</a>
                                        </li>
                                        <li>
                                            <a style='color: green;' href='../misc/logout.php'  role='button' id='btnShowMessages'><span class='glyphicon glyphicon-log-out'>&nbsp;</span>Log-out</a>
                                        </li>

                                    </ul>
                                  </li>";

                        } else {
                            //echo "<li class='dropdown clickable' id='liMyCart' onclick="."window.location.assign('../my-cart');".">
                            echo "<li class='dropdown  clickable' id='liMyCart'>
                                    <a href='../my-cart' id='aClient' class='dropdown-toggle' data-toggle='dropdown'>My Account<span class='caret'></span></a>
                                    <ul class='dropdown-menu'>
                                        <li>
                                            <a style='border-radius: 0; color: green;'  role='button' id='btnShowCart' href='../my-cart'><span class='glyphicon glyphicon-shopping-cart'>&nbsp;</span>My Cart</a>
                                        </li>
                                        <li>
                                            <a style='border-radius: 0; color: green;' href='../my-profile'  role='button' id='btnShowProfile'><span class='glyphicon glyphicon-user'>&nbsp;</span>My Profile</a>
                                        </li>
                                        <li>
                                            <a style='border-radius: 0; color: green;'  role='button' id='btnShowTestimonials' href='../my-testimonials'><span class='glyphicon glyphicon-edit'>&nbsp;</span>Testimonials</a>
                                        </li>
                                        <li>
                                            <a style='border-radius: 0; color: green;'  role='button' id='btnShowMessages' href='../my-messages'><span class='glyphicon glyphicon-envelope'>&nbsp;</span>Messages</a>
                                        </li>
                                        <li>
                                                <a style='border-radius: 0; color: green;' href='../misc/logout.php'  role='button' id='btnLogOut'><span class='glyphicon glyphicon-log-out'>&nbsp;</span>Log-out</a>
                                        </li>
                                    </ul>

                                  </li>";
                            //echo "<li class='navbar-toggle' data-toggle='collapse' data-target='#forSubMenuMDClient'><span area-hidden='true' class='glyphicon glyphicon-menu-hamburger'></span></li>";
                        }
                    } else {
                        echo "<li class='clickable' id='liLoginRegister' onclick="."window.location.assign('../login');"."><a href='../login' id='aLogin'>Login | Register</a></li>";
                    }
                    ?>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    <br/> <br/><br/>
</div>
<!--<div class="visible-sm visible-xs hidden-lg hidden-md" style="top: 0; left: 0; width: 100%; background: black;">
    <button class="pull-right"><span class="glyphicon glyphicon-align-justify"></span></button>
</div>-->

<nav class="navbar navbar-default visible-lg" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <!--<div class="navbar-header">
            <div id="logoDiv"></div>
        </div>-->

        <!-- Collect the nav links, forms, and other content for toggling -->

        <ul style="margin: auto; text-align: center;" id="ulNav" class="nav navbar-nav navbar-left">
            <li class="clickable" id="liHome" onclick="window.location.assign('../home');"><a href="../home">Home</a></li>
            <li class="clickable" id="liAbout" onclick="window.location.assign('../about-us');"><a href="../about-us">About Us</a></li>
            <li class="clickable" id="liProducts" onclick="window.location.assign('../products');"><a href="../products">Products</a></li>
            <li class="clickable" id="liTestimonies" onclick="window.location.assign('../testimonials');"><a href="../testimonials">Testimonies</a></li>
            <li class="clickable" id="liHowToBeAMember" onclick="window.location.assign('../how-to-become-a-member');"><a href="../how-to-become-a-member">How To Be A Dealer</a></li>
            <li class="clickable" id="liHowToOrder" onclick="window.location.assign('../how-to-order');"><a href="../how-to-order">How To Order</a></li>
            <li class="clickable" id="liContactUs" onclick="window.location.assign('../contact-us');"><a href="../contact-us">Contact Us</a></li>
            <li class="clickable" id="liFAQ" onclick="window.location.assign('../faq');"><a href="../faq">FAQ</a></li>
            <?php
            if(isset($_SESSION["currentUsername"])) {
                if($_SESSION["currentUserType"] == "admin") {
                    echo "<li class='clickable' id='liAdministration' onclick="."window.location.assign('../a-orders');"."><a href='../a-orders' id='aAdmin'>Administration</a></li>";
                } else {
                    echo "<li class='clickable' id='liMyCart' onclick="."window.location.assign('../my-cart');"."><a href='../my-cart' id='aClient'>My Account</a></li>";
                }
            } else {
                echo "<li class='clickable' id='liLoginRegister' onclick="."window.location.assign('../login');"."><a href='../login' id='aLogin'>Login | Register</a></li>";
            }
            ?>
        </ul>
        <div id="bannerSection" class="img-responsive visible-lg visible-md"></div>
    </div>
</nav>

<!--
<div id="navSection" class="container container-fluid hidden-xs hidden-sm hidden-md">
    <div id="logoDiv"></div>
    <ul id="ulNav" style="height: 100%">
        <li class="clickable" id="liHome" onclick="window.location.assign('../home');"><a href="../home">Home</a></li>
        <li class="clickable" id="liAbout" onclick="window.location.assign('../about-us');"><a href="../about-us">About Us</a></li>
        <li class="clickable" id="liProducts" onclick="window.location.assign('../products');"><a href="../products">Products</a></li>
        <li class="clickable" id="liTestimonies" onclick="window.location.assign('../testimonials');"><a href="../testimonials">Testimonies</a></li>
        <li class="clickable" id="liHowToBeAMember" onclick="window.location.assign('../how-to-become-a-member');"><a href="../how-to-become-a-member">How To Be A Member</a></li>
        <li class="clickable" id="liHowToOrder" onclick="window.location.assign('../how-to-order');"><a href="../how-to-order">How To Order</a></li>
        <li class="clickable" id="liContactUs" onclick="window.location.assign('../contact-us');"><a href="../contact-us">Contact Us</a></li>
        <li class="clickable" id="liFAQ" onclick="window.location.assign('../faq');"><a href="../faq">FAQ</a></li>
        <?php
        if(isset($_SESSION["currentUsername"])) {
            if($_SESSION["currentUserType"] == "admin") {
                //echo "<li class='clickable' id='liAdministration' onclick="."window.location.assign('../a-orders');"."><a href='../a-orders' id='aAdmin'>Administration</a></li>";
            } else {
              //  echo "<li class='clickable' id='liMyCart' onclick="."window.location.assign('../my-cart');"."><a href='../my-cart' id='aClient'>My Account</a></li>";
            }
        } else {
            //echo "<li class='clickable' id='liLoginRegister' onclick="."window.location.assign('../login');"."><a href='../login' id='aLogin'>Login | Register</a></li>";
        }
        ?>
        <li id="liLast" style="height: 100%"></li>
    </ul>
</div>
-->