/**
 * Created by Marejean on 9/22/16.
 */

var formData = false;
var productPhoto = "";
var proofOfPaymentPhoto = "";

$(document).ready(function() {

    $("#dateOfPickUp").datepicker();

    viewCart();
    displayProducts();
    displayProductsAdmin();
    displayClientTransactionsToClient();

    if(window.FormData) formData = new FormData();

    $("input[name='proofOfPaymentPhoto']").change(function() {
        proofOfPaymentPhoto = this.files[0];
    });

    $("input[name='productPhoto']").change(function() {
        productPhoto = this.files[0];
    });
    $("#btnAddProduct").click(function() {
        var name = $("input[name='productName']").val();
        var desc = $("textarea[name='productDescription']").val();
        var unitPrice = $("input[name='productUnitPrice']").val();
        var sellingPrice = $("input[name='productSellingPrice']").val();
        var stock = $("input[name='productStocks']").val();
        var category = $("#productCategory").val();

        var isPhotoIncluded = 0;
        if($("input[name='productPhoto']").val() != "") isPhotoIncluded = 1;
        if(name != "" && desc != "" && unitPrice != "" && sellingPrice != "" && stock != "") {
            //if("[0-9]".test(price)) {
            if(formData) {
                formData.append("name", name);
                formData.append("desc", desc);
                formData.append("unitPrice", unitPrice);
                formData.append("sellingPrice", sellingPrice);
                formData.append("stock", stock);
                formData.append("isPhotoIncluded", isPhotoIncluded);
                formData.append("photo", productPhoto);
                formData.append("category", category);

                $.ajax({
                    type: "POST",
                    url: "../php/objects/products/addProduct.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("input[name='productName']").val("");
                        $("textarea[name='productDescription']").val("");
                        $("input[name='productUnitPrice']").val("");
                        $("input[name='productSellingPrice']").val("");
                        $("input[name='productStock']").val("");
                        $("input[name='productPhoto']").val("");
                        //displayPackages();
                        console.log("suc " + data);
                    },
                    error: function(data) {
                        console.log("Error in adding product = " + JSON.stringify(data));
                    }
                });
            } else alert("Some thing's wrong");
            //} else showDialog("ERROR!", "Please enter a valid price value for package " + name + ".");
        } else {
            alert("Please enter all required data.");
            //showDialog("ERROR!", "Please enter the needed details for adding a product.");
        }
    });

    $("#btnShip").click(function() {
        $("#btnShip").addClass("active");
        $("#btnDeliver").removeClass("active");
        $("#btnMeetUp").removeClass("active");
        $("#btnPickUp").removeClass("active");

        $("#submitOrderForm").html($("#shippingForm").html());
        $("#submitOrdersBtnDiv").html("");
        $("#submitOrdersBtnDiv").html("<button class='btn btn-lg' onclick='submitOrdersThruShip()'>SUBMIT</button>&nbsp;<button onclick='closeSubmitOrderDivDialog()' class='btn btn-lg'>CANCEL</button>");
    });
    $("#btnDeliver").click(function() {
        $("#btnShip").removeClass("active");
        $("#btnDeliver").addClass("active");
        $("#btnMeetUp").removeClass("active");
        $("#btnPickUp").removeClass("active");

        $("#submitOrderForm").html($("#deliveryForm").html());
        $("#submitOrdersBtnDiv").html("");
        $("#submitOrdersBtnDiv").html("<button class='btn btn-lg' onclick='submitOrdersThruDeliver()'>SUBMIT</button>&nbsp;<button onclick='closeSubmitOrderDivDialog()' class='btn btn-lg'>CANCEL</button>");

    });

    $("#btnPickUp").click(function() {
        $("#btnShip").removeClass("active");
        $("#btnDeliver").removeClass("active");
        $("#btnMeetUp").removeClass("active");
        $("#btnPickUp").addClass("active");


        $("#submitOrderForm").html($("#pickUpForm").html());
        $("input[name='dateOfPickUp']").datepicker();
        $("#submitOrdersBtnDiv").html("");
        $("#submitOrdersBtnDiv").html("<button class='btn btn-lg' onclick='submitOrdersThruPickUp()'>SUBMIT</button>&nbsp;<button onclick='closeSubmitOrderDivDialog()' class='btn btn-lg'>CANCEL</button>");
    });

});

