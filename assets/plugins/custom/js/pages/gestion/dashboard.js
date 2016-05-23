/**
 * Created by SWD on 08/03/2016.
 */
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

    function count_client()
    {
        $.ajax('../../../../../controller/gestion/dashboard.ajax.php?action=count_client', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#info_client').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_article()
    {
        $.ajax('../../../../../controller/gestion/dashboard.ajax.php?action=count_article', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#info_article').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_devis()
    {
        $.ajax('../../../../../controller/gestion/dashboard.ajax.php?action=count_devis', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#info_devis').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_commande()
    {
        $.ajax('../../../../../controller/gestion/dashboard.ajax.php?action=count_commande', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#info_commande').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }
    function count_facture()
    {
        $.ajax('../../../../../controller/gestion/dashboard.ajax.php?action=count_facture', {
            dataType: "json",
            type: "GET",
            success: function(data){
                $('#info_facture').text(data);
            },
            error: function(jqxhr){
                console.log(jqxhr.responseText);
            }
        })
    }

    count_client();
    count_article();
    count_devis();
    count_commande();
})(jQuery);