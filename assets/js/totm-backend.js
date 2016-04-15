$(".deleteitem").click(function () {
    var parent = $(this).closest('TR');
    var id = parent.attr('id');
    var file = parent.attr('file');

    if (confirm("Are you sure you want to delete this?")) {
        $.ajax({
            type: "POST",
            data: { delete_id: id, delete_file : file },
            URL: "totm.php",

            success: function (msg) {
                parent.fadeOut('slow', function () { $('#' + id).remove() });
            }
        });
    }
    return false;
});

$(".chooseitem").click(function () {
    var parent = $(this).closest('tr');
    var id = parent.attr('id');
    var file = parent.attr('file');
    var name = parent.attr('name');
    var email = parent.attr('email');
    var desc = parent.attr('desc');
    

    if (confirm("Are you sure you want to promote this to Tank of the Month?")) {
        $.ajax({
            type: "POST",
            data: { promote_id: id, promote_file: file, promote_name: name, promote_email: email, promote_desc: desc },
            URL: "totm.php",

            success: function (msg) {
                parent.fadeOut('slow', function () { $('#' + id).remove() });
                $.notify({
                    title: '<strong>Tank of The Month has been updated!</strong>',
                    message: 'Refresh the page in order to confirm that your update has posted.'
                }, {
                    type: 'success'
                });
            }
        });
    }
    return false;
});
