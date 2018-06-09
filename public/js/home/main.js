/**
 * Created by azizt on 8/30/2017.
 */

var lastResizeCount = 0;
var refreshers = [];

var projectViewerModal;

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

    projectViewerModal = $('#project-viewer-modal');
    projectViewerModal.modal({
        dismissible: true,
        opacity: .5,
        // inDuration: 300,
        // outDuration: 600,
        ready: function () {
            // blurBG();
            // if (openCallback)
            //     openCallback();

            AZ.canSwitchSection = false;
        },
        complete: function () {
            // unblurBG();
            // if (closeCallback)
            //     closeCallback();
            AZ.canSwitchSection = true;
        }
    });

    redrawProjects();
    redrawSkills();
    refreshTooltips();

    initSections();

    AZ.onSectionActivated = function (sectionId) {
        let sectionContentObj = $('.content_object[sectionId=' + sectionId + ']');
        if (sectionContentObj.attr('animated') == "true") {
            return;
        }

        switch (sectionId) {
            case 'welcome':
                onWelcomeActivated();
                break;
            case 'about_me':
                onAboutMeActivated();
                break;
            case 'skills':
                onSkillsActivated();
                break;
            case 'projects':
                onProjectsActivated();
                break;
            case 'contact_me':
                onContactMeActivated();
                break;
            case 'resume':
                onResumeActivated();
                break;
        }

        sectionContentObj.attr('animated', "true");
    };

    AZ.onSectionActivated('welcome');
});

function onPageResized() {
    console.log("Resized");

    moveSection(0);
    redrawProjects();
}


function initSections() {
    let welcomeBackgroundObject = $('.background_object[sectionId=welcome]');
    welcomeBackgroundObject.attr('id', 'welcome-particle-bg');
    welcomeBackgroundObject.css('background-image', '');
    welcomeBackgroundObject.css('background', 'radial-gradient(#00092d, #020616)');

    particlesJS.load('welcome-particle-bg', 'json/particlesjs-welcome-config.json', function () {
        console.log('callback - particles.js config loaded');
    });

    $('.title.welcome').css('visibility', 'hidden');
    $('.title.name').css('visibility', 'hidden');

    $('.about_me_table').find('td.value').find('span.content').css('visibility', 'hidden');

    $('.skills_wrapper').find('.skill').each(function () {
        let nameObj = $(this).find('.skill_name');
        let experienceObj = $(this).find('.skill_experience');
        let levelObj = $(this).find('.skill_level');

        nameObj.css('opacity', 0);
        experienceObj.css('opacity', 0);
        levelObj.css('opacity', 0);
        levelObj.css('width', 0);
    });

    $('.projects_wrapper').find('.project_item').find('.project').each(function () {
        $(this).css('opacity', 0);
        $(this).css('transform', 'translate(-50px, 0px)');
    });

    $('.send_message_content').find('.input-field').each(function () {
        $(this).css('opacity', 0);
        $(this).css('transform', 'translate(0px, -50px)');
    });

    $('#designed_by').css('visibility', 'hidden');
}

function onWelcomeActivated() {
    $('.title.welcome').css('visibility', 'visible');
    typeDynamically('.title.welcome', 35, 0, function () {
        $('.title.name').css('visibility', 'visible');
        typeDynamically('.title.name', 45);
    });
}

function onAboutMeActivated() {
    let aboutMeTypedContents = $('.about_me_table').find('td.value').find('span.content');
    aboutMeTypedContents.css('visibility', 'visible');

    aboutMeTypedContents.each(function () {
        let contentObject = $(this);
        typeDynamically('#' + contentObject.attr('id'), 40, 0, function () {
            contentObject.parent().find('.typed-cursor').fadeOut(1500);
        });
    });
}

function onSkillsActivated() {
    let delay = 0;
    $('.skills_wrapper').find('.skill').each(function () {
        let nameObj = $(this).find('.skill_name');
        let experienceObj = $(this).find('.skill_experience');
        let levelObj = $(this).find('.skill_level');

        let duration = 100;
        setTimeout(function () {
            nameObj.css("opacity", 1);
            experienceObj.css("opacity", 1);
            levelObj.css("opacity", 1);
            levelObj.css('width', levelObj.attr('skill-level'));
        }, delay);
        delay += duration;

    });
}

function onProjectsActivated() {
    let delay = 0;
    $('.projects_wrapper').find('.project_item').find('.project').each(function () {
        let projectObj = $(this);

        let duration = 200;
        setTimeout(function () {
            projectObj.css('opacity', 1);
            projectObj.css('transform', 'translate(0, 0)');
        }, delay);
        delay += duration;
    });
}

function onContactMeActivated() {
    let delay = 100;
    $('.send_message_content').find('.input-field').each(function () {
        let inputFieldObj = $(this);

        let duration = 200;
        setTimeout(function () {
            inputFieldObj.css('opacity', 1);
            inputFieldObj.css('transform', 'translate(0, 0)');
        }, delay);
        delay += duration;
    });
}

function onResumeActivated() {

    setTimeout(function () {
        $('#designed_by').css('visibility', 'visible');
        typeDynamically('#designed_by', 45);
    }, 300);
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
        let projectItems = $('.project_item');
        projectItems.show(animLength);
    } else {
        $('.project_item:not(.type_' + projectType + ')').hide(animLength);
        $('.project_item.type_' + projectType).show(animLength);
    }
}

function showProjectInfo(projectId) {
    let projectInfoWrapper = $('#project_infos_container').find('.project_info_wrapper[projectid=' + projectId + ']');

    let clonedProjectInfo = projectInfoWrapper.clone();
    let mediaSlider = clonedProjectInfo.find('.media-slider');
    mediaSlider.lightSlider({
        autoWidth: true,
        enableDrag: false,
        onSliderLoad: function(el) {
            mediaSlider.removeClass('cS-hidden');
            mediaSlider.lightGallery({
                autoplay: true,
                exThumbImage: 'data-thumb'
            });

            mediaSlider.on('onAfterOpen.lg', function (e) {
                // console.log(projectViewerModal[0].M_Modal);
                projectViewerModal[0].M_Modal.options.dismissible = false;
            });
            mediaSlider.on('onCloseAfter.lg', function (e) {
                projectViewerModal[0].M_Modal.options.dismissible = true;
            });
        }
    });

    projectViewerModal.find('.modal-content').empty();
    projectViewerModal.find('.modal-content').append(clonedProjectInfo);

    projectViewerModal.modal('open');
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