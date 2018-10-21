/**
 * Created by Marejean on 9/25/16.
 */

function sendMessageToAdmin() {
    var subject = $("input[name='messSubject']").val();
    var message = $("#messMessage").val();

    if(subject.trim() != "" && message.trim() != "") {
        $.ajax({
            type: "POST",
            url: "../php/objects/sendMessageToAdmin.php",
            data: {"subject": subject, "message": message, "receiverID": 3},
            success: function() {
                alert("Your message has been successfully sent!");
                $("input[name='messSubject']").val("");
                $("#messMessage").val("");
            },
            error: function(data) {
                console.log("error in seding message to the a-orders " + JSON.stringify(data));
            }
        });
    }
}