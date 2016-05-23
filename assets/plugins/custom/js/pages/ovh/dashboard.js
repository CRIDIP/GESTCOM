(function($){
    $('*[data-jquery-clock]').each(function() {
        var t = $(this);
        var seconds = new Date().getSeconds(),
            hours = new Date().getHours(),
            mins = new Date().getMinutes(),
            sdegree = seconds * 6,
            hdegree = hours * 30 + (mins / 2),
            mdegree = mins * 6;
        var updateWatch = function() {
            sdegree += 6;
            if (sdegree % 360 == 0) {
                mdegree += 6;
            }
            hdegree += (0.1 / 12);
            var srotate = "rotate(" + sdegree + "deg)",
                hrotate = "rotate(" + hdegree + "deg)",
                mrotate = "rotate(" + mdegree + "deg)";
            $(".jquery-clock-sec", t).css({
                "-moz-transform": srotate,
                "-webkit-transform": srotate,
                '-ms-transform': srotate
            });
            $(".jquery-clock-hour", t).css({
                "-moz-transform": hrotate,
                "-webkit-transform": hrotate,
                '-ms-transform': hrotate
            });
            $(".jquery-clock-min", t).css({
                "-moz-transform": mrotate,
                "-webkit-transform": mrotate,
                '-ms-transform': mrotate
            });
        }
        updateWatch();
        setInterval(function() {
            $(".jquery-clock-sec, .jquery-clock-hour, .jquery-clock-min").addClass('jquery-clock-transitions');
            updateWatch();
        }, 1000);
        $(window).focus(function() {
            $(".jquery-clock-sec, .jquery-clock-hour, .jquery-clock-min").addClass('jquery-clock-transitions');
        });
        $(window).blur(function() {
            $(".jquery-clock-sec, .jquery-clock-hour, .jquery-clock-min").removeClass('jquery-clock-transitions');
        });
    });

    function count_cloud(){
        $("#cloud").html("<img src='../../../../../assets/images/preloader/loader_ajax.gif' />");
        $.ajax("../../../../../controller/ovh/dashboard.ajax.php?action=count_cloud", {
            dataType: 'json',
            type: 'GET',
            success: function(data){
                $("#cloud").text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_dedie(){
        $("#dedie").html("<img src='../../../../../assets/images/preloader/loader_ajax.gif' />");
        $.ajax("../../../../../controller/ovh/dashboard.ajax.php?action=count_dedie", {
            dataType: 'json',
            type: 'GET',
            success: function(data){
                $("#dedie").text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_domaine(){
        $("#domaine").html("<img src='../../../../../assets/images/preloader/loader_ajax.gif' />");
        $.ajax("../../../../../controller/ovh/dashboard.ajax.php?action=count_domaine", {
            dataType: 'json',
            type: 'GET',
            success: function(data){
                $("#domaine").text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_email(){
        $("#email").html("<img src='../../../../../assets/images/preloader/loader_ajax.gif' />");
        $.ajax("../../../../../controller/ovh/dashboard.ajax.php?action=count_email", {
            dataType: 'json',
            type: 'GET',
            success: function(data){
                $("#email").text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_fax(){
        $("#fax").html("<img src='../../../../../assets/images/preloader/loader_ajax.gif' />");
        $.ajax("../../../../../controller/ovh/dashboard.ajax.php?action=count_fax", {
            dataType: 'json',
            type: 'GET',
            success: function(data){
                $("#fax").text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_hebergement(){
        $("#hebergement").html("<img src='../../../../../assets/images/preloader/loader_ajax.gif' />");
        $.ajax("../../../../../controller/ovh/dashboard.ajax.php?action=count_hebergement", {
            dataType: 'json',
            type: 'GET',
            success: function(data){
                $("#hebergement").text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_license(){
        $("#license").html("<img src='../../../../../assets/images/preloader/loader_ajax.gif' />");
        $.ajax("../../../../../controller/ovh/dashboard.ajax.php?action=count_license", {
            dataType: 'json',
            type: 'GET',
            success: function(data){
                $("#license").text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }

    count_cloud();
    count_dedie();
    count_domaine();
    count_email();
    count_fax();
    count_hebergement();
    count_license();
})(jQuery);