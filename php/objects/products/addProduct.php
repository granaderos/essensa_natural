<?php
    include_once "../../controller/ServerFunctions.php";
    $obj = new ServerFunctions();

    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $unitPrice = $_POST["unitPrice"];
    $sellingPrice = $_POST["sellingPrice"];
    $stock = $_POST["stock"];
    $category = $_POST["category"];

    $uploadingError = "";
    if($_POST["isPhotoIncluded"] == 1) {
        $allowedImageType = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/pjpeg", "image/x-png");
        $allowedImageExtension = array("gif", "jpeg", "jpg", "png");
        $imageName = $_FILES["photo"]["name"];
        $imageExtension = end(explode(".", $imageName));
        if(in_array($_FILES["photo"]["type"], $allowedImageType) || in_array($imageExtension, $allowedImageExtension)) {
            if($_FILES["photo"]["error"] > 0) $uploadingError = "Sorry. An error occur while uploading the package photo";
            else {
                $newName = $obj->addProduct($name, $desc, $unitPrice, $sellingPrice, $stock, $imageExtension, $category);
                echo "new name = ".$newName;
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../../../files/productsPhotos/".$newName);
            }
        }
        echo $uploadingError;
    } else {
        $obj->addProduct($name, $desc, $unitPrice, $sellingPrice, $stock, "", $category);
    }