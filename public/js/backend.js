$(document).ready(function () {
    $('.delete').on('click', function () {
        return confirm('Вы уверены, что хотите удалить запись?');
    });
});
