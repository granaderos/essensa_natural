<?php
session_start();
/*if(isset($_SESSION["currentUsername"])) {
    if($_SESSION["currentUserType"] == "a-orders") {
        header("Location: a-orders.php");
    } else {
        header("Location: index.php");
    }
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link href="../css/login.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../files/systemImages/EssensaNaturaleLogoSmall.png" rel="shortcut-icon" />

    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/register.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liFAQ").addClass("aboveMenu");
            $("#liLoginRegister").addClass("activeLi");
            $("#liLast").addClass("bottomMenu");
            $("a[href='../login']").addClass("activeA");

            blink();
            function blink() {
                var curColor = $("#bobmmBlink").css("color");
                if(curColor == "rgb(0, 0, 0)") {
                    $("#bobmmBlink").css("color", "white");
                    $("#bmmBlink").css("color", "#32cd32");
                    $("#bmmTerm").css("color", "#32cd32");
                } else {
                    $("#bobmmBlink").css("color", "black");
                    $("#bmmBlink").css("color", "black");
                    $("#bmmTerm").css("color", "black");
                }

                setTimeout(blink, 500);
            }
        })
    </script>
</head>
<body>
<?php include_once "../misc/header.php";?>
<div id="loginMainContainer" class="container container-fluid">
    <div class="row">
        <div id="registerDiv" class="col-md-8 container-fluid">
            <h3 class="alert alert-info">Create your account now!</h3>
            <form id="registrationForm" onsubmit="return false;" >
                <div class="row">
                    <div class="col-md-4"><label>First Name:</label><input placeholder="First name" class="form-control" type="text" name="regFirstName" required /></div>
                    <div class="col-md-4"><label>Middle Name:</label><input placeholder="Middle name" class="form-control" type="text" name="regMiddleName" required /></div>
                    <div class="col-md-4"><label>Last Name:</label><input placeholder="Last name" class="form-control" type="text" name="regLastName" required /></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label>Birthday:</label><input placeholder="Birthday" class="form-control" type="text" name="regBirthday" required /></div>
                    <div class="col-md-4"><label>Gender:</label><br /><input type="radio" name="regGender" value="female" />&nbsp;Female&nbsp;&nbsp;&nbsp;<input type="radio" name="regGender" value="male" />&nbsp;Male</div>
                </div>
                <div class="row">
                    <div class="col-md-12"><label>Residential Address:</label><input placeholder="Address" class="form-control" type="text" class="span10" name="regAddress" required /></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label>Telephone No.:</label><input placeholder="Telephone #" class="form-control" type="text" name="regTelNo" required /></div>
                    <div class="col-md-4"><label>Mobile No.:</label><input placeholder="11-digit Mobile #" class="form-control" type="text" name="regCellNo" required /></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label>Username:</label><input placeholder="User name" class="form-control" type="text" name="regUsername" required /></div>
                    <div class="col-md-4"><label>Password:</label><input placeholder="Password" class="form-control" type="password" name="regPassword" required /></div>
                    <div class="col-md-4"><label>Re-type Password:</label><input placeholder="Re-Type Password" class="form-control" type="password" name="regConfirmPassword" required /></div>
                </div>
                <div class="row">
                    <br />
                    <div class="col-md-12" id="captchaContainerDiv" class="text-center">
                        <p id="codeContainerP" style="height: 60px; background-image: url(../files/CAPTCHA/1.png); background-position: left; background-repeat: no-repeat;  background-size: cover;"></p>
                        <div class="input-group">
                            <form onsubmit="funcRegister(); return false;">
                                <input type="text" id="codeEntered" class=" input input-lg form-control text-center" placeholder="enter the code above" required />
                            </form>
                            <div class="input-group-addon">
                                <button onclick="changeCode(); return false;" class="glyphicon glyphicon-refresh btn btn-sm" title="choose another code"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-4"><input type="submit" class="col-md-2 form-control btn btn-info" id="regSubmit" value="register" onclick="funcRegister()"/></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><input type="reset" class="col-md-2 form-control btn btn-warning" id="regReset" value="reset" /></div>
                    <!--<div class="col-md-4"><a href="../home/index.php" role="button" class="col-md-2 form-control btn btn-danger" id="regCancel">cancel</a></div>-->
                </div>
            </form>
            <div class="text-center">
                <br /><br />
                <a href="../login">Click HERE to return to Login page</a>
            </div>
        </div>


        <div class="col-md-4 col-lg-4">
            <p class="text-justify" style="width: 100% !important;">
                <label id="bmmTerm">Buah Merah Mix</label> is a healthy and refreshing juice drink, enriched with Natural Anti-Oxidant (Beta-Cryptosanthin) that boosts the immune system.
                <br />
                <br />
                <label class="label label-info">
                    <span class="glyphicon glyphicon-check"></span> No sugar.
                </label>&nbsp;&nbsp;&nbsp;
                <label class="label label-info">
                    <span class="glyphicon glyphicon-check"></span> No additives.
                </label>&nbsp;&nbsp;&nbsp;
                <label class="label  label-info">
                    <span class="glyphicon glyphicon-check"></span> No preservatives.
                </label>

                <br /><br />
                <strong id="bobmmBlink">BENEFITS OF BUAH MERAH MIX</strong> <br/>
                <span class="glyphicon glyphicon-ok-circle"></span> Gives Extra Energy & Improves Stamina <br/>
                <span class="glyphicon glyphicon-ok-circle"></span> Boosts the Immune System <br/>
                <span class="glyphicon glyphicon-ok-circle"></span> Fights Cancer Cells <br/>
                <span class="glyphicon glyphicon-ok-circle"></span> Reduces Bad Cholesterol <br/>
                <span class="glyphicon glyphicon-ok-circle"></span> Normalize Blood Sugar Level <br/>
                <span class="glyphicon glyphicon-ok-circle"></span> Detoxify Toxins <br/>
                <br />
                <strong id="bmmBlink">BUAH MERAH MIX will help those who are suffering from:</strong><br />
            <table class="table-responsive table text-left">
                <tr>
                    <td> High Cholesterol</td>
                    <td> Alzheimer’s Disease</td>
                    <td> Cancer</td>
                </tr>
                <tr>
                    <td> Asthma</td>
                    <td> Brochial Problem</td>
                    <td> Diabetes</td>
                </tr>
                <tr>
                    <td> Prostrate Problem</td>
                    <td> Poor Memory</td>
                    <td> Constipation</td>
                </tr>
                <tr>
                    <td> Stroke</td>
                    <td> Urinary Tract Infection</td>
                    <td> Weak Body</td>
                </tr>
                <tr>
                    <td> Anemic</td>
                    <td> Back Pain</td>
                    <td> Lupus</td>
                </tr>
                <tr>
                    <td> Goiter</td>
                    <td> Myoma</td>
                    <td> Other Degenerative diseases</td>
                </tr>
            </table>
            </p>
        </div>


    </div>
    <div id="dialogDiv"></div>
</div>
<?php include_once "../misc/footer.html";?>
</body>
</html>