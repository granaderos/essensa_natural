/**
 * Created by Marejean on 10/3/16.
 */

var formData = false;
var testimonialPhoto = "";

$(document).ready(function() {
    displayTestimonialsToAdmin();

    if(window.FormData) formData = new FormData();
    $("input[name='testimonialPhoto']").change(function() {
       testimonialPhoto = this.files[0];
    });

});

function addTestimonial() {
    var title = $("input[name='testimonialTitle']").val();
    var content = $("textarea[name='testimonialContent']").val();
    var nameAndAge = $("input[name='nameAndAge']").val();

    if(formData && testimonialPhoto != "") {

        formData.append("title", title);
        formData.append("content", content);
        formData.append("nameAndAge", nameAndAge);
        formData.append("photo", testimonialPhoto);

        $.ajax({
            type: "POST",
            url: "../php/objects/testimonials/addTestimonial.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                showDialog("CONFIRMATION", "New testimonial was added!");
                displayTestimonialsToAdmin();
                console.log("added " + data);

                $("input[name='testimonialTitle']").val("");
                $("textarea[name='testimonialContent']").val("");
                $("input[name='nameAndAge']").val("");
                $("input[name='testimonialPhoto']").val("");
            },
            error: function(data) {
                console.log("error in adding testimonial " + JSON.stringify(data));
            }
        });
    }
}

function displayTestimonialsToAdmin() {
    $.ajax({
        type: "POST",
        url: "../php/objects/testimonials/displayTestimonialsToAdmin.php",
        success: function(data) {
            $("#tblTestimoniesListAdmin").html(data);
        },
        error: function(data) {
            console.log("error in displaying testimonials to admin " + JSON.stringify(data));
        }
    });
}

function editTestimonialTile(testimonialID) {
    var previousTitle = $("#testimonialTitle"+testimonialID + " span").html();
    $("#testimonialTitle"+testimonialID).html("<input type='text' value='" + previousTitle + "' id='newTestimonialTitle"+testimonialID+"' class='form-control input input-lg' onblur='saveTestimonialTitle("+testimonialID+")' />");
}

function saveTestimonialTitle(testimonialID) {
    var newTestimonialTitle = $("#newTestimonialTitle"+testimonialID).val();
    if(newTestimonialTitle.trim() != "") {
        $("#testimonialTitle"+testimonialID).html("<span>\""+newTestimonialTitle+"\"</span><a class='pull-right clickable glyphicon glyphicon-edit' title='click to edit this title' onclick='editTestimonialTile("+testimonialID+")'></a>")

        $.ajax({
            type: "POST",
            url: "../php/objects/testimonials/editTestimonialTitle.php",
            data: {"testimonialID": testimonialID, "newTitle": newTestimonialTitle},
            success: function(data) {
                console.log("good " + data);
            },
            error: function(data) {
                console.log("error in editing testimonial title " + JSON.stringify(data));
            }
        });
    }
}

function editTestimonialContent(testimonialID) {
    var previousContent = $("#testimonialContent"+testimonialID + " #content").html();
    $("#testimonialContent"+testimonialID).html("<textarea id='newTestimonialContent"+testimonialID+"' class='form-control' onblur='saveTestimonialContent("+testimonialID+")'>" + previousContent + "</textarea>");
}

function saveTestimonialContent(testimonialID) {
    var newContent = $("#newTestimonialContent"+testimonialID).val();
    if(newContent.trim() != "") {
        $("#testimonialContent"+testimonialID).html("<span id='content'>"+newContent+"</span><a class='pull-right clickable glyphicon glyphicon-edit' title='click to edit this content' onclick='editTestimonialContent("+testimonialID+")'></a>")

        $.ajax({
            type: "POST",
            url: "../php/objects/testimonials/editTestimonialContent.php",
            data: {"testimonialID": testimonialID, "newContent": newContent},
            success: function(data) {
                console.log("good " + data);
            },
            error: function(data) {
                console.log("error in editing testimonial content" + JSON.stringify(data));
            }
        });
    }
}

function editTestimonialNameAndAge(testimonialID) {
    var previousNameAndAge= $("#testimonialNameAndAge"+testimonialID + " #content").html();
    $("#testimonialNameAndAge"+testimonialID).html("<input onsubmit='alert(\'wew\')' id='newTestimonialNameAndAge"+testimonialID+"' value='"+previousNameAndAge+"' class='form-control input input-lg' onblur='saveTestimonialNameAndAge("+testimonialID+")' />");
}

function saveTestimonialNameAndAge(testimonialID) {
    var newNameAndAge = $("#newTestimonialNameAndAge"+testimonialID).val();
    if(newNameAndAge.trim() != "") {
        $("#testimonialNameAndAge"+testimonialID).html("--<span id='content'>"+newNameAndAge+"</span><a class='pull-right clickable glyphicon glyphicon-edit' title='click to edit this information' onclick='editTestimonialNameAndAge("+testimonialID+")'></a>")

        $.ajax({
            type: "POST",
            url: "../php/objects/testimonials/editTestimonialNameAndAge.php",
            data: {"testimonialID": testimonialID, "newNameAndAge": newNameAndAge},
            success: function(data) {
                console.log("good " + data);
            },
            error: function(data) {
                console.log("error in editing testimonial name and age" + JSON.stringify(data));
            }
        });
    }
}

function approveTestimonial(testimonialID) {
    $("#dialogDiv").html("Sure to approve this testimonial? This will be displayed on the Testimonials Pages when approved.");
    $("#dialogDiv").dialog({
        title: "CONFIRMATION",
        modal: true,
        show: "clip",
        hide: "clip",
        buttons: {
            "YES": function() {
                $.ajax({
                    type: "POST",
                    url: "../php/objects/testimonials/approveTestimonial.php",
                    data: {"testimonialID": testimonialID},
                    success: function(data) {
                        $("#testimonialStatus"+testimonialID).html("<span class='pull-right label label-info'><span class='glyphicon glyphicon-ok'></span> Approved</span>");
                        console.log("testimonial approved: " + data);
                    },
                    error: function(data) {
                        console.log("error in approving " + JSON.stringify(data));
                    }
                })
                $("#dialogDiv").dialog("close");
            },
            "CANCEL": function() {
                $("#dialogDiv").dialog("close");
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