<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../css/productsLayout.css">
    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/products.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#liAbout").addClass("aboveMenu");
            $("#liProducts").addClass("activeLi");
            $("#liTestimonies").addClass("bottomMenu");
            $("a[href='../products']").addClass("activeA");
        })
    </script>
</head>
<body>
    <?php include_once "../misc/header.php";?>

    <div id="productsMainContainer" class="container container-fluid">
        <h4 class="alert alert-info">Available Products</h4>
        <div id="productList" class="container container-fluid">
            <div id="tblProductList" class=""></div>
        </div>

    </div>
    <div id="dialogDiv"></div>
    <?php include_once "../misc/footer.html";?>
</body>
</html>