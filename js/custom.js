$(document).ready(function () {
    $('#select1').change(function () {
        var menuCategory = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'fetch_menu_items.php', // PHP script to handle AJAX request
            data: {menu_category: menuCategory},
            dataType: 'json',
            success: function (data) {
                $('#select2').empty();
                $.each(data, function (index, item) {
                    $('#select2').append($('<option>', {
                        value: item.id,
                        text: item.name
                    }));
                });
            }
        });
    });
});