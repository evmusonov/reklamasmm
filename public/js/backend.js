$(document).ready(function () {
    $('.delete').on('click', function () {
        return confirm('Вы уверены, что хотите удалить запись?');
    });
});

function deleteFile(module, content_id, filename) {
    if (confirm('Вы уверены, что хотите удалить файл?')) {
        $.post('/admin/delete-file',
            {
                '_token': $('meta[name=csrf-token]').attr('content'),
                module: module,
                content_id: content_id,
                filename: filename
            })
            .done(function (data) {
                $('#' + module + content_id).remove();
                $('.image').append('<input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">');
            });
    }
}
