<?php
for($i=0; $i<count($_FILES['file']['name']); $i++)
{
    $tmpFilePath = $_FILES['file']['tmp_name'][$i];

    //Make sure we have a filepath
    if($tmpFilePath != "")
    {
        //Setup out new file path
        $newFilePath = "../uploads/" . $_FILES['file']['name'][$i];

        //Upload file to temp dir
        if(move_uploaded_file($tmpFilePath, $newFilePath))
        {
            //Handle other code here
        }
    }
}
/*
$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/wma")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg"))

&& ($_FILES["file"]["size"] < 500000)
&& in_array($extension, $allowedExts))

{
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("../uploads/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../uploads/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "../uploads/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
*/
?> 
