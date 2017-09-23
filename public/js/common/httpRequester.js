var CONTENT_URL_ENCODED="application/x-www-form-urlencoded";
var CONTENT_JSON="application/json";

function createHTTPRequester(path) {
    if (path == undefined)
        path = '';

    var requester = {
        leave: false,
        nameValuePairs: [],
        jsonObject: null,
        method: "POST",
        path: path,
        perm_index:undefined,
        leftoutExists: false,
        numberExpectedExists: false,
        numberExpectedName: "",
        leftoutName: "",
        pass_unchanged: "",
        content_type: CONTENT_URL_ENCODED,
        setPassUnchanged: function (s) {
            this.pass_unchanged = s;
        },
        addPair: function (n, val, leave1, def) {
            var pair = {name: n, value: val};
            leave = true;
            if ('' + leave1 != 'undefined')
                leave = leave1;

            if ('' + val == 'undefined' || val === '') {
                if (leave) {
                    if ('' + def != 'undefined') {
                        val = def;
                        pair = {name: name1, value: val};
                    }
                }
                else if (!this.leftoutExists && leave !== true) {
                    this.leftoutExists = true;
                    this.leftoutName = n;
                    return;
                }

            }
            this.nameValuePairs.push(pair);
        },
        addPairFromKey: function (key, leave1, def) {

            //console.log($('#'+key));
            leave = false;
            if ('' + leave1 != 'undefined')
                leave = leave1;


            var val = $('#' + key).val();
            var name1 = $('#' + key).attr("name");
            var pair = {name: name1, value: val};
            if ('' + val == 'undefined' || val === '') {
                if (leave) {
                    if ('' + def != 'undefined') {
                        val = def;
                        pair = {name: name1, value: val};
                    }
                }
                else if (!this.leftoutExists && leave !== true) {
                    this.leftoutExists = true;
                    this.leftoutName = key;
                    return;
                }

            }
            //console.log("key:"+key+", val:"+$(key).val());
            this.nameValuePairs.push(pair);
        },
        addNumPairFromKey: function (key, leave1, def) {
            //console.log($('#'+key));
            leave = false;
            if ('' + leave1 != 'undefined')
                leave = leave1;

            var val = $('#' + key).val();
            var name1 = $('#' + key).attr("name");
            var pair = {name: name1, value: val};
            if ('' + val == 'undefined' || val === '') {
                if (leave) {
                    if ('' + def != 'undefined') {
                        val = def;
                        pair = {name: name1, value: val};
                    }
                }
                else if (!this.leftoutExists) {
                    if (leave !== true) {
                        this.leftoutExists = true;
                        this.leftoutName = key;
                        return;
                    }
                }
            }

            if (!$.isNumeric(val)) {
                if (!this.numberExpectedExists) {
                    this.numberExpectedExists = true;
                    this.numberExpectedName = key;
                    return;
                }
            }


            //console.log("key:"+key+", val:"+$(key).val());
            this.nameValuePairs.push(pair);
        },
        send: function (callback) {
            var xmlhttp;
            if (callback != undefined)
                this.onResult = callback;

            if (this.leftoutExists) {
                this.onResult('{"success":0,"message":"Field ' + this.leftoutName + ' cannot be left empty"}');
                return;
            }

            if (this.numberExpectedExists) {
                this.onResult('{"success":0,"message":"Invalid input for ' + this.numberExpectedName + '"}');
                return;
            }

            var req = this;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if (xmlhttp.responseText == "SESSION_TIMEOUT") {
                        // window.location.assign("select_company.php?errmsg=Session timed out");
                        // return;
                    // }else if(xmlhttp.responseText.startsWith("company_expired=")){
                    //     window.location.assign("login.php?"+xmlhttp.responseText);
                    //     return;
                    }
                    else if (xmlhttp.responseText == "REQUEST_DENIED") {
                        setMessageWindow("Request Denied", TOAST_FAIL);
                        return;
                    }
                    else
                        req.onResult(xmlhttp.responseText, this.pass_unchanged);
                }
            };

            xmlhttp.open("POST", this.path, true);
            xmlhttp.setRequestHeader("Content-type", this.content_type);
            xmlhttp.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));


            var s="";
            if(this.content_type == CONTENT_URL_ENCODED) {
                this.addPair("eeja_web", "true", false);
                this.addPair("verify", "true", false);

                console.log(this.nameValuePairs);

                s = createPostString(this.nameValuePairs);
            } else if(this.content_type == CONTENT_JSON){
                s = createJSONString(this.jsonObject);
            }

            xmlhttp.send(s);
        },
        onResult: function (response) {
        }
    };

    return requester;
}

function createJSONString(jObj){
    if(jObj==null)
        return "";

    return jObj.toString();
}

function createPostString(nameValuePairs) {
    var pair, str = "", first = true;
    for (pair in nameValuePairs) {
        if (first)
            first = false;
        else
            str += '&';


        nameValuePairs[pair].value = ('' + nameValuePairs[pair].value).split("&").join(":azee_amp:");

        str += nameValuePairs[pair].name + "=" + nameValuePairs[pair].value;
        //console.log(str);
    }

    console.log("str: " + str);
    return str;
}