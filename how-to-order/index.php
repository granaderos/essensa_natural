<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>How to Order</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/how-to-order.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/order.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liHowToBeAMember").addClass("aboveMenu");
            $("#liHowToOrder").addClass("activeLi");
            $("#liContactUs").addClass("bottomMenu");
            $("a[href='../how-to-order']").addClass("activeA");
        })
    </script>
</head>
<body>
    <?php include_once "../misc/header.php";?>
    <div id="howToOrderMainContainerDiv" class="container container-fluid">

        <h6 class="alert alert-info"><a href="../products"><label>Click here</label></a> to order products.</h6>
        <!--<div if="howToOrderContainer" class="container container-fluid">
            <h1 class="">AVAILABLE PACKAGES</h1><h3>Order Now!</h3>
            <div id="packages">
                No available package.
            </div>
        </div>

        <div id="addToCartDiv">
            <form class="form-group">
                Package Name: <input class="form-control" type="text" id="packageNameToOrder" readonly> <br />
                Description: <textarea class="form-control" type="text" id="packageDescriptionToOrder" readonly></textarea> <br />
                Price: <input class="form-control" type="text" id="packagePriceToOrder" readonly> <br />
                Where to Deliver: <input class="form-control" type="text" id="whereToDeliver" /> <br />
                Contact Number: <input class="form-control" type="text" id="whereToDeliver" /> <br />
                Payment Method: <br />
                                <input type="radio" name="paymentMethod" /> Cash on Delivery <br />
                                <input type="radio" name="paymentMethod" /> PayPal <br />
                                <input type="radio" name="paymentMethod" /> Vissa <br />
            </form>
        </div>-->

        <div id="dialogDiv"></div>
    </div> <!-- end of how to order main container div-->
    <?php include_once "../misc/footer.html";?>
</body>
</html>