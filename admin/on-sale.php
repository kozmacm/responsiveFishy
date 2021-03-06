<?php
    include_once '../includes/db_connect.php';
    include_once '../includes/register.inc.php';
    include_once '../includes/functions.php';
 
    sec_session_start();

    if(isset($_GET['success'])) 
    {
        echo"<div id='successAlert' class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert'>&times;</a>
                <strong>Success!</strong>&nbsp;You have registered a new user.&nbsp;&nbsp;<br>
             </div>";
    }
    
    if ($_POST){
        if(isset($_POST['checkbox1']))
        {
            $text = $_POST['textbox'];
            $author = $_SESSION['username'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $active = 1;

            for($i=0; $i<count($_FILES['file']['name']); $i++)
            {
                //Uploads one or more images or videos to the ../assets/img/sales/ folder
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
                        $file = $_FILES["file"]["name"][$i] . "";

                        echo '<script>alert("Success! Your monthly update and file '.$_FILES["file"]["name"][$i].' have been sent successfully");</script>';
                
                        if (file_exists("../assets/img/sales/" . $_FILES["file"]["name"]))
                        {
                            echo '<script>alert("Error: Your monthly update and file '.$_FILES["file"]["name"][$i].' already exists.");</script>';
                        }
                        else
                        {
                            //Make sure we have a filepath
                            if($tmpFilePath != "")
                            {
                                //Setup our new file path
                                $newFilePath = "../assets/img/sales/" . $_FILES['file']['name'][$i];

                                //Upload file to temp dir
                                if(move_uploaded_file($tmpFilePath, $newFilePath))
                                {
                                    //Handle other code here
                                    //echo "Stored in: " . "uploads/" . $_FILES["file"]["name"][$i];
                                }
                            }    
                        } 
                        
                        // Check connection
                        if ($mysqli->connect_error) {
                            die("Connection failed: " . $mysqli->connect_error);
                        } 
                        else
                        {
                            if (!$stmt = $mysqli->query("SELECT * FROM sales")) {
                                echo "Query Failed!: (" . $mysqli->errno . ") ". $mysqli->error;
                            }
                              
                            while ($row = mysqli_fetch_array($stmt)) {
                                $i = $row["id"];
                                $flag = $row["active_flag"];

                                if ($flag == "Y")
                                {
                                    //change flag to 'N'
                                    $sql1 = "UPDATE sales SET active_flag='N' WHERE id='$i'";

                                    if ($mysqli->query($sql1) === TRUE) {
                                        echo "Record updated successfully";
                                    } else {
                                        echo "Error updating record: " . $mysqli->error;
                                    }
                                }
                            }
                
                            if (mysqli_num_rows($stmt) == 0) {
                                echo "No records found.";
                            }
                                                        
                            //Add entry to table 'sales'
                            $sql = "INSERT INTO sales (post, author, file, ip, active_flag) 
                                VALUES ('$text','$author','$file','$ip', $active)";

                            if ($mysqli->query($sql) === TRUE) {} 
                            else 
                            {
                                echo "Error updating record: " . $mysqli->error;
                            }
                        }
                        //$mysqli->close();            
                    }
                }
            }
        }
        else
        {
            echo '<script>alert("Success! Your monthly update has been sent successfully");</script>';
            
            $file = '';
            $text = $_POST['textbox'];
            $author = $_SESSION['username'];//'admin';
            $ip = $_SERVER['REMOTE_ADDR'];
            $active = 1;

            //remove active flag from previous sales edit
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } 
            else
            {
                if (!$stmt = $mysqli->query("SELECT * FROM sales")) {
                    echo "Query Failed!: (" . $mysqli->errno . ") ". $mysqli->error;
                }
                              
                while ($row = mysqli_fetch_array($stmt)) {
                    $i = $row["id"];
                    $flag = $row["active_flag"];

                    if ($flag == "Y")
                    {
                        //change flag to 'N'
                        $sql1 = "UPDATE sales SET active_flag='N' WHERE id='$i'";

                        if ($mysqli->query($sql1) === TRUE) {
                            echo "Record updated successfully";
                        } else {
                            echo "Error updating record: " . $mysqli->error;
                        }
                    }
                }
                
                if (mysqli_num_rows($stmt) == 0) {
                    echo "No records found.";
                }

                //Add entry to table 'sales'
                $sql = "INSERT INTO sales (post, author, file, ip, active_flag) 
                    VALUES ('$text','$author','$file','$ip', $active)";

                if ($mysqli->query($sql) === TRUE) {} 
                else 
                {
                    echo "Error updating record: " . $mysqli->error;
                }
            }
            //$mysqli->close();
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Dashboard - Fishy Business</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    
    <!-- Bootstrap core CSS     -->
    <link href="../bootstrap3/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    
    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/backend.css" rel="stylesheet" />
    <link href="../assets/css/login-register.css" rel="stylesheet" />
    <link href="../assets/css/fileinput.min.css" media="all" rel ="stylesheet" type="text/css"/>
            
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    
</head>
<body class="sales"> 
<?php if (login_check($mysqli) == true) : ?>
<?php
    if (!empty($error_msg)) {
        echo $error_msg;
    }
