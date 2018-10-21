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

<html>
    <head>
        <title>Hello Admin!</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/adminProducts.css" rel="stylesheet" type="text/css" />

        <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/products.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $("#aAdmin").addClass("activeA");
                $("#liFAQ").addClass("aboveMenu");
                $("#liAdministration").addClass("activeLi");
                $("#liLast").addClass("bottomMenu");

                $("#btnShowProducts").addClass("active");
            });
        </script>
    </head>
    <body>
    <?php include_once "../misc/header.php";?>
    <?php include_once "../misc/adminMenu.php"; ?>
    <div id="mainAdminProductContainer" class="container container-fluid">
        <div id="addProductDiv" class="">
            <h4 class="alert alert-info">Add a New Product</h4>
            <!--<span class="pull-right"><button class="btn btn-large btn-info" id="btnDisplayproducts">Display products</button></span>-->
            <form class="form-group" onsubmit="return false;">
                <label>Product Name</label>:<input class="form-control" type="text" name="productName" required />
                <label>Product Description</label>:<textarea class="form-control" name="productDescription" required></textarea>
                <label>Unit Price</label>:<input class="form-control" type="text" name="productUnitPrice" required />
                <label>Selling Price</label>:<input class="form-control" type="text" name="productSellingPrice" required />
                <label>Initial Stocks</label>:<input class="form-control" type="text" name="productStock" required />
                <label>Category</label>:
                    <select id="productCategory" class="form-control">
                        <option value="Health">Health</option>
                        <option value="Beauty & Personal Care">Beauty & Personal Care</option>
                        <option value="Agricultural">Agricultural</option>
                        <option value="Household">Household</option>
                    </select>
                <label>Product Poster</label>:<span class=""></span><input class="form-control" type="file" name="productPhoto" />
                <br />
                <div class="btn-group" id="btnGroupProd">
                    <button id="btnAddProduct" class="btn btn-info col-lg-6">Add Product</button>
                    <button id="btnResetProduct" type="reset" class="btn btn-danger col-lg-6">Reset</button>
                </div>
            </form>
        </div>

        <div id="editProductDiv">
            <h4 class="alert alert-info">Updating Product's Data</h4>
            <!--<span class="pull-right"><button class="btn btn-large btn-info" id="btnDisplayproducts">Display products</button></span>-->
            <form class="form-group">
                <label>Product Name</label>:<input class="form-control" type="text" name="newProductName" required />
                <label>Product Description</label>:<textarea class="form-control" name="newProductDescription" required></textarea>
                <label>Unit Price</label>:<input class="form-control" type="text" name="newProductUnitPrice" required />
                <label>Selling Price</label>:<input class="form-control" type="text" name="newProductSellingPrice" required />
                <label>Current Stocks</label>:<input class="form-control" id="prevStocksHolder"/>
                <label>Additional Stocks</label>:<input class="form-control" type="text" name="newProductStocks" required />
                <label>Category</label>:
                <select id="newProductCategory" class="form-control">
                    <option value="Health">Health</option>
                    <option value="Beauty & Personal Care">Beauty & Personal Care</option>
                    <option value="Agricultural">Agricultural</option>
                    <option value="Household">Household</option>
                </select>
                <br />
            </form>
        </div>

        <div id="productListDiv">
            <h4 class="alert alert-info">List of All Products</h4>
            <table style="font-size: 12px;" class="table table-hover" id="tblProductListAdmin"></table>
        </div>

    </div>
    <?php include_once "../misc/footer.html";?>
    <div id="dialogDiv"></div>
    </body>
</html>