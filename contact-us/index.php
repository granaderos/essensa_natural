<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/contactUs.css" rel="stylesheet" type="text/css" />

    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/contact.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liHowToOrder").addClass("aboveMenu");
            $("#liContactUs").addClass("activeLi");
            $("#liFAQ").addClass("bottomMenu");
            $("a[href='../contact-us']").addClass("activeA");
        })
    </script>
</head>
<body>
<?php include_once "../misc/header.php";?>
<div id="contactMainContainerDiv" class="container container-fluid">
    <h3 class="alert alert-info">Contact Us</h3>
    <p class="text-center" style="font-size: 20px;">
        contact us @ <label>0998-568-4824</label> / <label>0933-026-2657</label> <br/>
        visit us @ <label>unit 3F 3rd flr Quedsa Plaza Bldg.</label><br/>
        <label>Quezon Ave. corner EDSA Quezon City</label><br />
        (near 7-11 and Mcdo Q.ave)
    </p>
    <div id="image">
        <img style="margin: auto;" class="img-responsive" src="../images/SirAllan.jpg">

    </div>
    <?php
    if(isset($_SESSION["currentUserID"])) {
        echo
        "<div id='sendMessageContainerDiv'>
            <h4 class='alert alert-info'>Send Us a Message!</h4>
            <form onsubmit='return false;'>
                <label>Subject:</label><input type='text' name='messSubject' class='form-control' />
                <label>Message</label><textarea id='messMessage' class='form-control'></textarea><br />
                <button onclick='sendMessageToAdmin()' class='btn btn-info col-lg-12'>SEND</button>
            </form>
        </div>";
    } else {
        echo "<h4 class='alert alert-danger'>Please log-in to send us a message!</h4>";
    }

    ?>
</div><!-- end of contact main container div -->
<?php include_once "../misc/footer.html";?>
</body>
</html>