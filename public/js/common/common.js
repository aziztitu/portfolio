/**
 * Created by azizt on 9/17/2017.
 */
var TOAST_SUCCESS = "green white-text", TOAST_FAIL = "red white-text";

function setMessageWindow(msg, type) {
    setMessageWindowFor(msg, 3000, type);
}

function setMessageWindowForInfinity(msg, type) {
    setMessageWindowFor(msg, Infinity, type);
}

function setMessageWindowFor(msg, time, type) {
    console.log("Message Window: " + msg);
    console.log("Message Type: " + type);

    if ('' + type == 'undefined') {
        Materialize.toast(msg, time);
    }
    else
        Materialize.toast(msg, time, type);

    setClickToRemoveToast();
}

function setClickToRemoveToast() {
    $(".toast").last().click(function (event) {
        console.log("Clicked toast");
        var target = $(event.target);
        console.log(target[0].parentNode);
        target.fadeOut(300, function () {
            target[0].parentNode.removeChild(target[0]);
        });
    });
}

function refreshTooltips(){
    $('.tooltipped').tooltip({delay: 50});
}