/**
 * Created by alvarobanofos on 08/09/15.
 */

$(function() {
    $('#CursoEvaluacionForm').on('submit', function(e){
        var form = $(this);
        $('#CursoEvaluacionForm input[type=checkbox]').each(function()
        {
            if($(this).prop('checked')) {
                form.append('<input type="hidden" name="'+$(this).attr('name')+'" value="1">');
            }
            else form.append('<input type="hidden" name="'+$(this).attr('name')+'" value="0">');
            $(this).remove();

        });
        return true;
    });

    $('#CursoRevisionForm').on('submit', function(e){
        var form = $(this);
        $('#CursoRevisionForm input[type=checkbox]').each(function()
        {
            if($(this).prop('checked')) {
                form.append('<input type="hidden" name="'+$(this).attr('name')+'" value="1">');
            }
            else form.append('<input type="hidden" name="'+$(this).attr('name')+'" value="0">');
            $(this).remove();
        });
        return true;
    });



    $('body').on('click', '.removeTarea', function() {
        var filaTarea = $(this).parents('tr');
        var idTarea = filaTarea.attr('data-id');
        $.get('../remove-tarea-inicio/'+idTarea, {}, function() {
            filaTarea.remove();
        });
    });



});
