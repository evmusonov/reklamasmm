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
                console.log(data);
            });
    }
}
