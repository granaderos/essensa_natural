<?php
    session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Home</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="../css/homeLayout.css">

    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liHome").addClass("activeLi");
            $("#liAbout").addClass("bottomMenu");
            $("a[href='../home']").addClass("activeA");

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
<div id="mainContainer">
<?php include_once "../misc/header.php";?>
<div id="homeMainContainer" class="container container-fluid">

    <div id="sellerSection">

    </div><!-- sellerSection ends -->

    <div class="row text-center" style="margin: 0 !important;">
        <div class="col-xs-12 col-md-8 col-lg-6 text-center">
            <div id="videoSection" >
                <h5 class="">Essensa Naturale Business Presentation</h5>
                <video class="img-responsive" style="background: #32cd32;" width="100%" height="100%"  controls autoplay>
                    <source src="../files/systemImages/buinessPresentation.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div> <!--end of video section -->
            <div>
                <br />
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
        <div class="col-xs-12 col-md-8 col-lg-6 text-center">
            <div id="flagshipSection">
                <h5 class="">Our Flagship Product</h5>
                <img class="img-responsive" src="../files/systemImages/BuahMerah2.JPG" width="100%" border="1px">

            </div><!-- flagshipSection ends -->

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-8 col-lg-6 text-center">
            <h5>Our Advocacy</h5>
            <div id="advocacySection">
                <div id="advocacyImages" class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#advocacyImages" data-slide-to="0" class="active"></li>
                        <li data-target="#advocacyImages" data-slide-to="1"></li>
                        <li data-target="#advocacyImages" data-slide-to="2"></li>
                        <li data-target="#advocacyImages" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner" id="slide-imgs">
                        <div class="item active">

                            <img src="../files/systemImages/advocacies/Advocacy.jpg" class="slideimg" alt="">
                        </div>
                        <div class="item">
                            <img src="../files/systemImages/advocacies/Workforit.jpg" class="slideimg" alt="">
                        </div>
                        <div class="item">
                            <img src="../files/systemImages/advocacies/AllNatural.jpg" class="slideimg" alt="">
                        </div>
                        <div class="item">

                            <img src="../files/systemImages/advocacies/OrganicWayofLiving.jpg" class="slideimg" alt="">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#advocacyImages" data-slide="prev">&lsaquo;</a>
                    <a class="right carousel-control" href="#advocacyImages" data-slide="next">&rsaquo;</a>
                </div>
            </div><!-- advocacySection ends -->
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6 text-center">
            <h5 class="alert">Like us on Facebook! <span class="glyphicon glyphicon-thumbs-up"></span></h5>
            <iframe width="100%" height="100%" src="https://web.facebook.com/buahmerahmixjuiceofficial/"></iframe>
        </div>

    </div>
</div>
<?php include_once "../misc/footer.html";?>
</div> <!-- end of main container -->
</body>
</html>