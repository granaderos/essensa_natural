<?php
session_start();

if(isset($_SESSION["currentUsername"])) {
    if($_SESSION["currentUserType"] == "admin") {
        //header("Location: a-orders.php");
    } else {
        //header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hello Admin!</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/adminMessages.css" rel="stylesheet" type="text/css" />

    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/profile.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#aClient").addClass("activeA");
            $("#liFAQ").addClass("aboveMenu");
            $("#liMyCart").addClass("activeLi");
            $("#liLast").addClass("bottomMenu");

            $("#btnShowProfile").addClass("active");
        });
    </script>
</head>
<body>
<?php include_once "../misc/header.php";?>

<div id="adminMessagesMainContainer">
    <?php include_once "../misc/clientMenu.php"; ?>
    <div class="container container-fluid">
        <h4 class="alert alert-info">Personal Information</h4>
        <table class="table table-responsive table-hover" id="tblClientProfile"></table>

    </div>
</div> <!-- end of adminMessagesMainContainer div -->
<div id="dialogDiv"></div>
<?php include_once "../misc/footer.html";?>
</body>
</html>