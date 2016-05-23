(function ($) {
    $('li').on('click', '#ajax_cross',function (e) {
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        $('#ajax_fax').html('<div class="loader text-center"></div>');
        $.getJSON(url)
            .done(function(data){
                $('#ajax_fax').html(data);
            })
            .fail(function(data){
                console.log(data);
            })
    })
})(jQuery);
