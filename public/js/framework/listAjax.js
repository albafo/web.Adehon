/**
 * Created by alvarobanofos on 18/09/15.
 */

$('body').on('change', '.ajaxList input, .ajaxList textarea', function() {
    var dataId = $(this).parents('tr').attr('data-id');
    var urlController = $(this).parents('table[data-parent-id]').attr('data-controller');
    var urlParams = $(this).parents('table[data-parent-id]').attr('data-params');

    if($(this).attr('type')=="checkbox"){
        if($(this).prop('checked')) {
            $(this).val(1);
        }
        else($(this).val(0));
    }

    var valuesToChange = {};
    if($(this).hasClass('datepicker')) {
        valuesToChange = 'date';
    }


    $.getJSON(urlController+'/edit/'+urlParams+'/'+dataId, {'field':$(this).attr('name'), 'value':$(this).val(), 'valuesToChange':valuesToChange}, function(){

    }).error(function(e) {
        if(e.status != 200)
            alert("Error al guardar datos");
    });
});

$('body').on('click', '.removeListRow', function() {
    var row = $(this).parents('tr[data-id]');
    var dataId = row.attr('data-id');
    var urlController = $(this).parents('table[data-parent-id]').attr('data-controller');
    var urlParams = $(this).parents('table[data-parent-id]').attr('data-params');
    $.getJSON(urlController+'/remove/'+urlParams+'/'+dataId, {}, function(result) {
        row.remove();
    });

});

$('body').on('click','.ajaxList .addItem', function(e){
    e.preventDefault();

    var ajaxListTable = $(this).parent().find('table[data-parent-id]');
    var idList = ajaxListTable.attr('data-parent-id');
    var listToken = ajaxListTable.attr('data-token');
    var urlController = ajaxListTable.attr('data-controller');
    var urlParams = ajaxListTable.attr('data-params');
    var ajaxListTableContainer = ajaxListTable.parents('.ajaxListContainer');

    $.getJSON(urlController+'/add/'+urlParams+'/'+idList, {'listToken':listToken}, function(result){
        ajaxListTableContainer.replaceWith(result);
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'es',
            startView: 2,
            weekStart: 1
        })
    });


});