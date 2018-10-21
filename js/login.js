/**
 * Created by Marejean on 10/16/16.
 */


var userData;
function funcLogin() {
    var username = $("input[name='usernameEntered']").val();
    var password = $("input[name='passwordEntered']").val();

    if(username == "") $("input[name='usernameEntered']").focus();
    else if(password == "") $("input[name='passwordEntered']").focus();
    else {
        $.ajax({
            type: "POST",
            url: "../php/objects/login.php",
            data: {"username": username, "password": password},
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