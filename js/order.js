$(document).ready(function() {
    displayAvailablePackages();
    displayTransactionsToAdmin();

    $("#displayOrdersDate").datepicker();
    $("#btnDisplayOrdersOnDate").tooltip();
    displayMonthlySalesGraph();

    $("#btnDisplayOrdersOnDate").click(function() {
        displayOrdersOnTheSpecifiedDate();
    });

    $("#aDisplaySales").click(function() {
        displaySales();
    });
});

function displayMonthlySalesGraph() {
    var monthNames = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    var monthlySales = new Array();
    var year = "2016";

    $.ajax({
        type:'POST',
        data: {"year": year},
        url:'../php/objects/orders/getMonthlySales.php',
        success:function(data){
            if(data){ //if it returns an array of values
                var obj = JSON.parse(data);
                var month = "";
                for(var ctr=0; ctr<obj.length; ctr++){
                    var monthlySalesContent = new Array();
                    month = monthNames[obj[ctr][0]-1];
                    monthlySalesContent.push(parseFloat(obj[ctr][1]).toFixed(2));
                    monthlySalesContent.push(month);
                    if(obj[ctr][1] > 1000){
                        monthlySalesContent.push("#f00");
                    }else if(obj[ctr][1] > 500){
                        monthlySalesContent.push("#ff0");
                    }else{
                        monthlySalesContent.push("#006400");
                    }
                    monthlySales.push(monthlySalesContent);
                };

                $('#barGraphDiv').html("");
                $('#barGraphDiv').jqBarGraph({
                    data: monthlySales,
                    width: 	700,
                    height: 200,
                    colors: ["#f00","#ff0","#006400"],
                    barSpace:2,
                    prefix: "&#8369; ",
                    legend:true,
                    legends:["[1000+]","[500+]","[499 below]"]
                });

            }else{
                $('#barGraphDiv').html("<h2>NO RECORDS</h2>");
            }
        },
        error:function(data){
            alert('Error on displaying bargraph => '+ data['status'] + " " + data['statusText']);
        }
    })
}

function displaySales() {
    var category = $("#selectSalesRecord").val();
    $.ajax({
        type: "POST",
        url: "../php/objects/orders/displaySalesRecord.php",
        data: {"category": category},
        success: function(data) {
            $("#tranasctionsContainer").html(data);
        },
        error: function(data) {
            console.log("error in displaying sales " + JSON.stringify(data));
        }
    });

}

function displayOrdersOnTheSpecifiedDate() {
    var date = $("#displayOrdersDate").val();

    if(date != "") {
        date = date.split("/");
        var newDate = date[2] + "-" + date[0] + "-" + date[1];

        $.ajax({
            type: "POST",
            url: "../php/objects/orders/displayOrdersOnTheSpecifiedDate.php",
            data: {"date": newDate},
            success: function(data) {
                $("#tblTransactionList").html(data);
            },
            error: function(data) {
                console.log("error in displaying orders on specified date " + JSON.stringify(data));
            }
        });

    } else displayTransactionsToAdmin();
}

function displayAvailablePackages() {
    $.ajax({
        type: "POST",
        url: "../php/objects/orders/displayAvailablePackages.php",
        success: function(data) {
            $("#packages").html(data);
        },
        error: function(data) {
            console.log("error in displaying available packages = " + JSON.stringify(data));
        }
    });
}

function addToCart(id) {
    alert("hey " + id);
    var userID = $("#currentUserID").val();
    if(userID == "") {
        showDialog("ATTENTION!", "Please <a href='index.php'>login</a> first.");
    } else {
        //showDialog("", "Processing\nUser is " + $("#currentUsername").val() + " and type is " + $("#currentUserType").val());
        $("#addToCartDiv").dialog({
            title: "INFORMATION REQUIRED",
            modal: true,
            show: "clip",
            hide: "clip",
            buttons: {
                "Confirm Order": function() {
                    $.ajax({
                        type: "POST",
                        url: "../php/objects/orders/addOrder.php",
                        data: {"packageId": id, "userId": $("#currentUserID").val()},
                        success: function(data) {
                            // text | notify the a-orders about the order;;;;

                        },
                        error: function(data) {
                            console.log("error in adding orders = " + JSON.stringify(data))
                        }
                    });
                },
                "Cancel": function() {
                    $("#addToCartDiv").dialog("close");
                }
            }
        })
    }
}

function displayPackageInfo(id) {
    $("#btnAddToCart"+id).css("display", "block");
    $("#pack"+id).css("display", "block");
}

function hidePackageInfo(id) {
    $("#pack"+id).css("display", "none");
    $("#btnAddToCart"+id).css("display", "none");
}

function displayTransactionsToAdmin() {
    $.ajax({
        type: "POST",
        url: "../php/objects/products/displayTransactionsToAdmin.php",
        success: function(data) {

            $("#tranasctionsContainer").html("<h4 class='alert alert-info'>List of Orders</h4>"+
                "<table id='tblTransactionList' class='table table-responsive table-hover'>"+data+"</table>");

        },
        error: function(data) {
            console.log("error in displaying transactions to a-orders " + JSON.stringify(data));
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
    })
}

function showTransactionDetails(transID) {
    $.ajax({
        type: "POST",
        url: "../php/objects/orders/showTransactionDetails.php",
        data: {"transID": transID},
        success: function(data) {
            $("#tranasctionsContainer").html(data);
            console.log("trans display " + data);
        },
        error: function(data) {
            console.log("error in showing transaction details " + JSON.stringify(data));
        }
    });
}

function confirmProofOfPayment(transID) {
    $("#dialogDiv").html("Confirm that this photo is a proof of payment?");
    $("#dialogDiv").dialog({
        title: "CONFIRMATION",
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "YES": function() {
                $.ajax({
                    type: "POST",
                    url: "../php/objects/products/confirmProofOfPayment.php",
                    data: {"transID": transID},
                    success: function(data) {
                        console.log("success in confirming " + data);
                        showDialog("CONFIRMATION", "Payment Confirmed!")
                        displayTransactionsToAdmin();
                        showTransactionDetails(transID);
                    },
                    error: function(data) {
                        console.log("error in confirming proof of payment " + JSON.stringify(data));
                    }
                });
            },
            "CANCEL": function() {
                $("#dialogDiv").dialog("close");
            }
        }
    });
}


function confirmDelivery(transID) {
    $("#dialogDiv").html("This transaction is done?");
    $("#dialogDiv").dialog({
        title: "CONFIRMATION",
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "YES": function() {
                $.ajax({
                    type: "POST",
                    url: "../php/objects/orders/confirmDelivery.php",
                    data: {"transID": transID},
                    success: function(data) {
                        $("#dialogDiv").html("The status of this transaction was successfully updated!");
                        $("#dialogDiv").dialog({
                            buttons: {
                                "OKAY": function() {
                                    $(this).dialog("close");
                                    window.location.assign("index.php");
                                }
                            }
                        });
                        console.log("success in confirming deliver " + data);

                    },
                    error: function(data) {
                        console.log("error in confirming delivery " + JSON.stringify(data));
                    }
                });
            },
            "CANCEL": function() {
                $("#dialogDiv").dialog("close");
            }
        }
    })
}