<?php
if($_POST)
{
    //Fetching Values from URL
    $name2=$_POST['name1'];
    $email2=$_POST['email1'];
    $message2=$_POST['message1'];
    

    //echo "Form Submitted Succesfully"
    echo "Name: ' + $name2 + 'email: ' + $email2 + 'message: ' + $message2";
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Submit Form Using AJAX and jQuery</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link href="css/refreshform.css" rel="stylesheet">
<script src="script.js"></script>
</head>
<body>
    <div id="mainform">
    <h2>Submit Form Using AJAX and jQuery</h2> <!-- Required div Starts Here -->
    
    <div id="form">
    <h3>Fill Your Information !</h3>
    <div>
    <label>Name :</label>
    <input id="name" type="text">
    <label>Email :</label>
    <input id="email" type="text">
    <label>Message :</label>
    <textarea id="message" rows="6"></textarea>
    <input id="submit" type="button" value="Submit">
    </div>
    </div>
    </div>





</body>
</html>
