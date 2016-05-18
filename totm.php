<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
 
    sec_session_start();
 
    if (login_check($mysqli) == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }

    
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
                echo '<script>alert("Success! Your file '.$_FILES["file"]["name"][$i].' has been sent successfully");</script>';
                
                if (file_exists("uploads/" . $_FILES["file"]["name"]))
                {
                    echo '<script>alert("Error: Your file '.$_FILES["file"]["name"][$i].' already exists.");</script>';
                }
                else
                {
                    //Make sure we have a filepath
                    if($tmpFilePath != "")
                    {
                        //Setup our new file path
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
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $message = $_POST['message'];
                    $ip = $_SERVER['REMOTE_ADDR'];

                    $sql = "INSERT INTO uploads (file, size, type, name, email, description, ip) 
                        VALUES ('$file','$size','$type','$name','$email','$message','$ip')";

                    if ($mysqli->query($sql) === TRUE) {} 
                    else 
                    {
                        echo "<script>alert('Error: '.$sql.' <br> '.$mysqli.'->error.');</script>";
                    }
                }
                //$mysqli->close();            
            }
        }
        else
        {
            echo "<script>alert('Error: - Invalid File.');</script>";
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Tank of the Month Signup - Fishy Business</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/gsdk.css" rel="stylesheet"/>
    <link href="assets/css/fishy.css" rel="stylesheet"/>
    <link href="assets/css/fileinput.min.css" media="all" rel ="stylesheet" type="text/css"/>
    <link href="assets/css/login-register.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> 
    <link href='https://fonts.googleapis.com/css?family=Grand+Hotel|Open+Sans:400,300' rel='stylesheet' type='text/css'>  
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />  
</head>

<body class="totm">
<!--<div id="form_success" class="alert alert-success fade in" style="display:none"></div>-->

<nav class="navbar navbar-inverse navbar-transparent navbar-fixed-top" role="navigation">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button id="menu-toggle" type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar bar1"></span>
        <span class="icon-bar bar2"></span>
        <span class="icon-bar bar3"></span>
      </button>
    <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt="..." /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul  class="nav navbar-nav navbar-right">
            <li>
                <a href="index.php">
                     Home
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    More 
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-with-icons">
                    <li>
                        <a href="on-sale.php">
                             <i class="pe-7s-cash"></i> On Sale
                        </a>
                    </li>
                    <li>
                        <a href="gallery.php">
                            <i class="pe-7s-photo"></i> Gallery
                        </a>
                    </li>
                    <li>
                        <a href="totm.php">
                            <i class="pe-7s-photo"></i> TOTM
                        </a>
                    </li>
                    <li>
                        <a href="service.php">
                            <i class="pe-7s-car"></i> Service
                        </a>
                    </li>  
                    <li>
                        <a href="contact-us.php">
                           <i class="pe-7s-mail-open-file"></i> Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="about-us.php">
                           <i class="pe-7s-info"></i> About Us
                        </a>
                    </li>
                    <li class="divider"></li>
                    <!--
                    <li>
                        <a data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">
                            <i class="pe-7s-info"></i> Register
                        </a>
                    </li>
                    <li>
                        <a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">
                            <i class="pe-7s-info"></i> Login
                        </a>
                    </li>
                    -->
                  </ul>
            </li>
            <li><a href="mailing-list.php" class="btn btn-round btn-default">Join our mailing list!</a></li>
       </ul>
      
    </div><!-- /.navbar-collapse -->
  </div>
</nav>

<!-- begin login/register modal -->
<!--
<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
    	    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">User Login</h4>
            </div>
            <div class="modal-body">  
                <div class="box">
                    <div class="content">
                         <div class="error"></div>
                         <div class="form loginBox">
                            <form action="includes/login.php" method="post" name="login_form"> 
                                Email:<br /> 
                                <input type="text" id="email" class="form-control" name="email" value="<?php echo $submitted_username; ?>" /> 
                                <br /><br /> 
                                Password:<br /> 
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password" /> 
                                <br /><br /> 
                                <input type="submit" class="btn btn-default btn-login" value="Login" onclick="formhash(this.form, this.form.password);" /> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                    <!--
                    <span>Looking to 
                    <a href="javascript: showRegisterForm();">create an account</a>
                    ?</span>
                    -->
<!--                </div>
                <div class="forgot register-footer" style="display:none">
                    <span>Already have an account?</span>
                    <a href="javascript: showLoginForm();">Login</a>
                </div>
            </div>        
        </div>
    </div>
</div>
<!-- /.login/register modal -->

<div class="wrapper">
    <div class="parallax filter-black">
        <div class="parallax-image">
            <img src="assets/img/JacksElectricCornfield.jpg">
            <!--<img src="assets/img/backgroundthumb.jpg">-->
        </div>    
        <div class="small-info">
            <h1>Tank of the Month</h1>
            <h3>Send in your photos and you might be featured here!</h3>    
        </div>
    </div>

    <div class="section">
           <div class="container">
               <h2 class="section-title">Current Tank of the Month</h2>
               <div class="row">
                   <?php
                       // Check connection
                       if ($mysqli->connect_error) {
                           die("Connection failed: " . $mysqli->connect_error);
                       } 
                       else
                       {
                           if (!$stmt = $mysqli->query("SELECT * FROM totm")) {
                               echo "Query Failed!: (" . $mysqli->errno . ") ". $mysqli->error;
                           }
                                                                              
                           while ($row = mysqli_fetch_array($stmt)) {
                               $file = "assets/img/totm/" . $row['file'];
                               $na = $row['name'];
                               $desc = $row['description'];
                                                                     
                               echo "<div class='col-md-12'>    
                                         <div class='img-container'>
                                             <a href='$file' >
                                             <img src='$file' alt='Image failed to load from DB' />
                                             </a>
                                         </div>
                                     </div>
                                     <div class='space-50'></div>
                                     <div class='col-md-12'>
                                         <div>
                                             <p>Congratulations to " . $na . ", the current winner of our Tank of the Month Contest!</p></br>
                                             <p>" . $desc . "</p>
                                         </div>
                                     </div>
                                     ";
                           }
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
    
    <div class="section">
           <div class="container">
               <h2 class="section-title">Send us your entry and win!</h2>
               <div class="row">
                   <div class="col-md-12">
                       <p>
                           All fields are required<br><br>
                       </p>
                       <form method="post" id="form" name="form" action="" enctype="multipart/form-data" >
    				       <div class="form-group">
                               <label class="control-label">Select up to 3 files (Each file must be < 2Mb)</label>
                               <input id="input-2" type="file" name="file[]" class="file" multiple="true" data-show-upload="false" data-show-caption="true">
    				  	   </div>
                           <div class="form-group">
    				           <label for="name">Full Name</label>
    				    	       <input type="text" name="name" class="form-control" id="name" placeholder="Full Name"/>
    				  	   </div>
    				  	   <div class="form-group">
    				           <label for="email">Email address</label>
    				    	       <input type="email" name="email" class="form-control" id="email" placeholder="Your personal email address"/>
    				  	   </div>
                           <div class="form-group">
    				           <label for="message">Tank Description</label>
    				    	       <textarea name="message" class="form-control" id="message" rows="6" placeholder="Enter details about your tank setup here"></textarea>
    				  	   </div>
    				  	   <div class="submit">
    				  	       <input type="submit" name="submit" class="btn btn-info btn-fill" value="Submit" id="submit" />
    				  	   </div>

                           <div class="space-50"></div>

                           <div id="mce-responses" class="clear">
		                       <div class="response" id="mce-error-response" style="display:none"></div>
		                       <div class="response" id="mce-success-response" style="display:none"></div>
	                       </div>
    			       </form>
                   </div>
                   
                   <!--End mc_embed_signup-->
               </div>
           </div>
    </div><!-- section -->
    <div class="space-50"></div>
    
    <footer class="footer footer-transparent" style="background-image: url('assets/img/thumb.jpg')">
            <div class="container">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="contact-us.php">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="social-area pull-right">                
                    <a href="http://www.facebook.com/FishyBusinessSC/" class="btn btn-social btn-facebook btn-simple">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                    <a href="https://twitter.com/fishyguys" class="btn btn-social btn-twitter btn-simple">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="http://www.youtube.com/channel/UCKAoquCimTvJs8_J9iLX1Ag?feature=CAQQwRs%3D" class="btn btn-social btn-pinterest btn-simple">
                        <i class="fa fa-youtube"></i>
                    </a>
                </div>
                <div class="copyright">
                    &copy; 2015 <a href="http://www.fishybusinesssc.com">Fishy Business</a>
                </div>
            </div>
        </footer>
</div> <!-- wrapper -->
     
</body>
    <!--  jQuery and Bootstrap core files    -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
		
	<!--  Plugins -->
	<script src="assets/js/gsdk-checkbox.js"></script>
	<script src="assets/js/gsdk-morphing.js"></script>
	<script src="assets/js/gsdk-radio.js"></script>
	<script src="assets/js/gsdk-bootstrapswitch.js"></script>
	<script src="assets/js/bootstrap-select.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/bootstrap-notify.js"></script>
	<script src="assets/js/chartist.min.js"></script>
    <script src="assets/js/jquery.tagsinput.js"></script>
    <script src="assets/js/retina.min.js"></script>
    <script src="assets/js/fileinput.min.js" type="text/javascript"></script>
    <script src="assets/js/login-register.js" type="text/javascript"></script>
    <script type="text/JavaScript" src="assets/js/sha512.js"></script> 
    <script type="text/JavaScript" src="assets/js/forms.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    
	<!--  Get Shit Done Kit PRO Core javascript 	 -->
	<script src="assets/js/get-shit-done.js"></script>
    
    <script type="text/javascript">
        var big_image;
        $().ready(function(){
            responsive = $(window).width();
            
            $(window).on('scroll', gsdk.checkScrollForTransparentNavbar);
            
            if (responsive >= 768){
                big_image = $('.parallax-image').find('img');
                
                $(window).on('scroll',function(){           
                    parallax();
                });
            }
            
        });
        
       var parallax = function() {
            var current_scroll = $(this).scrollTop();
            
            oVal = ($(window).scrollTop() / 3); 
            big_image.css('top',oVal);
        };

    </script>

    <script>
        $("#input-2").fileinput({
            'allowedFileExtensions' : ['jpg', 'png','gif'],
        });
    </script>
    
    <!-- If you are using TypeKit.com uncomment this code otherwise you can delete it -->
    <!--
    <script src="https://use.typekit.net/[your kit code here].js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    -->
       <!-- Google Analytics Start -->
   
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54741406-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Google Analytics End -->
</html>
