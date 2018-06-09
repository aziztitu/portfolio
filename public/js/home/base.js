/**
 * Created by azizt on 8/26/2017.
 */

AZ.listenForMouseWheel = true;
AZ.lastScrollTime = 0;
AZ.canSwitchSection = true;
AZ.onSectionActivated = null;

const defaultScrollTimeout = 1000;

$(document).ready(function () {
    $('.button-collapse').sideNav();

    var sectionTabs = $("li.section_tab");
    sectionTabs.off('click');
    sectionTabs.click(function () {
        var sectionId = $(this).attr("sectionId");
        activateSection(sectionId)
    });

    prepareSwipeListener();
    prepareMouseWheelListener();

    if (typeof AZ.activeSection !== 'undefined') {
        activateSection(AZ.activeSection);
    }
});

function prepareSwipeListener() {
    var foregroundLayer = $(".foreground_layer");
    /*var hammer = new Hammer(foregroundLayer[0]);
     hammer.get('swipe').set({direction: Hammer.DIRECTION_VERTICAL});
     hammer.on("swipe", function (e) {
     console.log("Swiped!");
     console.log(e);
     // moveSection(e.angle);
     });*/

    var contentObjects = $(".content_object");
    contentObjects.each(function () {
        var contentObject = $(this);
        contentObject.canSwipeUp = false;
        contentObject.canSwipeDown = false;
        contentObject.startYPos = 0;
        contentObject.lastYPos = 0;

        const swipeThreshold = 50;

        contentObject.on('touchstart', function (e) {
            contentObject.startYPos = e.touches[0].pageY;
            contentObject.lastYPos = e.touches[0].pageY;

            if (contentObject.scrollTop() == 0) {
                contentObject.canSwipeUp = true;
            }
            if (contentObject[0].scrollHeight - contentObject.scrollTop() == contentObject.outerHeight()) {
                contentObject.canSwipeDown = true;
            }
            // console.log(e);
        });
        contentObject.on('touchmove', function (e) {

            contentObject.lastYPos = e.touches[0].pageY;
            // console.log(e);
        });
        contentObject.on('touchend', function (e) {
            var swipeValue = contentObject.lastYPos - contentObject.startYPos;
            if (swipeValue > swipeThreshold) {
                if (contentObject.canSwipeUp) {
                    moveSection(1);
                }
            } else if (swipeValue < (swipeThreshold * -1)) {
                if (contentObject.canSwipeDown) {
                    moveSection(-1);
                }
            }

            contentObject.canSwipeUp = false;
            contentObject.canSwipeDown = false;
        });
        contentObject.on('touchcancel', function (e) {
            contentObject.canSwipeUp = false;
            contentObject.canSwipeDown = false;
            // console.log(e);
        });
    });

}

function prepareMouseWheelListener() {
    var foregroundLayer = $(".foreground_layer");
    foregroundLayer.bind('mousewheel wheel', function (e) {

        if (!AZ.listenForMouseWheel) {
            e.preventDefault();
            return;
        }

        var direction/* = e.originalEvent.wheelDelta / 120*/;
        direction = e.originalEvent.deltaY * -1;

        // console.log("Delta Y: "+e.originalEvent.deltaY);
        // console.log("Dir: "+direction);
        // console.log(e.originalEvent);

        var sectionTabs = $("li.section_tab.mobile");
        var activeSectionId = null;
        sectionTabs.each(function () {
            var sectionId = $(this).attr("sectionId");
            if ($(this).hasClass("active")) {
                activeSectionId = sectionId;
            }
        });


        var curTime = new Date().getTime();
        if (activeSectionId != null) {
            var contentObject = $(".content_object[sectionid='" + activeSectionId + "']");
            console.log("Scroll Top: " + contentObject.scrollTop());
            if (direction > 0) {
                if (contentObject.scrollTop() != 0) {
                    AZ.lastScrollTime = curTime;
                    return;
                }
            } else if (direction < 0) {
                if (contentObject[0].scrollHeight - contentObject.scrollTop() != contentObject.outerHeight()) {
                    AZ.lastScrollTime = curTime;
                    return;
                }
            }
        }

        if (curTime - AZ.lastScrollTime < defaultScrollTimeout + 500) {
            return;
        }
        AZ.lastClientY = e.clientY;

        e.preventDefault();

        // console.log(e);
        moveSection(direction);
    });
}

function moveSection(direction) {
    if (!AZ.canSwitchSection) {
        return;
    }

    AZ.lastClientY = -1;
    var sectionTabs = $("li.section_tab.mobile");
    var prevSectionId = null;
    var activeSectionId = null;
    var nextSectionId = null;
    sectionTabs.each(function () {
        var sectionId = $(this).attr("sectionId");
        if ($(this).hasClass("active")) {
            activeSectionId = sectionId;
        } else {
            if (activeSectionId == null) {
                prevSectionId = sectionId;
            } else {
                if (nextSectionId == null) {
                    nextSectionId = sectionId;
                }
            }
        }
    });

    if (direction > 0) {
        // alert('up');
        if (prevSectionId != null) {
            AZ.listenForMouseWheel = false;
            activateSection(prevSectionId);
        }
    }
    else if (direction < 0) {
        // alert('down');
        if (nextSectionId != null) {
            AZ.listenForMouseWheel = false;
            activateSection(nextSectionId);
        }
    }
    else {
        if (activeSectionId != null) {
            // AZ.listenForMouseWheel = false;
            activateSection(activeSectionId);
        }
    }
}


function activateSection(sectionId) {

    $("li.section_tab").removeClass("active");
    $("li.section_tab[sectionId='" + sectionId + "']").addClass("active");

    var contentObject = $(".content_object[sectionId='" + sectionId + "']");
    contentObject.scrollTop(0);
    if (contentObject.offset().top != 0) {
        var contentPane = $(".foreground_layer").find(".pane.content");
        contentPane.animate({
            scrollTop: contentPane.scrollTop() + contentObject.offset().top
        }, {
            duration: 1000,
            easing: 'easeOutCubic',
            complete: function () {

                setTimeout(function () {
                    AZ.listenForMouseWheel = true;
                }, defaultScrollTimeout);
            }
        });
        AZ.listenForMouseWheel = false;

        if (AZ.onSectionActivated) {
            setTimeout(function () {
                AZ.onSectionActivated(sectionId);
            }, 300);
        }
    }

    var backgroundObject = $(".background_object[sectionId='" + sectionId + "']");
    if (backgroundObject.offset().top != 0) {
        var backgroundLayer = $(".background_layer");
        backgroundLayer.animate({
            scrollTop: backgroundLayer.scrollTop() + backgroundObject.offset().top
        }, {
            duration: 1500,
            easing: 'easeOutCubic'
        });
    }
}