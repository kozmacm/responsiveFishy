$(document).ready(function () {
    $("#preview").click(function () {
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        
        var textbox = $("#textbox").val();
        var checkbox = $("#checkbox1").val();
        var file = $("#file").val();

        // Returns successful data submission message when the entered information is stored in database.
        var dataString = 'textbox1=' + textbox + '&checkbox1=' + checkbox + '&file1=' + file;

        // AJAX Code To Submit Form.
        $.ajax({
            type: "POST",
            url: "on-sale.php",
            data: dataString,
            cache: false,
            success: function (result) {
                var div = document.getElementById('changetext');
                div.innerHTML = textbox;
            }
        });

        return false;
    });
});