?>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="../assets/img/sidebarBeach.jpg">    
    
    <!--   
        
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" 
        Tip 2: you can also add an image using data-image tag
        
    -->
    
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="../index.php" class="simple-text">
                    Fishy Business
                </a>
            </div>
            <ul class="nav">
                <li class="active">
                    <a>
                        <i class="pe-7s-graph"></i> 
                        <p>Dashboard</p>
                    </a>            
                </li>
                <li class="active">
                    <a href="news.php">
                        <i class="pe-7s-news-paper"></i> 
                        <p>Monthly News Updates</p>
                    </a>            
                </li>
                <li class="active">
                    <a href="on-sale.php">
                        <i class="pe-7s-cash"></i> 
                        <p>On Sale</p>
                    </a>            
                </li>
                <li class="active">
                    <a href="totm.php">
                        <i class="pe-7s-photo"></i> 
                        <p>Tank of the Month</p>
                    </a>            
                </li>
                <li class="active">
                    <a href="users.php">
                        <i class="pe-7s-users"></i> 
                        <p>Users</p>
                    </a>            
                </li>
            </ul> 
    	</div>
    </div>
    
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">    
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">Current Sale Updates</a>
                </div>
                <div class="collapse navbar-collapse">       
                    <ul class="nav navbar-nav navbar-left">
                        
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                   <?php echo "Welcome, " . $_SESSION['username'] . "!"; ?>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register a new user</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="../includes/logout.php">
                                Log out
                            </a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>
                            
        <!--put body stuff here-->
        <div class="content">
            <div class="container-fluid">
                <div class="row">                   
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title">Current Sales</h4>
                                <p class="category">Here you will find the current sales! </p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <?php
                                    // Check connection
                                    if ($mysqli->connect_error) {
                                        die("Connection failed: " . $mysqli->connect_error);
                                    } 
                                    else
                                    {
                                        if (!$stmt = $mysqli->query("SELECT * FROM sales")) {
                                            echo "Query Failed!: (" . $mysqli->errno . ") ". $mysqli->error;
                                        }
                                                                                
                                        echo "<table class='table table-hover'>";
                                        echo "<thead>
                                                <th>Image</th>
                                    	        <th>News</th>
                                    	        <th>Author</th>
                                    	        <th>IP</th>
                                    	        <th>Date</th>
                                                </thead>
                                                <tbody>";
                                        while ($row = mysqli_fetch_array($stmt)) {
                                            $i = $row["id"];
                                            $f = $row["file"];
                                            $p = $row["post"];
                                            $a = $row["author"];
                                            $z = $row["ip"];
                                            $d = $row["date_posted"];
                                            $active = $row["active_flag"];

                                            if ($active == "Y")
                                            {
                                                echo "<tr id='$i'>";
                                                if ($f == "")
                                                {
                                                    echo "<td>No Sales Flyer Included</td>";
                                                }
                                                else
                                                {
                                                    echo "<td> <a href='../assets/img/sales/$f'><img class='thumbnail' src='../assets/img/sales/$f' alt='$f' /> </td>";
                                                }
                                                
                                                echo "<td>$p</td>";
                                                echo "<td>$a</td>";
                                                echo "<td>$z</td>";
                                                echo "<td>$d</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        echo "</tbody>";
                                        echo "</table>";

                                        if (mysqli_num_rows($stmt) == 0) {
                                            echo "No records found.";
                                        }
                                    } 
                                $stmt->free();
                                $mysqli->close();    
                                ?>       
                            </div>
                        </div>
                    </div>                
                </div>                    
            </div>
            <div class="container-fluid">    
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title">Update Current Sales</h4>
                                <p class="category">Here is where you can update the monthly sales. Do not insert a sales flyer using this frame, do it using the checkbox below. </p>
                            </div>
                            <form method="post" id="form" name="form" action="" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <textarea id="textbox" name="textbox" class="form-control" rows="10" placeholder="Enter your monthly update here" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox checkbox-blue" for="checkbox1">
                                        <input type="checkbox" value="" id="checkbox1" name="checkbox1" data-toggle="checkbox">
                                            I want to include a sales flyer.
                                    </label>
                                </div>
                                <div class="form-group" id="file_container">
                                    <input id="fileInput" type="file" name="file[]" class="file" data-show-upload="false" data-show-caption="true" >
                                </div> 
                                <div class="form-group">    
                                    <input type="submit" name="preview" class="btn btn-info btn-fill" value="Preview" id="preview" />
                                    <input type="submit" name="submit" class="btn btn-info btn-fill" value="Submit" id="submit" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="changetext">

                    </div>
                </div>
            </div>
        </div>
        
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="../index.php">
                                Home
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; 2015 <a href="http://www.fishybusinesssc.com">Fishy Business</a>, LLC
                </p>
            </div>
        </footer>
        
    </div>   
</div>
    
<?php else : ?>
    <p>
        <span class="error">You are not authorized to access this page.</span> Please <a href="../index.php">login</a>.
    </p>
<?php endif; ?>

</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
	
	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>
	
	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>
    
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../assets/js/light-bootstrap-dashboard.js"></script>

    <script type="text/JavaScript" src="../assets/js/sha512.js"></script> 
    <script type="text/JavaScript" src="../assets/js/forms.js"></script>
	
	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>

    <script src="../assets/js/fileinput.min.js" type="text/javascript"></script>
    <script src="../assets/js/login-register.js" type="text/javascript"></script>
	<script src="../plugins/ckeditor/ckeditor.js"></script>
    <script src="../assets/js/sales-backend.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#file_container').hide();

            $("#checkbox1").change(function(event) {

                if ($(this).is(":checked"))
                {
                    $('#file_container').show();
                } else {
                    $('#file_container').hide();
                }
            });
        }); 
    </script>

    <script>
        //replace text area with CKEditor instance, using default config
        CKEDITOR.replace('textbox');
    </script>

    <script>
        $("#fileInput").fileinput({
            'allowedFileExtensions' : ['jpg', 'png','gif'],
        });
    </script>

    <script type="text/javascript">
    	$(document).ready(function(){
        	
        	demo.initChartist();
        	
        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome Fishy Business Dashboard."
            	
            },{
                type: 'info',
                timer: 4000
            });
            
    	});
	</script>
    
</html>
