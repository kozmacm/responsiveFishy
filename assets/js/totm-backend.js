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
    var parent = $(this).closest('TR');
    var id = parent.attr('id');
    var file = parent.attr('file');

    if (confirm("Are you sure you want to promote this to Tank of the Month?")) {
        $.ajax({
            type: "POST",
            data: { promote_id: id, promote_file : file },
            URL: "totm.php",

            success: function (msg) {
                
            }
        });
    }
    return false;
});
