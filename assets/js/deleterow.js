$(".deleteitem").click(function () {
    var parent = $(this).closest('TR');
    var id = parent.attr('id');

    $.ajax({
        type: "POST",
        data: "id=" + id,
        URL: "totm.php",

        success: function (msg) {
            parent.fadeOut('slow', function() {$('#' + id).remove()});
        }
    });
});
