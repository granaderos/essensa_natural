/**
 * Created by Marejean on 10/16/16.
 */

$(document).ready(function() {
    $("input[name='regBirthday']").datepicker({
        defaultDate: new Date(1970, 01, 01)
    });

    changeCode();

    $("#regReset").click(function() {
        $("#registrationForm")[0].reset();
    });

});

function funcRegister() {
    var lName = $("input[name='regLastName']").val();
    var fName = $("input[name='regFirstName']").val();
    var mName = $("input[name='regMiddleName']").val();
    var birthday = $("input[name='regBirthday']").val();
    var gender = $("input[name='regGender']").val();
    var address = $("input[name='regAddress']").val();
    var telNo = $("input[name='regTelNo']").val();
    var cellNo = $("input[name='regCellNo']").val();
    var username = $("input[name='regUsername']").val();
    var pass1 = $("input[name='regPassword']").val();
    var pass2 = $("input[name='regConfirmPassword']").val();

    if(pass1 != pass2) {
        showDialog("Attention!", "Password Mismatched");
    } else {
        if(lName != "" && fName != "" && mName != "" && birthday != "" && gender != "" && address != "" && telNo != "" && cellNo != "" && username != "") {
            var code = $("#codeContainerP").css("background-image");
            code = code.split("/");
            code = code[code.length-1];
            code = code.substr(0, code.indexOf("."));
            var codeEntered = $("#codeEntered").val();
            if(codeEntered != "") {
                alert("code = " + code + "\ncodeEntered = " + codeEntered);
                $.ajax({
                    type: "POST",
                    url: "../php/objects/addUser.php",
                    data: {"lName": lName, "fName": fName, "mName": mName, "birthday": birthday,
                        "gender": gender, "address": address, "telNo": telNo, "cellNo": cellNo,
                        "username": username, "password": pass1, "code": code, "codeEntered": codeEntered},
                    success: function(data) {
                        if(data == "Invalid Code!") {
                            showDialog("Error!", "The code you entered is invalid!")
                        } else {
                            $("#dialogDiv").html("Greetings " + fName + "! Welcome to Essensa Naturale! Your account was successfully created." + data);
                            $("#dialogDiv").dialog({
                                title: "Attention!",
                                modal: true,
                                show: "clip",
                                hide: "clip",
                                buttons: {
                                    "OKAY": function() {
                                        $("#dialogDiv").dialog("close");
                                        $.ajax({
                                            type: "POST",
                                            url: "../php/objects/login.php",
                                            data: {"username": username, "password": pass1},
                                            success: function(data) {
                                                userData = JSON.parse(data);
                                                if(userData.type == "admin") {
                                                    window.location.assign("../a-orders");
                                                } else if(userData.type == "client") {
                                                    window.location.assign("../my-cart");
                                                } else showDialog("ATTENTION!", "Unrecognised account. Please make sure you entered your correct credentials.");
                                            },
                                            error: function(data) {
                                                console.log("Error in logging in = " + JSON.stringify(data));
                                            }
                                        });
                                    }
                                }
                            })
                        }
                    },
                    error: function(data) {
                        console.log("Error in adding user = " + JSON.stringify(data));
                    }
                });
            }
        }
    }
}


function changeCode() {
    var prev = $("#codeContainerP").css("background-image");
    prev = prev.split("/");

    prev = prev[prev.length-1];
    prev = prev.substr(0, prev.indexOf("."));
    var newCode = Math.floor((Math.random() * 15) + 1);
    while(newCode == prev) {
        newCode = Math.floor((Math.random() * 15) + 1);
    }
    $("#codeContainerP").css("background-image", "url(http://localhost/essensabuahmerahmixjuice.com/files/CAPTCHA/"+newCode+".png)");
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