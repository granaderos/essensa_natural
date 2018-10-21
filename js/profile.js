$(document).ready(function() {
    displayClientProfile();
});

function displayClientProfile() {
    $.ajax({
        type: "POST",
        url: "../php/objects/profile/displayClientProfile.php",
        success: function(data) {
            $("#tblClientProfile").html(data);
            console.log("profile " + data);
        },
        error: function(data) {
            console.log("error in displaying profile " + JSON.stringify(data));
        }
    })
}