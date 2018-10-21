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
    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/login.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liFAQ").addClass("aboveMenu");
            $("#liLoginRegister").addClass("activeLi");
            $("#liMyCart").addClass("activeLi");
            $("#liLast").addClass("bottomMenu")

            $("a[href='../login']").addClass("activeA");
            $("a[href='../my-cart']").addClass("activeA");

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
            <div id="loginDiv" class="col-md-4" style="">
                <h3 class="alert alert-info">Login here:</h3>
                <form method="POST" onsubmit="funcLogin()">
                    <div class="form-group">
                        <label for="usernameEntered">Username:</label>
                        <input type="text" id="usernameEntered" name="usernameEntered" placeholder="username" class="form-control"  required />
                    </div>
                    <div class="form-group">
                        <label for="passwordEntered">Password:</label>
                        <input type="password" id="passwordEntered" name="passwordEntered" placeholder="password" class="form-control" required />
                    </div>
                    <button id="btnLogin" class="btn btn-info" onclick="funcLogin()"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;login</button>
                </form>

                <div style="text-align: center; margin-top: 20px;">
                    <a href="../register" class="">Click HERE to Register</a>
                </div>
            </div>
            <div class="col-md-8">
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