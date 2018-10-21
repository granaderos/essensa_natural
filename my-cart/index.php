<?php
    session_start();

    if(isset($_SESSION["currentUsername"])) {
        if($_SESSION["currentUserType"] == "admin") {
            //header("Location: a-orders.php");
        } else {
            //header("Location: index.php");
        }
    } else {
        header("Location: ../login");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Essensa Naturale</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/cart.css" rel="stylesheet" type="text/css" />

        <script src="../js/jquery.js" type="text/javascript"></script>
        <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/products.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $("#aClient").addClass("activeA");
                $("#liFAQ").addClass("aboveMenu");
                $("#liMyCart").addClass("activeLi");
                $("#liLast").addClass("bottomMenu");

                $("#btnShowCart").addClass("active");
            });
        </script>
    </head>
    <body>
        <?php include_once "../misc/header.php";?>
        <div id="clientMainContainer">
            <?php include_once "../misc/clientMenu.php"; ?>
            <div class="container container-fluid">
                <div id="tempOrdersContainer">
                    <h4 class="alert alert-info">My Cart <span class="glyphicon glyphicon-shopping-cart"></span><span class="glyphicon glyphicon-shopping-cart"></span><span class="glyphicon glyphicon-shopping-cart"></span></h4>
                    <div id="clientTemOrdersContainerDiv"></div>
                </div>
                <br /><br /><br />
                <div id="clientTransactionDiv"></div>
                <div id="submitOrdersDiv">
                    <div class="btn-group" style="margin: auto;">
                        <button id="btnDeliver" class="btn btn-lg btn-info">Deliver</button>
                        <button id="btnPickUp" class="btn btn-lg btn-info">Pick-up</button>
                        <button id="btnShip" class="btn btn-lg btn-info">Ship</button>
                    </div>
                    <form id="submitOrderForm"></form>

                    <form id="shippingForm" style="display:none;">
                        <h5 class="alert alert-info">For Shipping</h5>
                        <br />
                        <label>Where to Ship:</label>
                        <select class="input-sm form-control" id="shipArea">
                            <option>Luzon</option>
                            <option>Visayas</option>
                            <option>Mindanao</option>
                            <option>Abroad</option>
                        </select><br />
                        <label>City | Province:</label>
                        <input type="text" class="input-sm form-control" id="shipCity" placeholder="city or province" required /><br />
                        <label>Specific Address:</label>
                        <input class="input-sm form-control" type="text" id="shipSpecificAddress" placeholder="specific address" required /><br />
                        <label>Name of the Receiver:</label>
                        <input class="form-control input-sm" type="text" id="shipNameOfTheReceiver" placeholder="Given name Middle name Last name" required /> <br />
                        <label>Care Of:</label>
                        <input class="form-control input-sm" type="text" id="shipNameOfCareOf" placeholder="optional" /> <br />
                        <label>Contact Number Of the Receiver:</label>
                        <input class="form-control input-sm" type="text" id="shipContactNumOfReceiver" placeholder="contact number" required /> <br />
                        <label>Payment Method:</label> <br />
                        <div id="paymentMethodDiv">
                            <input type="radio" name="shipPaymentMethod" value="Cash Remittance" onchange="$('#accountNumber').hide()" checked /> Cash Remittance<br />
                            <input type="radio" name="shipPaymentMethod" value="Bank Deposit" onchange="$('#accountNumber').show()"/> Bank Deposit <br />
                            <p id="accountNumber" style="display: none;"><label>Account Number:</label> <label style="font-size: 25px;" class="label label-info">35456253432</label></p>
                        </div>
                    </form>

                    <form id="deliveryForm" style="display:none;">
                        <h5 class="alert alert-info">For Delivery</h5>
                        <br />
                        <label>Note: Within Metro Manila ONLY</label><br /><br />
                        <label>Where to Deliver:</label>
    <!--                    <label>City:</label>-->
                        <input type="text" class="input-sm form-control" id="delCity" placeholder="City" required /><br />
                        <label>Specific Address:</label>
                        <input class="input-sm form-control" type="text" id="delSpecificAddress" placeholder="Specific Address" required />
                        <br />
                        <label>Name of the Receiver:</label>
                        <input class="form-control input-sm" type="text" id="delNameOfTheReceiver" placeholder="Given name Middle name Last name" required /> <br />
                        <label>Care Of:</label>
                        <input class="form-control input-sm" type="text" id="delNameOfCareOf" placeholder="optional" required /> <br />
                        <label>Contact Number Of the Receiver:</label>
                        <input class="form-control input-sm" type="text" id="delContactNumOfReceiver" placeholder="contact number" required /> <br />
                        <label>Payment Method:</label> <br />
                        <div id="paymentMethodDiv">
                            <input type="radio" name="delPaymentMethod" value="Cash on Delivery" onchange="$('#accountNumber').hide()" checked /> Cash On Delivery<br />
                            <input type="radio" name="delPaymentMethod" value="Bank Deposit" onchange="$('#accountNumber').show()"/> Bank Deposit <br />
                            <p id="accountNumber" style="display: none;"><label>Account Number:</label> <label style="font-size: 25px;" class="label label-info">35456253432</label></p>
                        </div>
                    </form>

                    <form id="pickUpForm" style="display:none;">
                        <h5 class="alert alert-info">For Pick-Up</h5> <br />
                        <label>When to Pick-up:</label>
                        <input class="form-control input-sm ui-datepicker" placeholder="Pick-up Date" type="text" id="pickDateOfPickUp" required /> <br />
                        <label>Name of the Picker:</label>
                        <input class="form-control input-sm" type="text" id="pickNameOfTheReceiver" placeholder="Given name Middle name Last name" required/> <br />
                        <label>Contact Number Of the Picker:</label>
                        <input class="form-control input-sm" type="text" id="pickContactNumOfReceiver" placeholder="contact number" required /> <br />
                        <label>Payment Method:</label> <br />
                        <div id="paymentMethodDiv">
                            <input type="radio" name="pickPaymentMethod" value="Cash On Pick-Up" onchange="$('#accountNumber').hide()" checked /> Cash On Pick-up<br />
                            <input type="radio" name="pickPaymentMethod" value="Bank Deposit" onchange="$('#accountNumber').show()"/> Bank Deposit <br />
                            <p id="accountNumber" style="display: none;"><label>Account Number:</label> <label style="font-size: 25px;" class="label label-info">35456253432</label></p>
                        </div>
                    </form>

                    <div id="attachProofOfPaymentDiv" style="display: none;">
                        <form class="form-group">
                            <label>Upload a Proof-Of-Payment Photo:</label>
                            <input type="file" name="proofOfPaymentPhoto" class="form-control" />
                            <label>Description:</label>
                            <textarea class="form-control" id="proofOfPaymentDescription" value="" placeholder="Optional"></textarea>
                        </form>
                    </div> <!-- end of attachProofOfPaymentDiv -->

                    <div id='submitOrdersBtnDiv' class="pull-right"></div>
                </div> <!-- end of subContainer -->
            </div> <!-- end of submitOrdersDiv -->
            <div id="dialogDiv"></div>
        </div> <!-- end of clientMainContainer -->
        <?php include_once "../misc/footer.html";?>
    </body>
</html>