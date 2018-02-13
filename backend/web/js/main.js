$(function () {
    $('#modalActividad').click(function () {
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
    $('.modActividad').click(function () {
        enlace = $(this).attr('value') + '&id=' + $(this).closest('tr').data('key');
        $('#modal').modal('show')
                .find('#modalContent')
                .load(enlace);
    });
});

