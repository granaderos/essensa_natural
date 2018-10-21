<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Essensa Naturale</title>
    <link rel="stylesheet" type="text/css" href="../css/aboutLayout.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liHome").addClass("aboveMenu");
            $("#liAbout").addClass("activeLi");
            $("#liProducts").addClass("bottomMenu");
            $("a[href='../about-us']").addClass("activeA");
        })
    </script>
</head>
<body>
<?php include_once "../misc/header.php";?>
<div id="aboutMainContainer">
    <div id="companyProfileSection">
        <h3 class="alert alert-info">Company Profile</h3>
        <h4>Pinamumunuan ng Pamilyang Chemist na may 30 taon ng experience sa Organic at Natural Medicine</h4>
        <table>
            <tr>
                <td>
                    <img src="../files/systemImages/prespic.JPG">
                    <h3>Mrs. Jocelyn Alcasabas</h3>
                    <ul>
                        <li>President</li>
                        <li>US Trained Chemist</li>
                        <li>Derma Products Specialist</li>
                        <li>Consultant-Multi National Pharmaceutical Companies</li>
                        <li>BFAD Employee for 10 years</li>
                </td>
                <td>
                    </ul><img src="../files/systemImages/mrpic.JPG">
                    <h3>Mr. Jim Paulo Alcasabas</h3>
                    <ul>
                        <li>Chief Financial officer</li>
                        <li>US Trained Chemist</li>
                        <li>Licensed Chemist</li>
                        <li>Head Chemist -Lynx Nia Medica</li>
                        <li>Former Nestle Philippines Employee</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <div id="awardsSection">
        <h3 class="alert alert-info">Awards</h3>
        <div id="awardContent">
            <h4 class="alert-success">Global Awards For Marketing and Business Excellence</h4>
            <img src="../files/systemImages/Award1.jpg">
            <h4 class="alert-success">National Product Quality Excellence Award</h4>
            <img src="../files/systemImages/Award2.jpg">
            <h4 class="alert-success">Best Brand Awards Committee and the Consumer Affairs Foundation</h4>
            <img src="../files/systemImages/Award3.jpg">
        </div>
    </div>
</div><!-- end of about main container-->
<?php include_once "../misc/footer.html";?>
</body>
</html>