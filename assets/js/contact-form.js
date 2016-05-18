$(document).ready(function () {
    $("#submit").click(function () {
        var name = $("#name").val();
        var email = $("#email").val();
        var message = $("#message").val();
        var response = grecaptcha.getResponse();
        
        // Returns successful data submission message when the entered information is stored in database.
        var dataString = 'name1=' + name + '&email1=' + email + '&message1=' + message + '&g-recaptcha-response=' + response;

        if (name == '' || email == '' || message == '' || response == '') {
            $.notify({
                title: '<strong>Error!</strong>',
                message: 'Please fill out all fields.'
            }, {
                type: 'danger'
            });
        }
        else {
            // AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "contact-us.php",
                data: dataString,
                cache: false,
                success: function (result) {
                    //disable button to prevent double submit
                    $("#submit").attr('disabled',true);

                    $.notify({
                        title: '<strong>Mail Sent!</strong>',
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