function displayProducts() {
    $.ajax({
        type: "POST",
        url: "../php/objects/products/displayProducts.php",
        success: function(data) {
            $("#tblProductList").html(data);
        },
        error: function(data) {
            console.log("error in displaying products " + JSON.stringify(data));
        }
    });
}

function displayProductsAdmin() {
    $.ajax({
        type: "POST",
        url: "../php/objects/products/displayProductsAdmin.php",
        success: function(data) {
            $("#tblProductListAdmin").html(data);
        },
        error: function(data) {
            console.log("error in displaying products to a-orders " + JSON.stringify(data));
        }
    });
}


function viewProductPhoto(id) {
    $.ajax({
        type: "POST",
        url: "../php/objects/products/getProductPhoto.php",
        data: {"id": id},
        success: function(data) {
            showDialog("Product Photo Details", data);
        },
        error: function(data) {
            console.log("error in getting product photo = " + JSON.stringify(data));
        }
    });
}

function updateProductPhoto(input) {
    productPhoto = input.files[0];
    console.log(productPhoto);
}

function changeProductPhoto(id) {
    if($("input[name='newProductPhoto']").val() != "") {
        if(window.FormData) formData = new FormData();
        if(formData) {
            formData.append("id", id);
            formData.append("photo", productPhoto);
            formData.append("name", $("#prodNameToUpdate").html());
            $.ajax({
                type: "POST",
                url: "../php/objects/products/changeProductPhoto.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#dialogDiv").html(data);
                    console.log("hey " + data);
                },
                error: function(data) {
                    console.log("error in changing product photo = " + JSON.stringify(data));
                }
            });

        }
    }
}

function deleteProduct(id) {
    $("#dialogDiv").html("Sure to remove the selected product?");
    $("#dialogDiv").dialog({
        title: "CONFIRMATION",
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "Okay": function() {
                $.ajax({
                    type: "POST",
                    url: "../php/objects/products/deleteProduct.php",
                    data: {"id": id},
                    success: function() {
                        $("#dialogDiv").dialog("close");
                        displayProductsAdmin();
                        displayProducts();
                    },
                    error: function(data) {
                        console.log("Error in removing product: " + JSON.stringify(data));
                    }
                });
            },
            "Cancel": function(){
                $("#dialogDiv").dialog("close");
            }
        }
    });
}

function editProduct(id) {
    $("input[name='newProductName']").val($("#"+id+"name").html());
    $("textarea[name='newProductDescription']").val($("#"+id+"desc").html());
    $("input[name='newProductUnitPrice']").val($("#"+id+"unitPrice").html());
    $("input[name='newProductSellingPrice']").val($("#"+id+"sellingPrice").html());
    var prevStocks = parseInt($("#"+id+"stocks").html());
    $("#prevStocksHolder").val($("#"+id+"stocks").html());
    $("#prevStocksHolder").attr("readonly", "true");
    $("input[name='newProductStocks']").val();
    //var currentStatus = $("#"+id+"status").html();
    //alert(currentStatus);
    //if(currentStatus == "available") currentStatus = 1;
    //else if(currentStatus == "out-of-stock") currentStatus = 0;
    //$("input[value='"+currentStatus+"']").attr("checked", true);
    $("#editProductDiv").dialog({
        title: "CONFIRMATION",
        modal: true,
        show: "clip",
        hide: "clip",
        width: 500,
        height: 500,
        buttons: {
            "Save Package Details": function() {
                var name = $("input[name='newProductName']").val();
                var desc = $("textarea[name='newProductDescription']").val();
                var unitPrice = $("input[name='newProductUnitPrice']").val();
                var sellingPrice = $("input[name='newProductSellingPrice']").val();
                var stocks = parseInt($("input[name='newProductStocks']").val());
                var category = $("#newProductCategory").val();
                //var status = $("input[name='newProductStatus']").val();
                if(name != "" && desc != "" && unitPrice != "" && sellingPrice != "" && stocks != "") {
                    if(unitPrice) {
                        $.ajax({
                            type: "POST",
                            url: "../php/objects/products/updateProduct.php",
                            data: {"name": name, "desc": desc, "unitPrice": unitPrice, "sellingPrice": sellingPrice, "stocks": (prevStocks+stocks), "category":category, "id":id},
                            success: function(data) {
                                console.log("data = " + data);
                                $("#editProductDiv").dialog("close");
                                showDialog("ATTENTION!", "New product details successfully saved.");
                                displayProductsAdmin();
                            },
                            error: function(data) {
                                console.log("Error in editing product = " + JSON.stringify(data));
                            }
                        });
                    }
                }
            }
        }
    })
}

