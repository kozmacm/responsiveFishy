$(document).ready(function () {
    $("#submit").click(function () {
        var fileSelect = $("#file").val();
        var files = fileSelect.files;
        var name = $("#fullName").val();
        var email = $("#email").val();
        var message = $("#message").val();

        var formData = new FormData();

        // Loop through each of the selected files.
        for (var i = 0; i < files.length; i++) {
          var file = files[i];

          // Check the file type.
          if (!file.type.match('image.*')) {
            continue;
          }

          // Add the file to the request.
          formData.append('file[]', file, file.name);
        }

        // Returns successful data submission message when the entered information is stored in database.
        var dataString = 'file1=' + file + '&name1=' + name + '&email1=' + email + '&message1=' + message;

        if (file == '' || name == '' || email == '' || message == '') {
            alert("Please Fill All Fields");
        }
        else {
            // AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "totm.php",
                data: dataString,
                cache: false,
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
