<?php
    session_start();

    if(isset($_SESSION["currentUsername"])) {
        if($_SESSION["currentUserType"] == "a-orders") {
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
        <link href="../css/adminOrders.css" rel="stylesheet" type="text/css" />

        <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/jqBarGraph.js" type="text/javascript"></script>
        <script src="../js/adminMessages.js" type="text/javascript"></script>
        <script src="../js/order.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $("#aAdmin").addClass("activeA");
                $("#liFAQ").addClass("aboveMenu");
                $("#liAdministration").addClass("activeLi");
                $("#liLast").addClass("bottomMenu");

                $("#btnShowOrder").addClass("active");
            });
        </script>
    </head>
    <body>
        <?php include_once "../misc/header.php";?>
        <?php include_once "../misc/adminMenu.php"; ?>
        <div id="adminMainContainer" class="container container-fluid">
            <br />
            <div id="adminSubMenuDiv" class="pull-right">
                <ul>
                    <li>
                        <div class='input-group' >
                            <select class="input input-sm" id="selectSalesRecord">
                                <option values="Daily">Daily</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Annually">Annually</option>
                            </select>
                            <a id="aDisplaySales">Display Sales</a>
                        </div>
                    </li>
<!--                    <li><div> | </div></li>-->
                    <li>
                        <div class="input-group">
                            <input type="text" class="col-lg-4 input input-sm" id="displayOrdersDate" placeholder="Select Date" />
                             <a id="btnDisplayOrdersOnDate">Display Orders</a>
                        </div>
                    </li>
                </ul>
            </div>
            <br />
            <br />
            <div class="panel panel-info">
                <div class="panel-heading panel">
                    <div class="panel-title text-center">Monthly Sales</div>
                </div>
                <div id="barGraphDiv" class="panel-body"></div>
            </div>
            <div id="tranasctionsContainer"></div>

            <div id="sendMessageToDiv" style="display: none;">
                <label>Subject:</label>
                <input type="text" id="adminSubject" class="form-control" />
                <label>Message:</label>
                <textarea id="adminMessage" class="form-control"></textarea>
            </div>
        </div> <!-- end of a-orders main container div -->
        <div id="dialogDiv"></div>
        <?php include_once "../misc/footer.html";?>
    </body>
</html>