function viewProduct(id) {
    $.ajax({
        type: "POST",
        url: "../php/objects/products/viewProduct.php",
        data: {"prodId": id},
        success: function(data) {
            $("#productsMainContainer").html(data);
        },
        error: function(data) {
            console.log("error in viewing produc " + JSON.stringify(data));
        }
    });
}

function addToCart(id) {
    $("#dialogDiv").html("Please enter quantity: <br/> <input type='text' id='qEntered' class='input input-lg' required />");
    $("#dialogDiv").dialog({
        title: "Adding to you cart...",
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "SUBMIT": function() {
                var quantity = $("#qEntered").val(); //prompt("Please enter quantity: ");
                if(quantity != "" && quantity > 0) {
                    var cat = id.substring(0, 4);
                    var realID = id.substring(4);
                    if(cat == "prod") cat = "product";
                    else cat = "package";
                    $.ajax({
                        type: "POST",
                        url: "../php/objects/products/addToCart.php",
                        data: {"prodId": realID, "quantity": quantity, "category": cat},
                        success: function(data) {
                            console.log("success " + data);
                            $("#dialogDiv").html("Product was successfully added to your cart! Order more products?");
                            $("#dialogDiv").dialog({
                                title: "Added to Cart!",
                                modal: true,
                                show: "clip",
                                hide: "clip",
                                width: "75%",
                                buttons: {
                                    "Yes": function() {
                                        $(this).dialog("close");
                                        window.location.assign("../products");
                                    },
                                    "View Cart": function() {
                                        window.location.assign("../my-cart");
                                    }
                                }
                            });

                        },
                        error: function(data) {
                            console.log("error in adding to my-cart " + JSON.stringify(data));
                        }
                    });
                }
            }
        }
    });
}

function viewCart() {
    $.ajax({
        type: "POST",
        url: "../php/objects/products/viewCart.php",
        success: function(data) {
            $("#clientTemOrdersContainerDiv").html(data);
            //console.log("success viewing " + data);
        },
        error: function(data) {
            console.log("error in viewing my-cart " + JSON.stringify(data));
        }
    });
}

function removeProductFromCart(tempOrderID) {
    $("#dialogDiv").html("Sure to remove " + $("#tempOrderName"+tempOrderID).html() + " from Your Cart?");
    $("#dialogDiv").dialog({
        title: "CONFIRMATION",
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "Yes": function() {
                $.ajax({
                    type: "POST",
                    url: "../php/objects/products/removeProductFromCart.php",
                    data: {"tempOrderID": tempOrderID},
                    success: function() {
                        $("#dialogDiv").html($("#tempOrderName"+tempOrderID).html() + " successfully removed!");
                        $("#dialogDiv").dialog({
                            buttons: {
                                "Okay": function() {
                                    $("#dialogDiv").dialog("close");
                                }
                            }
                        });
                        viewCart();
                    },
                    error: function(data) {
                        console.log("Error in removing removing product from my-cart: " + JSON.stringify(data));
                    }
                });
            },
            "No": function(){
                $("#dialogDiv").dialog("close");
            }
        }
    });
}

