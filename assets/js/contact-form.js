$(document).ready(function () {
    $("#submit").click(function () {
        var name = $("#name").val();
        var email = $("#email").val();
        var message = $("#message").val();


        // Returns successful data submission message when the entered information is stored in database.
        var dataString = 'name1=' + name + '&email1=' + email + '&message1=' + message;

        if (name == '' || email == '' || message == '') {
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
                    $.notify({
	                    title: '<strong>Mail Sent!</strong>',
	                    message: 'Thank you ' + name + ', we will contact you shortly.'
                    },{
	                    type: 'success'
                    });
                }
            });
        }
        return false;
    });
});

