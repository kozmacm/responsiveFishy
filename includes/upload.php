<?php
include_once 'db_connect.php';    

for($i=0; $i<count($_FILES['file']['name']); $i++)
{
    //Uploads one or more images or videos to the ../uploads/ folder
    $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
    $extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
    $tmpFilePath = $_FILES['file']['tmp_name'][$i];

    if (($_FILES['file']['type'][$i] == "video/mp4") || 
        ($_FILES['file']['type'][$i] == "audio/mp3") || 
        ($_FILES['file']['type'][$i] == "audio/wma") || 
        ($_FILES['file']['type'][$i] == "image/pjpeg") || 
        ($_FILES['file']['type'][$i] == "image/gif") || 
        ($_FILES['file']['type'][$i] == "image/jpeg")
    //Limit size to 2 Mb
    && ($_FILES['file']['size'][$i] < 2000000)
    && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"][$i] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br />";
        }
        else
        {
            echo '<div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> Your file '.$_FILES["file"]["name"][$i].' has been sent successfully.
                    </div>';
                             
            //echo "Upload: " . $_FILES["file"]["name"][$i] . "<br />";
            //echo "Type: " . $_FILES["file"]["type"][$i] . "<br />";
            //echo "Size: " . ($_FILES["file"]["size"][$i] / 1024) . " Kb<br />";
            //echo "Temp file: " . $_FILES["file"]["tmp_name"][$i] . "<br />";

            if (file_exists("uploads/" . $_FILES["file"]["name"]))
            {
                echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error: </strong> Your file '.$_FILES["file"]["name"][$i].' already exists.
                    </div>';
                //echo $_FILES["file"]["name"] . " already exists. ";
            }
            else
            {
                //Make sure we have a filepath
                if($tmpFilePath != "")
                {
                    //Setup out new file path
                    $newFilePath = "uploads/" . $_FILES['file']['name'][$i];

                    //Upload file to temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath))
                    {
                        //Handle other code here
                        //echo "Stored in: " . "uploads/" . $_FILES["file"]["name"][$i];
                    }
                }    
            } 
            //Adds entry into database in table 'totm'
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } 
            else
            {
                $file = $_FILES["file"]["name"][$i] . "";
                $size = $_FILES["file"]["size"][$i] . "";
                $type = $_FILES["file"]["type"][$i] . "";
                $fullName = $_POST['fullName'];
                $email = $_POST['email'];
                $message = $_POST['message'];
                $ip = $_SERVER['REMOTE_ADDR'];

                $sql = "INSERT INTO uploads (file, size, type, name, email, description, ip) 
                    VALUES ('$file','$size','$type','$fullName','$email','$message','$ip')";

                if ($mysqli->query($sql) === TRUE) {} 
                else 
                {
                    echo '<div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error: </strong> '.$sql.' <br> '.$mysqli.'->error.
                            </div>';

                    //echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
            }            
        }
    }
    else
    {
        //echo "
        //<script>
        //$.notify({
	    //    title: '<strong>Heads up!</strong>',
	    //    message: 'You can use any of bootstraps other alert styles as well by default.'
        //},{
	    //    type: 'success'
        //});
        //</script>";
            
        echo '<div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error: </strong> - Invalid File.
                </div>';
            
        //echo "Error - Invalid file";
    }
}
    
$mysqli->close();
?> 
