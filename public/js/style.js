$(document).ready(function() {
    $(document).on('click', '.action', function() {
        var userId = $(this).find('#userId').val();
        $('#id').val(userId);
        console.log(userId);
    })
    $(document).on('click', '.departmentAction', function() {
        var departmentId = $(this).find('#departmentId').val();
        $('#id').val(departmentId);
        console.log(departmentId);
    })
});
