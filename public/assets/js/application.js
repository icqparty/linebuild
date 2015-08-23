/**
 * Created by icqparty on 21.10.14.
 */
function go(url){
    window.location.href=url;
    return false;
}
function del(url){
    window.location.href=url;
}


$(document).ready(function(){

// mobile side-menu slide toggler
    var $menu = $("#sidebar-nav");
    $("body").click(function () {
        if ($(this).hasClass("menu")) {
            $(this).removeClass("menu");
        }
    });
    $menu.click(function (e) {
        e.stopPropagation();
    });
    $("#menu-toggler").click(function (e) {
        e.stopPropagation();
        $("body").toggleClass("menu");
    });
    $(window).resize(function () {
        $(this).width() > 769 && $("body.menu").removeClass("menu")
    })

    $('.btn-edit-sc').click(function(e){
        $('div.body-form').each(function(){
            if(!$(this).hasClass("hidden")){
                $(this).toggleClass("hidden");
            }

        });
        var id=$(this).attr('id');
        var item=$('div[item='+id+']');
        item.removeClass("hidden");
        return false;
    });

});
