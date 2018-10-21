<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Testimonies</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/testimonyLayout.css" rel="stylesheet" type="text/css" />

    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liProducts").addClass("aboveMenu");
            $("#liTestimonies").addClass("activeLi");
            $("#liHowToBeAMember").addClass("bottomMenu");
            $("a[href='../testimonials']").addClass("activeA");


            $.ajax({
                type: "POST",
                url: "../php/objects/testimonials/displayTestimonials.php",
                success: function(data) {
                    $("#testimonialsContentDiv").html(data);
                },
                error: function(data) {
                    console.log("error in displaying testimonials to guest " + JSON.stringify(data));
                }
            });
        });
    </script>
</head>
<body>
    <?php include_once "../misc/header.php";?>
    <div id="testimoniesMainContainerDiv" class="container container-fluid">
        <br /><br />
        <h4 class="alert alert-info">Testimonials Ng Mga Nakasubok At Gumaling</h4>
        <div id="testimonyContainer">
            <table id="testimonialsContentDiv" class="table-responsive table-bordered">
                <tr><td colspan="2"> <h3 class="">"SA BUAH MERAH MIX,NAILABAS KO SA PAG-IHI ANG KIDNEY STONE KO"</h3></td> </tr>
                <tr>
                    <td valign="top">
                        <img src= "../files/systemImages/testimonials/Rudy.jpg">
                    </td>
                    <td valign="top">

                        Ako po ay may kidney stone at naka
                        schedule nang mag pa opera
                        Buti nalang at sinubukan ko ang
                        Buah Merah Mix, wala pang 2
                        months of drinking, eto hawak ko
                        ang lumabas na kidney stone ko.
                        Salamat sa Buah Merah Mix
                        nakatipid ako nang mahigit
                        P100,000"
                        <h3 class="">--Rudy Morales, 51 yrs old</h3>
                    </td>
                </tr>
                <tr><td colspan="2"><h3 class="">"NATUNAW ANG GALL-STONE KO"</h3></td></tr>
                <tr>
                    <td valign="top">
                        <img src= "../files/systemImages/testimonials/Patricia.jpg">
                    </td>
                    <td valign="top">

                        Noong pumunta ako nang doktor,
                        nakita sa ultrasound ko na meron
                        akong mahigit 1cm na gallstone
                        (Bato sa Apdo)Laking gulat ko at"
                        nang  Doktor ko dahil pagkatapos
                        nang isang buwang inom ang
                        Buah Merah Mix, natunaw ang 
                        Gall Stone ko. Ang galing talaga
                        nang Buah Merah Mix!"
                        <h3 class="">--Patricia Vermas, 54 yrs old</h3>
                    </td>
                </tr>
                <tr><td colspan="2"> <h3 class="">"DALAWANG BUKOL SA PAA KO, NAWALA NA"</h3></td></tr>
                <tr>
                    <td valign="top">
                        <img src= "../files/systemImages/testimonials/Josephina.jpg">
                    </td>
                    <td valign="top">

                        Ako po ay may dalawang bukol
                        na kasing laki nang piso sa
                        kanang paa at laging masakit ang
                        aking balakang. Dahil sa Buah
                        Merah Mix, ngayon sakit sa balakang
                        ko at yung dalawang bukol sa paa
                        ko ay nawala na. Bilib ako sa
                        Buah Merah Mix,ang Bilis mag
                        pagaling"
                        <h3 class="">--Josephina Ricaport, 70 yrs old</h3>
                    </td>
                </tr>
                <tr><td colspan="2"><h3 class="">"8 YEARS KONG MAYONA, GUMALING NA."</h3></td></tr>
                <tr>
                    <td valign="top">
                        <img src= "../files/systemImages/testimonials/Cristy.jpg">
                    </td>
                    <td valign="top">

                        8 years na akong may mayoma,
                        malaki ang tiyan ko at matigas
                        dahil sa (6)anim ang bukol.Naka
                        tatlong bote lang ako nang
                        Buah Merah Mix sa loob nang
                        tatlong araw, nagulat ako dahil
                        lumabas ang buo buong dugo at
                        ngayon wala na akong mayoma
                        Lumiit ba ang tiyan ko. Salamat sa
                        Buah Merah Mix. Sana makatulong
                        din sa inyo"
                        <h3 class="">--Cristy Haong, 42 yrs old</h3>
                    </td>
                </tr>
                <tr><td colspan="2"><h3 class="">"20 DAYS LANG NATUNAW ANG BUKOL KO SA BREAST."</h3></td></tr>
                <tr>
                    <td valign="top">
                        <img src= "../files/systemImages/testimonials/Chona.jpg">
                    </td>
                    <td valign="top">

                        Nag pa ultra sound po ako at
                        nakitang meron akong bukol sa
                        breast. Nagworry po kami nang
                        pamilya ko, bali sinubukan ko po
                        Buah Merah Mix, kasi
                        maraming nagsasabing mahusay
                        daw, ngayon po hawak ko yung
                        bago kong ultra sound,
                        after 20 days lang nang pag inom,
                        natunaw po at nawala na ang bukol
                        sa breast ko. Mahusay talaga ang
                        Buah Merah Mix"
                        <h3 class="">--Chona Banal, 47 yrs old</h3>
                    </td>
                </tr>
                <tr><td colspan="2"><h3 class="">"NORMAL NA BLOOD SUGAR KO, AT NAKAKALAKAD NA AKO."</h3></td></tr>
                <tr>
                    <td valign="top">
                        <img src= "../files/systemImages/testimonials/Col.jpg">
                    </td>
                    <td valign="top">

                        Ako po ay may Diabetes at Bone
                        cancer, hindi po ako makatayo,
                        nanlalabo ang aking mga mata,at
                        lagi akong nanghihina. Malaki na din
                        ang nagagastos ko, pero sa tulong
                        nang Buah Merah Mix, NORMAL na
                        Blood Sugar Level ko, nakakalakad
                        na ako at malakas pa ako. Malaki pa
                        tinipid ko, Salamat sa ating
                        Dakilang Dios AMA, at sa Buah
                        Merah Mix"
                        <h3 class="">--Col. Augusto Sagun, 68 yrs old</h3>
                    </td>
                </tr>
                <tr><td colspan="2"><h3 class="">"MAGALING NA AKO SA PROSTATE PROBLEM KO."</h3></td></tr>
                <tr>
                    <td valign="top">
                        <img src= "../files/systemImages/testimonials/Rodolfo.jpg">
                    </td>
                    <td valign="top">

                        Matagal na po akong naghihirap
                        sa aking prostate problem, laking
                        gulat ko nang hibdi ko pa naubos
                        ang isang bote nang Buah Merah
                        Mix, gumaling na din. Naniniwala
                        ako ba ang Buah Merah ang
                        binigay sa aking nang ating DIOS
                        para gumaling ako."
                        <h3 class="">--Rodolfo Rosales, 72 yrs old</h3>

                    </td>
                </tr>
                <tr><td colspan="2"> <h3 class="">"NAWALA ANG SAKIT SA PUSO KO AT LUMAKAS PA AKO."</h3></td></tr>
                <tr>
                    <td valign="top">
                        <img src= "../files/systemImages/testimonials/Pacita.jpg">
                    </td>
                    <td valign="top">

                        Meron akong high blood, high
                        cholesterol, Ulcer at may sakit pa
                        ako sa puso. Mahinang mahina
                        ako noon pero ng uminom ako
                        nang Buah Merah Mix, after 2
                        minutes, dumighay ako at biglang
                        nanumbalik ang lakas ko. Malakas
                        na malakas na ako. Salamat sa
                        Buah Merah Mix at sa ating DIOS."
                        <h3 class="">--Pacita Romarez, 71 yrs old</h3>
                    </td>
                </tr>

            </table>
        </div>
    </div>

    <?php include_once "../misc/footer.html";?>
</body>
</html>