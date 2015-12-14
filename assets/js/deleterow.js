$(".deleteitem").click(function () {
    var parent = $(this).closest('TR');
    var id = parent.attr('id');

    if (confirm("Are you sure you want to delete this?")) {
        $.ajax({
            type: "POST",
            data: { delete_id: id },
            URL: "totm.php",

            success: function (msg) {
                parent.fadeOut('slow', function () { $('#' + id).remove() });
            }
        });
    }
    return false;
});
