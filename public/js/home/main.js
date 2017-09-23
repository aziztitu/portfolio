/**
 * Created by azizt on 8/30/2017.
 */

var lastResizeCount = 0;
var refreshers = [];

$(document).ready(function () {
    // refreshCarousel();
    $(window).resize(function () {
        lastResizeCount++;

        var refresher = {
            count: 0,
            waitAndRefresh: function (count) {
                this.count = count;
                var obj = this;
                setTimeout(function () {
                    if (lastResizeCount == obj.count) {
                        onPageResized();
                        refreshers.forEach(function (e) {
                            e.count = -1;
                        });
                        refreshers = [];
                    }
                }, 100);
            }
        };

        refresher.waitAndRefresh(lastResizeCount);
        refreshers.push(refresher);

    });

    redrawProjects();
    redrawSkills();
    refreshTooltips();
});

function onPageResized() {
    console.log("Resized");

    moveSection(0);
    redrawProjects();
}

function redrawProjects() {
    var maxHeight = 0;
    $('.project_item').resize();
    $('.project_item').each(function () {
        var h = $(this).height();
        if (h > maxHeight) {
            maxHeight = h;
        }
    });

    console.log("Max Height: " + maxHeight);

    $('.project_item').each(function () {
        $(this).height(maxHeight);
        console.log($(this));
    });

    $('.carousel').carousel('destroy');
    $('.carousel').carousel();
}

function redrawSkills() {
    var maxHeight = 0;
    $('.skill').resize();
    $('.skill').each(function () {
        var h = $(this).height();
        if (h > maxHeight) {
            maxHeight = h;
        }
    });

    console.log("Max Height: " + maxHeight);

    $('.skill').each(function () {
        $(this).height(maxHeight);
        console.log($(this));
    });
}


function filterProjects(projectType) {
    var projectsContentObject = $('.content_object[sectionId="projects"]');

    console.log(projectsContentObject.children("filter"));

    projectsContentObject.find(".filter").removeClass("active");
    projectsContentObject.find(".filter[projecttype='" + projectType + "']").addClass("active");

    const animLength = 200;
    if (projectType == 'all') {
        $('.project_item').show(animLength);
    } else {
        $('.project_item:not(.type_' + projectType + ')').hide(animLength, function () {
            $('.project_item.type_' + projectType).show(animLength);
        });
    }
}

function sendMessage() {

    var sendMessageWrapper = $(".send_message_wrapper");
    var name = sendMessageWrapper.find("#name").val();
    var email = sendMessageWrapper.find("#email").val();
    var subject = sendMessageWrapper.find("#subject").val();
    var message = sendMessageWrapper.find("#message").val();

    if (name.trim() == "") {
        setMessageWindow("Enter your name", TOAST_FAIL);
        return;
    } else if (email.trim() == "") {
        setMessageWindow("Enter your email", TOAST_FAIL);
        return;
    } else if (subject.trim() == "") {
        setMessageWindow("Enter a subject", TOAST_FAIL);
        return;
    } else if (message.trim() == "") {
        setMessageWindow("Enter a message", TOAST_FAIL);
        return;
    }

    var httpRequester = createHTTPRequester("/sendMessage");
    httpRequester.addPair("name", name);
    httpRequester.addPair("email", email);
    httpRequester.addPair("subject", subject);
    httpRequester.addPair("message", message);
    httpRequester.send(function (response) {
        sendMessageWrapper.find(".send_msg_btn").prop("disabled", false);
        var jsonObject = JSON.parse(response);
        if (jsonObject != null) {
            if (jsonObject.success == 1) {
                setMessageWindow("Message sent successfully!", TOAST_SUCCESS);
                sendMessageWrapper.find("#name").val("");
                sendMessageWrapper.find("#email").val("");
                sendMessageWrapper.find("#subject").val("");
                sendMessageWrapper.find("#message").val("");
            } else {
                setMessageWindow("Error: " + jsonObject.message, TOAST_FAIL);
            }
        }
    });
    sendMessageWrapper.find(".send_msg_btn").prop("disabled", true);
    setMessageWindow("Sending your message.. Please wait...")

}