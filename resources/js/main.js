$(".ripple").on("click",function(event){
    $(this).append("<span class='ripple-effect'>");
    $(this).find(".ripple-effect").css({
        left:event.pageX-$(this).position().left,
        top:event.pageY-$(this).position().top
    }).animate({
        opacity: 0,
    }, 1500, function() {
        $(this).remove();
    });
});


$("#sidebar-click").on("click",function(event){
    $('body').toggleClass("sidebar-show");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: "/showSidebar",
        success: function (data) {
            console.log(data.success);
        },
    });
});
