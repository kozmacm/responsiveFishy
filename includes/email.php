<?php 
if(isset($_POST['submit'])){
    $to = "support@fishybusinesssc.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $subject = "Web Inquiry";
    $message = $name . " wrote the following:" . "\n\n" . $_POST['message'];
    
    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
    
    echo '<script language="javascript">';
    echo 'alert("message successfully sent")';
    echo '</script>';
    //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }
?>
