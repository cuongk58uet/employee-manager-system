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
    });

    $(document).on('click', '#resetButton', function(event) {
        // event.preventDefault();
        var arr = [];
        $('input[name="userId"]:checked').each(function(){
            arr.push(this.value);
        });

        // arr = JSON.stringify(arr);
        $('#listId').val(arr);

        console.log(arr);
    });

    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });

    $('#search_box').on('keyup', function(){
        $search = $(this).val();
        console.log($search);
        if ($search.length > 0) {
            $.ajax({
                type: 'GET',
                url: '/admin/search',
                data: {'search': $search},
                success: function(data){
                    $('.search_response').html(data);
                }
            })
        } else {
            $('.search_response').html('');
        }


    })
});