function editQuantityOfProductFromCart(tempOrderID) {
    $("#dialogDiv").html("Enter new quantity for " + $("#tempOrderName"+tempOrderID).html() + ":<br /> <input type='text' class='input input-lg' id='newCartProdQuantity' />");
    $("#dialogDiv").dialog({
        title: "UPDATE",
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "Save New Quantity": function() {
                var newQuantity = $("#newCartProdQuantity").val();
                if(newQuantity != "" && parseInt(newQuantity) === Number(newQuantity) && newQuantity > 0) {
                    $.ajax({
                        type: "POST",
                        url: "../php/objects/products/editQuantityOfProductFromCart.php",
                        data: {"tempOrderID": tempOrderID, "newQuantity": newQuantity},
                        success: function(data) {
                            var price = parseFloat($("#tempOrderPrice"+tempOrderID).html());
                            var newSubtotal = price * parseFloat(newQuantity);
                            $("#tempOrderQuantity"+tempOrderID).html(newQuantity);
                            $("#tempOrderSubtotal"+tempOrderID).html(newSubtotal);
                            console.log('updated ' + data);
                            $("#dialogDiv").html("Quantity for " + $("#tempOrderName"+tempOrderID).html() + " is successfully updated!");
                            $("#dialogDiv").dialog({
                                buttons: {
                                    "Okay": function() {
                                        $("#dialogDiv").dialog("close");
                                    }
                                }
                            });
                        },
                        error: function(data) {
                            console.log("error in updating quantity for my-cart product " + JSON.stringify(data));
                        }
                    });
                }
            },
            "Cancel": function() {
                $("#dialogDiv").dialog("close");
            }

        }
    })
}

function showSubmitOrdersDialog() {
    $("#submitOrdersDiv").dialog({
        title: "Submitting Orders",
        modal: true,
        show: "clip",
        hide: "clip",
        width: "75%"
    });
}

function closeSubmitOrderDivDialog() {
    $("#submitOrdersDiv").dialog("close");
}
/*
function submitOrders(method) {
    var address = $("#whereToDeliver").val();
    var name = $("#nameOfTheReceiver").val();
    var contactNumber = $("#contactNumOfReceiver").val();
    if(address.trim() != "" && name.trim() != "" && contactNumber.trim() != "") {
        $.ajax({
            type: "POST",
            url: "../php/objects/products/submitOrders.php",
            data: {"name": name, "address": address, "number": contactNumber},
            success: function(data) {
                $("#submitOrdersDiv").html("Your orders were successfully submitted!");
                $("#submitOrdersDiv").dialog({
                    buttons: {
                        "OKAY": function() {
                            $("#submitOrdersDiv").dialog("close");
                        }
                    }
                });
                console.log("successful in submiting order " + data);
            },
            error: function(data) {
                console.log("error in submitting orders " +JSON.stringify(data));
            }

        });
    }
}*/

function displayClientTransactionsToClient() {
    $.ajax({
        type: "POST",
        url: "../php/objects/products/displayClientTransactionsToClient.php",
        success: function(data) {
            $("#clientTransactionDiv").html(data);
        },
        error: function(data) {
            console.log("error in displaydisplayClientTransactionsToClient " + JSON.stringify(data));
        }
    });
}

function sendOrderNotificationToAdmin(clientName, address, contact, clientOrders, method) {
    $.ajax({
        type: "POST",
        url: "../php/objects/orders/sendOrderNotificationToAdmin.php",
        data: {"clientName": clientName, "address": address, "contact": contact, "clientOrders": clientOrders, "method": method},
        success: function(data) {
            console.log("message sent! " + data);
            viewCart();
        },
        error: function(data) {
            console.log("error in sending message " + JSON.stringify(data));
        }
    })
}

function submitOrdersThruDeliver() {
    var city = $("#delCity").val();
    var specificAdd = $("#delSpecificAddress").val();
    var nameOfTheReceiver = $("#delNameOfTheReceiver").val();
    var nameOfCareOf = $("#delNameOfCareOf").val();
    var contactNum = $("#delContactNumOfReceiver").val();
    var paymentMethod = $("input[name='delPaymentMethod']").val();

    $.ajax({
        type: "POST",
        url: "../php/objects/products/submitOrders.php",
        data: {"method": "delivery", "address": specificAdd+" / "+city, "nameOfReceiver": nameOfTheReceiver, "nameOfCareOf": nameOfCareOf, "contactNum": contactNum, "paymentMethod": paymentMethod},
        success: function(data) {
            console.log("success " + data);
            $("#submitOrdersDiv").dialog("close");
            showDialog("CONFIRMATION", "Your orders were successfully submitted!");
            sendOrderNotificationToAdmin(nameOfTheReceiver, specificAdd+", "+city, contactNum, data, "delivery");
        },
        error: function(data) {
            console.log("error in submitting orders " + JSON.stringify(data));
        }
    });
}

