/**
 * Created by Maxime on 09/05/2016.
 */
(function($){
    $('li').on('click', '#ajax_cross',function (e) {
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        $('#ajax_content_task').html('<div class="loader text-center"></div>');
        $.getJSON(url)
            .done(function(data){
                $('#ajax_content_task').html(data);
            })
            .fail(function(data){
                console.log(data);
            })
    });
    $('li').on('click', '#supp-task',function(e){
        e.preventDefault();
        var button = $(this);
        var url = button.attr('data-href');
        button.html("<img src='../../../../images/preloader/loader_ajax.gif' />");
        $.ajax(url)
            .done(function(data){
                if(data == 200){
                    button.parents('li').fadeOut();
                    toastr.success("La Tache à été supprimer.");
                }
                if(data == 300){
                    toastr.error("Une erreur à eu lieu lors de la suppression de la tache.");
                    console.log(data);
                }
            })
            .fail(function(jqxhr){
                console.log(jqxhr.responseText);
            })
    });
})(jQuery);

setInterval(function(){
    var url = "../../../../../controller/tasks.ajax.php?action=count_task";
    $.ajax(url)
        .done(function(data){
            $("#count_task").html(data);
        })
        .fail(function(jqxhr){
            console.log(jqxhr.responseText);
        })
}, 1000);