/**
 * Created by Marejean on 9/25/16.
 */

$(document).ready(function() {
   displayMessages();
});

function displayMessages() {
    $.ajax({
        type: "POST",
        url: "../php/objects/displayAllMessages.php",
        success: function(data) {
            $("#tblListOfAllMessage").html(data);
        },
        error: function(data) {
            console.log("error in displaying all messages to a-orders " + JSON.stringify(data));
        }
    });
}

function sendMessageTo(userID) {
    $("#sendMessageToDiv").dialog({
        title: "SEND MESSAGE",
        modal: true,
        show: "clip",
        hide: "clip",
        width: "780px",
        buttons: {
            "SEND": function() {
                var subject = $("#adminSubject").val();
                var message = $("#adminMessage").val();

                if(subject.trim() != "" && message.trim() != "") {
                    $.ajax({
                        type: "POST",
                        url: "../php/objects/sendMessageToAdmin.php",
                        data: {"receiverID": userID, "subject": subject, "message": message},
                        success: function(data) {
                            $("#sendMessageToDiv").dialog("close");
                            showDialog("CONFIRMATION", "Your message has been successfully sent!");
                            console.log("sending " + data)
                        },
                        error: function(data) {
                            console.log("error in sending message " + JSON.stringify(data));
                        }

                    });
                }
            },
            "CANCEL": function() {
                $("#sendMessageToDiv").dialog("close");
            }

        }
    })
}