function submitOrdersThruPickUp() {
    var dateOfPickUp = $("#pickdateOfPickUp").val();
    var nameOfTheReceiver = $("#pickNameOfTheReceiver").val();
    var contactNum = $("#pickContactNumOfReceiver").val();
    var paymentMethod = $("input[name='pickPaymentMethod']").val();


    $.ajax({
        type: "POST",
        url: "../php/objects/products/submitOrders.php",
        data: {"method": "pick-up", "dateOfPickUp":dateOfPickUp, "nameOfReceiver": nameOfTheReceiver, "contactNum": contactNum, "paymentMethod": paymentMethod},
        success: function(data) {
            $("#submitOrdersDiv").dialog("close");
            showDialog("CONFIRMATION", "Your orders were successfully submitted!");

            sendOrderNotificationToAdmin(nameOfTheReceiver, "", contactNum, data, "pick-up");
            console.log("success " + data);
        },
        error: function(data) {
            console.log("error in submitting orders " + JSON.stringify(data));
        }
    });
}

function submitOrdersThruShip() {
    var city = $("#shipCity").val();
    var specificAdd = $("#shipSpecificAddress").val();
    var nameOfTheReceiver = $("#shipNameOfTheReceiver").val();
    var nameOfCareOf = $("#shipNameOfCareOf").val();
    var contactNum = $("#shipContactNumOfReceiver").val();
    var paymentMethod = $("input[name='shipPaymentMethod']").val();
    var area = $("#shipArea").val();

    $.ajax({
        type: "POST",
        url: "../php/objects/products/submitOrders.php",
        data: {"method": "ship", "address": specificAdd+" / "+city+" / "+area, "nameOfReceiver": nameOfTheReceiver, "nameOfCareOf": nameOfCareOf, "contactNum": contactNum, "paymentMethod": paymentMethod},
        success: function(data) {
            $("#submitOrdersDiv").dialog("close");
            showDialog("CONFIRMATION", "Your orders were successfully submitted!");
            sendOrderNotificationToAdmin(nameOfTheReceiver, specificAdd+", "+city, contactNum, data, "ship");
            //console.log("success " + data);
        },
        error: function(data) {
            console.log("error in submitting orders " + JSON.stringify(data));
        }
    });
}

function attachProofOfPayment(transID) {
    $("#attachProofOfPaymentDiv").dialog({
        title: "PROOF OF PAYMENT",
        modal: true,
        show: "clip",
        hide: "clip",
        width: "75%",
        buttons: {
            "SUBMIT": function() {
                if(formData && proofOfPaymentPhoto != "") {
                    formData.append("proofOfPaymentPhoto", proofOfPaymentPhoto);
                    formData.append("description", $("#proofOfPaymentDescription").val());
                    formData.append("transID", transID);
                    $.ajax({
                        type: "POST",
                        url: "../php/objects/products/attachProofOfPayment.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            showDialog("CONFIRMATION", "The photo was successfully uploaded!");
                            displayClientTransactionsToClient();
                        },
                        error: function(data) {
                            console.log("error in attaching proof of payment " + JSON.stringify(data));
                        }
                    });
                } else showDialog("WARNING", "Please attach a photo!");
            },
            "CANCEL": function() {
                $("#attachProofOfPaymentDiv").dialog("close");
            }
        }
    });
}

function showDialog(title, mess) {
    $("#dialogDiv").html(mess);
    $("#dialogDiv").dialog({
        title: title,
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "okay": function() {
                $("#dialogDiv").dialog("close");
            }
        }
    });
}