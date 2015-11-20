$(document).ready(function () {
    $("#submit").click(function () {
        var filedata = document.getElementsByName("file"),
            formdata = false;
        var name = $("#fullName").val();
        var email = $("#email").val();
        var message = $("#message").val();

        if (window.FormData) {
            formdata = new FormData();
        }
        
        var i = 0, len = filedata.files.length, img, reader, file;

        // Loop through each of the selected files.
        for (; i < len; i++) {
          var file = filedata.files[i];

          if (window.FileReader) {
            reader = new FileReader();
            reader.onloadend = function(e) {
                showUploadedItem(e.target.result, file.fileName);
            };
            reader.readAsDataURL(file);
            }
            if (formdata) {
                formdata.append("file", file);
                formdata.append("name", name);
                formdata.append("email", email);
                formdata.append("message", message);
            }
        }

        if (formdata) {
            // AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "../uploads/",
                data: formdata,
                processData: false,
                contentType: false,

                success: function (result) {
                    $.notify({
                        title: '<strong>File Sent!</strong>',
                        message: 'Thank you ' + name + ', we will contact you shortly.'
                    }, {
                        type: 'success'
                    });
                }
            });
        }
        return false;
    });
});
