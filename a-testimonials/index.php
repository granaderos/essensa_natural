<?php
session_start();

if(isset($_SESSION["currentUsername"])) {
    if($_SESSION["currentUserType"] == "admin") {
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
    <link href="../css/adminTestimonials.css" rel="stylesheet" type="text/css" />

    <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui-1.10.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/testimonials.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#aAdmin").addClass("activeA");
            $("#liFAQ").addClass("aboveMenu");
            $("#liAdministration").addClass("activeLi");
            $("#liLast").addClass("bottomMenu");

            $("#btnShowTestimonials").addClass("active");
        });
    </script>
</head>
<body>
<?php include_once "../misc/header.php";?>
<?php include_once "../misc/adminMenu.php"; ?>
<div id="mainAdminTestimonialsContainer" class="container container-fluid">
    <div id="addTestimonialsDiv" class="">
        <h4 class="alert alert-info">Add a New Testimonial</h4>
        <form class="form-group" onsubmit="return false;">
            <label>Testimony Title</label>:<input class="form-control" type="text" name="testimonialTitle" placeholder="Title" required />
            <label>Testimony Content</label>:<textarea class="form-control" name="testimonialContent" placeholder="Enter testimonial content here" required></textarea>
            <label>Name and Age of the Person</label>:<input class="form-control" type="text" name="nameAndAge" placeholder="Name, age" required />
            <label>Attach Photo</label>:<input class="form-control" type="file" name="testimonialPhoto" required />
            <br />
            <div class="btn-group" id="btnGroupTestimonials">
                <button id="btnAddTestimony" onclick="addTestimonial()" class="btn btn-info col-lg-6">Add Testimony</button>
                <button id="btnResetTestimony" type="reset" class="btn btn-danger col-lg-6">Reset</button>
            </div>
        </form>
    </div>

    <div id="testimonialsListDiv">
        <h4 class="alert alert-info">All Testimonies Added</h4>
        <table style="font-size: 12px; text-align: center;" class="table table-bordered" id="tblTestimoniesListAdmin"></table>
    </div>

</div>
<?php include_once "../misc/footer.html";?>
<div id="dialogDiv"></div>
</body>
</html>