$(function() {
   
    $('.listSelect input').click(function(event) {
        event.stopPropagation();
        var caja=$(this).parent().find('.newList');
        if(caja.hasClass('hidden')) {
            caja.removeClass('hidden');
        }
        else {
            caja.addClass('hidden');
        }
    });
});