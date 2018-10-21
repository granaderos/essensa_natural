<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>How to be a Dealer</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/how-to-be-a-dealer.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liTestimonies").addClass("aboveMenu");
            $("#liHowToBeAMember").addClass("activeLi");
            $("#liHowToOrder").addClass("bottomMenu");
            $("a[href='../how-to-become-a-member']").addClass("activeA");
        })
    </script>
</head>
<body>
<?php include_once "../misc/header.php";?>

<div id="mainContainer" class="container container-fluid">
    <h2 class="alert alert-info">Start your very own Buah Merah Mix Homebased Business Today!</h2>

    <div id="wordsWhy" class="row">
        <div id="imgDealer" class="col-md-8 col-lg-6">
            <img class="img-responsive" height="100%" width="100%" style="margin: auto;"  src="../images/Looking-for-Dealers.jpg">
        </div>
        <div class="col-md-6 col-lg-5">
            <h3>Bakit napaka gandang i-Business ng Buah Merah Mix?</h3>
            <ol>
                <li><b>Stable Company</b> – Ang Buah Merah Mix ay ang Flagship product ng Essensa Naturale, isang established at malaking kumpanya na merong sariling plantation, manufacturing, packaging business. At ito ay pag-aari ng mga Licensed Chemist na may malalim ng kaalaman at experience sa industrya ng Food Supplement, Alternative Medicines, Skin Care at maging mga Fragrances.</li>
                <li><b> Effective</b> – ang sekreto ng Buah Merah Mix, ito ay Pure Organic, Non-Toxic at All-Natural. Hindi tulad ng ibang produkto na “Commercialized”, pinagawa lang, at maraming chemicals, sugars at preservatives na karaniwang ginagawa sa mga ibang produkto, lalong lalo na sa mga produkto na nasa Direct Selling Business.
                    At dahil doon, napakataas actually ang demand pra sa produkto na ito ay tumataas ng 98% kada bwan dahil ito ay talagang epektibo at walang tsamba.
                </li>
                <li><b>Unique</b> – ang Essensa Naturale lamang ang sole company na rehistrado na mag distribute ng Buah Merah, dito sa Pilipinas. Ito ay hindi mo mabibili kahit saan. Napaka dali rin nitong ipre-pare, at napakaraming benefits sa katawan, napaka dami na rin nitong napagaling all over the world, hindi lamang sa Pilipinas.</li>
                <li><b>Highly Consumable</b> – dahil nga ito ay talagang mabisa at epektibo, napaka dali nitong i-promote, patuloy na mag oorder at mag oorder sayo ang mga happy customers ng Buah Merah Mix, at sila na mismo ang nag rerekomenda nito sa mga kakilala at kamag anak nila.</li>

            </ol>
            <h5><b>Tanong:</b> So Papaano nga ba magiging Re-Seller o Distributor ng Buah Merah Mix??</h5>
            <h5><b>Sagot:</b> Para ikaw ay maging official na Distributor ng Essensa Naturale at Buah Merah Mix, kailangan mo lang mag purchase ng iyong “Initial Inventory”.
            </h5>
        </div>

    </div>

    <div class="words row">
        <div class="col-lg-4 col-md-8">
            <h4> Dealership Promo Package Inclusions:</h4>
            <div>  Lifetime dealership member's account (BSD Account)</div>
            <div>  25 Bottles of Buah Merah Mix</div>
            <div>  Plus you wil get the following items for FREE!</div>
            <div>  + 1 Organic Shampoo</div>
            <div>   + 1 Organic Conditioner</div>
            <div>   + 1 Organic Whitening Lotion</div>
            <div>   + 2 Organic Soap Assorted</div>
            <div>   + 5 Red Mint All Natural Pain Reliever Liniment Cream</div>
            <div>   + Online Account</div>
            <div>   + Eco Bag</div>
            <div>  + Marketing Brochures and Leaflets</div>
            <div>   + Registration Forms and Price lists</div>
            <div>  + Team Support</div>
            <br>
            <div>  Sa iyong Initial Inventory palang, malaki na kaagad ang iyong ROI (Return of Investment) kapag nabenta mo lahat ng produkto.</div>
            <br>
            <div>  Let's Compute:</div>
            <div>  25 Bottles x 350 (SRP) = P8,750.00</div>
            <div>  1 Organic shampoo = P400.00</div>
            <div>  1 Organic Conditioner = P400.00</div>
            <div>  1 Organic Whitening Lotion = P400.00</div>
            <div>   2 Organic Soap (SRP) = P500.00</div>
            <div>   5 Red Mint x 350 = P1,750</div>
            <div>  ____________________________</div>
            <div>  Total Gross Sales = P12,200</div>
            <div>  Less Initial Investment = P8,480</div>
            <div>  _____________________________</div>
            <div>  Income = P3,720</div>
            <div> Sa Initial Inventory mo palang, kumita ka na kaagad ng P3,720 Pesos!!</div>
            <br>
            <div>  At dyan palang nag sisimula ang Career mo sa pag bebenta ng Buah Merah Mix!!</div>
            <br>
            <div>  You are now already a Official Buah Merah Distributor also</div>
            <div>  Total- 8,480 only!</div>
        </div>
        <div id="imgPackage" class="text-center col-lg-8">
            <img class="img-responsive" width="100%" height="100%" style="margin: auto;" src="../images/BSD-package.jpg">
        </div>
    </div>


</div>



<?php include_once "../misc/footer.html";?>
</body>
</html>