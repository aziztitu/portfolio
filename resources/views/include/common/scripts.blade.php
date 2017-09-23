<?php
/**
 * Created by PhpStorm.
 * User: azizt
 * Date: 6/9/2017
 * Time: 5:18 PM
 */
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.8/p5.min.js"></script>--}}
<script type="text/javascript" src="/js/common/materialize.min.js"></script>
<script type="text/javascript" src="/js/common/common.js"></script>
<script type="text/javascript" src="/js/common/httpRequester.js"></script>


<!--suppress JSUnresolvedVariable -->
<script>

    //For loading resources asynchronously
    //TODO: Remove the timeout!!
    console.warn("During prod, scripts.blade.php: Remove Timeout. Setup logic for caching async resources");

    AZ.asyncScripts = [];
    AZ.asyncStylesheets = [];
    AZ.loadedScripts = 0;
    AZ.loadedStylesheets = 0;
    AZ.loadSourcesAsync = function (callback, obj) {
        AZ.loadedScripts = 0;
        AZ.loadedStylesheets = 0;
        setTimeout(function () {
            var onSourceLoaded = function(){
                if(AZ.loadedScripts == AZ.asyncScripts.length && AZ.loadedStylesheets == AZ.asyncStylesheets.length){
                    callback(obj);
                }
            };

            AZ.asyncScripts.forEach(function(src){
                AZ.loadSourceWithAJAX(src, 'script', onSourceLoaded, this, false);
            });
            AZ.asyncStylesheets.forEach(function(src){
                AZ.loadSourceWithAJAX(src, 'stylesheet', onSourceLoaded, this, false);
            });
        }, 1500);
    };


    AZ.loadSourceWithAJAX = function(src, type, onSourceLoaded, obj, cache=true) {
        $.ajax({
            url: src,
            dataType: type,
            cache: cache, // TODO: set this to true once published, or set up a logic for caching
            success: function () {
                if (type == 'script') {
                    AZ.loadedScripts++;
                } else {
                    AZ.loadedStylesheets++;
                }
                onSourceLoaded(obj);
            }
        });
    };
</script>
