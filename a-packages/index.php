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

<!DOCTYPE html>
<html>
<head>
    <title>Hello Admin!</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/adminPackages.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/functionality.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#aAdmin").addClass("activeA");
            $("#liFAQ").addClass("aboveMenu");
            $("#liAdministration").addClass("activeLi");
            $("#liLast").addClass("bottomMenu");

            $("#btnShowPackages").addClass("active");
        });
    </script>
</head>
<body>
<?php include_once "../misc/header.php";?>
<?php include_once "../misc/adminMenu.php"; ?>
<div id="adminMainContainer" class="container container-fluid">
    <br />
    <div class="input-group form-group pull-right">
        <span class="glyphicon glyphicon-search input-group-addon"></span><input type="text" class="form-control" placeholder="Search Package" />
    </div>
    <br /><br />
    <div id="addPackagesDiv" class="">
        <h4 class="alert alert-info">Add a New Package</h4>
        <!--<span class="pull-right"><button class="btn btn-large btn-success" id="btnDisplayPackages">Display Packages</button></span>-->
        <form class="form-group">

            <label>Packages Name</label>:<input class="form-control" type="text" name="packageName" required />
            <label>Package Description</label>:<textarea class="form-control" name="packageDescription" required></textarea>
            <label>Package Price</label>:<input class="form-control" type="text" name="packagePrice" required />
            <label>Package Photo</label>:<span class=""></span><input class="form-control" type="file" name="packagePhoto" /><br />
            <div class="btn-group btn-group-sm" id="btnGroup">
                <button id="btnAddPackage" class="col-lg-6 btn btn-info">Add Package</button>
                <button id="btnResetPackage" type="reset" class="col-lg-6 btn btn-danger">Reset</button>
            </div>
            <!--<table >
                <tr>
                    <td><label>Packages Name</label></td><td>:</td><td><input class="form-control" type="text" name="packageName" required /></td>
                </tr>
                <tr>
                    <td><label>Package Description</label></td><td>:</td><td><textarea class="form-control" name="packageDescription" required></textarea></td>
                </tr>
                <tr>
                    <td><label>Package Price</label></td><td>:</td><td><input class="form-control" type="text" name="packagePrice" required /></td>
                </tr>
                <tr>
                    <td><label>Package Photo</label></td><td>:</td><td><span class=""></span><input class="form-control" type="file" name="packagePhoto" /></td>
                </tr>
                <tr>
                    <td colspan="2"><button id="btnAddPackage" class="btn btn-primary form-control">Add Package</button></td>
                    <td><button id="btnResetPackage" class="btn btn-primary form-control">Reset</button></td>
                </tr>
            </table>-->
        </form>
    </div>

    <div id="packageListDiv">
        <h4 class="alert alert-info">List of All Packages</h4>
        <table style="font-size: 12px;" class="table table-hover" id="tblPackageList"></table>
    </div>

    <div id="editPackageDiv">
        <table>
            <tr>
                <td><label>Packages Name</label></td><td>:</td><td><input class="form-control" type="text" name="newPackageName" required /></td>
            </tr>
            <tr>
                <td valign="top"><label>Package Description</label></td><td valign="top">:</td><td><textarea class="form-control" name="newPackageDescription" required></textarea></td>
            </tr>
            <tr>
                <td><label>Package Price</label></td><td>:</td><td><input class="form-control" type="text" name="newPackagePrice" required /></td>
            </tr>
            <tr>
                <td><label>Status</label></td><td>:</td>
                <td>
                    <input type="radio" name="newPackageStatus" value="1" />available
                    <input type="radio" name="newPackageStatus" value="0" />out-of-stock
                </td>
            </tr>
        </table><br />
        <p>Check first package details before saving.</p>
    </div>
</div>
<div id="dialogDiv"></div>
<?php include_once "../misc/footer.html";?>
</body>
</html>