var formData = false;
var packagePhoto = "";
$(document).ready(function() {


    displayPackages();

    //------ adding a package

    if(window.FormData) formData = new FormData();
    $("input[name='packagePhoto']").change(function() {
        packagePhoto = this.files[0];
    });
    
    $("#btnAddPackage").click(function() {
        var name = $("input[name='packageName']").val();
        var desc = $("textarea[name='packageDescription']").val();
        var price = $("input[name='packagePrice']").val();
        var isPhotoIncluded = 0;
        if($("input[name='packagePhoto']").val() != "") isPhotoIncluded = 1;
        if(name != "" && desc != "" && price != "") {
            //if("[0-9]".test(price)) {
                if(formData) {
                    formData.append("name", name);
                    formData.append("desc", desc);
                    formData.append("price", price);
                    formData.append("isPhotoIncluded", isPhotoIncluded);
                    formData.append("photo", packagePhoto);
                    $.ajax({
                        type: "POST",
                        url: "../php/objects/addPackage.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function() {
                            $("input[name='packageName']").val("");
                            $("textarea[name='packageDescription']").val("");
                            $("input[name='packagePrice']").val("");
                            $("input[name='packagePhoto']").val("");
                            displayPackages();
                        },
                        error: function(data) {
                            console.log("Error in adding package = " + JSON.stringify(data));
                        }
                    });
                } else alert("Some thing's wrong");
            //} else showDialog("ERROR!", "Please enter a valid price value for package " + name + ".");
        } else showDialog("ERROR!", "Please enter the needed details for adding a package.");
    });


});

function updatePackagePhoto(input) {
    packagePhoto = input.files[0];
    console.log(packagePhoto);
}

function changePackagePhoto(id) {
    if($("input[name='newPackagePhoto']").val() != "") {
        if(window.FormData) formData = new FormData();
        if(formData) {
            formData.append("id", id);
            formData.append("photo", packagePhoto);
            formData.append("name", $("#packageNameToUpdate").html());
            $.ajax({
                type: "POST",
                url: "../php/objects/changePackagePhoto.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log("hey " + data);
                    $("#dialogDiv").html(data);
                },
                error: function(data) {
                    console.log("error in changing package photo = " + JSON.stringify(data));
                }
            });

        }
    }
}

function viewPackagePhoto(id) {
    $.ajax({
        type: "POST",
        url: "../php/objects/getPackagePhoto.php",
        data: {"id": id},
        success: function(data) {
            showDialog("Package Photo Details", data);
        },
        error: function(data) {
            console.log("error in getting package photo = " + JSON.stringify(data));
        }
    });
}

function deletePackage(id) {
    $("#dialogDiv").html("Sure to remove the selected package?");
    $("#dialogDiv").dialog({
        title: "CONFIRMATION",
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "Okay": function() {
                $.ajax({
                    type: "POST",
                    url: "../php/objects/deletePackage.php",
                    data: {"id": id},
                    success: function() {
                        $("#dialogDiv").dialog("close");
                        displayPackages();
                    },
                    error: function(data) {
                        console.log("Error in removing package: " + JSON.stringify(data));
                    }
                });
            },
            "Cancel": function(){
                $("#dialogDiv").dialog("close");
            }
        }
    });
}

function editPackage(id) {
    $("input[name='newPackageName']").val($("#"+id+"name").html());
    $("textarea[name='newPackageDescription']").val($("#"+id+"desc").html());
    $("input[name='newPackagePrice']").val($("#"+id+"price").html());
    var currentStatus = $("#"+id+"status").html();
    alert(currentStatus);
    if(currentStatus == "available") currentStatus = 1;
    else if(currentStatus == "out-of-stock") currentStatus = 0;
    $("input[value='"+currentStatus+"']").attr("checked", true);
    $("#editPackageDiv").dialog({
        title: "CONFIRMATION",
        modal: true,
        show: "clip",
        hide: "clip",
        width: 500,
        height: 500,
        buttons: {
            "Save Package Details": function() {
                var name = $("input[name='newPackageName']").val();
                var desc = $("textarea[name='newPackageDescription']").val();
                var price = $("input[name='newPackagePrice']").val();
                var status = $("input[name='newPackageStatus']").val();
                alert(status);
                if(name != "" && desc != "" && price != "") {
                    if(price) {
                        $.ajax({
                            type: "POST",
                            url: "../php/objects/updatePackage.php",
                            data: {"name": name, "desc": desc, "price": price, "status": status, "id":id},
                            success: function() {
                                $("#editPackageDiv").dialog("close");
                                showDialog("ATTENTION!", "New package details successfully saved.");
                                displayPackages();
                            },
                            error: function(data) {
                                console.log("Error in editing package = " + JSON.stringify(data));
                            }
                        });
                    }
                }
            }
        }
    })
}

function displayPackages() {
    $.ajax({
        type: "POST",
        url: "../php/objects/displayPackages.php",
        success: function(data) {
            $("#tblPackageList").html(data);
        },
        error: function(data) {
            console.log("Error in adding package = " + JSON.stringify(data));
        }
    });
}

