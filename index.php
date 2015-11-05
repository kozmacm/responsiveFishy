<?php
    require("config.php"); 
    $submitted_username = ''; 
    if(!empty($_POST)){ 
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email 
            FROM users 
            WHERE 
                username = :username 
        "; 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
          
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $login_ok = false; 
        $row = $stmt->fetch(); 
        if($row){ 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            } 
            if($check_password === $row['password']){
                $login_ok = true;
            } 
        } 
 
        if($login_ok){ 
            unset($row['salt']); 
            unset($row['password']); 
            $_SESSION['user'] = $row;  
            header("Location: dashboard.php"); 
            die("Redirecting to: dashboard.php"); 
        } 
        else{ 
            print("Login Failed."); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Fishy Business</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="../bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/gsdk.css" rel="stylesheet"/>
    <link href="../assets/css/fishy.css" rel="stylesheet"/>
    <link href="../assets/css/login-register.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> 
    <link href='https://fonts.googleapis.com/css?family=Grand+Hotel|Open+Sans:400,300' rel='stylesheet' type='text/css'>  
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />  
</head>

<body class="home">

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
    <a class="navbar-brand" href=""><img src="../assets/img/logo.png" alt="..." /></a>
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
                        <a href="gallery.php">
                             <i class="pe-7s-photo"></i> Gallery
                        </a>
                    </li>
                      <li>
                        <a href="on-sale.php">
                             <i class="pe-7s-cash"></i> On Sale
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
                    -->
                    <li>
                        <a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">
                            <i class="pe-7s-info"></i> Login
                        </a>
                    </li>
                  </ul>
            </li>
            <li><a href="mailing-list.php" class="btn btn-round btn-default">Join our mailing list!</a></li>
       </ul>
      
    </div><!-- /.navbar-collapse -->
  </div>
</nav>

<!-- begin login/register modal -->
<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
    	    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login with</h4>
            </div>
            <div class="modal-body">  
                <div class="box">
                    <div class="content">
                        <div class="social">
                            <a class="circle github" href="/auth/github">
                                <i class="fa fa-github fa-fw"></i>
                            </a>
                            <a id="google_login" class="circle google" href="/auth/google_oauth2">
                                <i class="fa fa-google-plus fa-fw"></i>
                            </a>
                            <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                                <i class="fa fa-facebook fa-fw"></i>
                            </a>
                         </div>
                         <div class="division">
                            <div class="line l"></div>
                            <span>or</span>
                            <div class="line r"></div>
                         </div>
                         <div class="error"></div>
                         <div class="form loginBox">
                            <form action="index.php" method="post"> 
                                Username:<br /> 
                                <input type="text" id="username" class="form-control" name="username" value="<?php echo $submitted_username; ?>" /> 
                                <br /><br /> 
                                Password:<br /> 
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password" /> 
                                <br /><br /> 
                                <input type="submit" class="btn btn-default btn-login" value="Login" /> 
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="content registerBox" style="display:none;">
                        <div class="form">
                            <form action="register.php" method="post"> 
                                <label>Username:</label> 
                                <input id="username" class="form-control" type="text" placeholder="Username" name="username" /> 
                                <label>Email: <strong style="color:darkred;">*</strong></label> 
                                <input id="email" class="form-control" type="text" placeholder="Email" name="email" /> 
                                <label>Password:</label> 
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password" /> <br /><br />
                                <input type="submit" class="btn btn-default btn-register" value="Register" /> 
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
                </div>
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
            <img src="../assets/img/thumb.jpg" alt="..." />
        </div>    
        <div class="small-info">
            <h1>Fishy Business</h1>
            <h3>Oldest full-line aquatic-only store in Columbia.</h3>    
        </div>
    </div>
    
    <div class="space-50"></div>

    <div class="section section-description">
           <div class="container">
               <div class="row">
                    <div class="col-md-6">
                       <h2>Weekly Updates</h2>
                       <p>Checkout our Highlight Videos featuring the New Stock! </p>
                        </p>Click <a href="https://www.facebook.com/media/set/?set=vb.122002154595568&type=2">here </a>or image for New stock and highlight videos. </p>
                    
                   </div>
                   <div class="col-md-6">
                      <div class="img-container">
                          <a href="https://www.facebook.com/media/set/?set=vb.122002154595568&type=2">
                          <img src="../assets/img/nem.jpg" alt="..." /> </a>
                      </div>
                   </div>
                </div>
            
                <!--<div class="space-50"></div>-->
                <hr>
                <div class="space-50"></div>
                
                <div class="row">
                   <div class="col-md-6">
                      <div class="img-container">
                          <img src="../assets/img/entrance.jpg" alt="..." />
                      </div>
                   </div>
                   <div class="col-md-6">
                       <h2>Tank Specials!</h2>
                       <p>55 Gallon Tank 99.00 <br>
                          75 Gallon Tank 129.00 <br>
                          125 Gallon Tank 299.00 <br><br>
                          75 Gallon R.R. 239.00 <br>
                          90 Gallon R.R. 289.00 <br>
                          125 Gallon R.R. 399.00 <br>
                          180 Gallon R.R. 699.00
                       </p>
                       </p></p>                    
                   </div>
               </div>
           </div>
    </div><!-- section -->

    <div class="section section-gray">
        <div class="container">
            <h2 class="section-title">360 Degree Store View</h2>
            <div class="row">
                <div class="col-md-12">
                        <div class="video-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m0!3m2!1sen!2sus!4v1446506380121!6m8!1m7!1s9dOzJX2yah8AAAQWtNH4iw!2m2!1d34.02931571349768!2d-81.09861811327539!3f197.44035197021321!4f-8.07278125882712!5f0.7820865974627469" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                </div> 
            </div>
        </div>
    </div> <!-- end section meet our clients -->

    <div class="space-50"></div>

    <div class="section section-description">
           <div class="container">
               <div class="row">
                    <div class="col-md-6">
                        <p>Introducing the New</p>
                        <h2>Red Sea REEFER&#8482 Systems</h2>
                    </div>
                   <div class="col-md-6">
                      <div class="video-container">
                          <iframe width="560" height="315" src="https://www.youtube.com/embed/DJypjaV_6n4" frameborder="0" allowfullscreen></iframe>
                      </div>
                   </div>
                </div>
            
                <div class="space-50"></div>
                
                <div class="row">
                   <div class="col-md-12">
                      <div class="img-container">
                          <img src="../assets/img/redsea.png" alt="..." />
                      </div>
                   </div>
               </div>
           </div>
    </div><!-- section -->
    
    <hr>
    <div class="space-50"></div>
    
    <div class="section">
        <div class="container">
            <div class="team-presentation">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="content">
                                <div class="description">
                                    <a href="gallery.php">
                                    <img class="card-img-top" src="../assets/img/gallery.jpg" alt="..."/>
                                    <h4 class="title">Gallery <br />
                                        <small>Our all new gallery section contains the feature fish and the all new "Tank of the Month". Over time this section will only get better, so check back often for new updates!</small>
                                    </h4> 
                                    </a>
                                </div>  
                            </div>
                        </div> <!-- end card--> 
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="content">
                                <div class="description">
                                    <a href="totm.php">
                                        <img class="card-img-top" src="../assets/img/totm.jpg" alt="..."/>
                                        <h4 class="title">Tank of the Month <br />
                                            <small>A new feature that will be available is our "Tank of the Month." Send in your photos an descriptions and you might just be featured here! This has the element of a contest as the winner of our feature will be given a gift certificate, exposure on our website and bragging rites galore! :)</small>
                                        </h4> 
                                    </a>
                                </div>  
                            </div>
                        </div> <!-- end card -->
                    </div> 
                    <div class="col-md-4">
                        <div class="card text-center">
                            <!-- <div class="image"></div> -->
                            <div class="content">
                                <div class="description">
                                    <a href="service.php">
                                        <img class="card-img-top" src="../assets/img/truck.jpg" alt="..."/>
                                        <h4 class="title">Service <br />
                                            <small>Fishy Business is the absolute best when it comes to service. From your business to your home, we come to you and take care of any and all of your aquarium needs. What could be simpler than that?</small>
                                        </h4> 
                                    </a>
                                </div>  
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end section meet our team -->

    <div class="space-50"></div> 
    
    <div class="social-line">
         <div class="container">
            <div class="row">
                 <div class="col-md-3">
                     <a href="http://www.facebook.com/FishyBusinessSC/" class="btn btn-round btn-fill btn-social btn-facebook">
                         <i class="fa fa-facebook-square"></i> Facebook
                     </a>
                 </div>
                  <div class="col-md-3">
                     <a href="https://twitter.com/fishyguys" class="btn btn-round btn-fill btn-social btn-twitter">
                         <i class="fa fa-twitter"></i> Twitter
                     </a>
                 </div>
                  <div class="col-md-3">
                     <a href="" class="btn btn-round btn-fill btn-social btn-google">
                         <i class="fa fa-google-plus-square"></i> Google+
                     </a>
                 </div>
                 <div class="col-md-3">
                     <a href="http://www.youtube.com/channel/UCKAoquCimTvJs8_J9iLX1Ag?feature=CAQQwRs%3D" class="btn btn-round btn-fill btn-social btn-youtube">
                         <i class="fa fa-youtube"></i> YouTube
                     </a>
                 </div>
            </div>
         </div>
     </div> 

    
    <footer class="footer footer-big">
        <!-- .footer-black is another class for the footer, for the transparent version, we recommend you to change the url of the image with your favourite image.          -->
        
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h5 class="title">Company</h5>
                    <nav>
                        <ul>
                            <li>
                                <a href="index.php" >
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="gallery.php">
                                   Gallery
                                </a>
                            </li>
                            <li>
                                <a href="on-sale.php">
                                    On Sale
                                </a>
                            </li>
                            <li>
                                <a href="totm.php">
                                    Tank of the Month
                                </a>
                            </li>
                            <li>
                                <a href="service.php">
                                    Service
                                </a>
                            </li>
                            <li>
                                <a href="contact-us.php">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <h5 class="title"> Location</h5>
                    <nav>
                        <ul>
                            <li>
                                652 Bush River Road Suite #K
                            </li>
                            <li>
                                Columbia, SC 29210
                            </li>
                            <li>
                                803-731-4004
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3">
                    <h5 class="title"> Hours</h5>
                    <nav>
                        <ul>
                            <li>
                                M-F 11:00am-6:00pm
                            </li>
                            <li>
                                Sat 11:00am-4:00pm
                            </li>
                            <li>
                                Sun 1:30pm-4:00pm
                            </li>
                        </ul>
                    </nav>
                   
                </div>

                 <div class="col-md-3">
                    <h5 class="title">Latest News</h5>
                    <nav>
                        <ul>
                            <li>
                                <a href="#" >
                                   <i class="fa fa-twitter"></i> <b>Fishy Business</b>
                                   Welcome to our newly redesigned website, easier to read on all of your devices from smartphone to desktop!...
                                   <hr class="hr-small">
                                </a>
                            </li>
                            <li>
                                  <a href="#" >
                                   <i class="fa fa-twitter"></i>
                                   We've just been featured on <b> CK Developing's Website</b>! Thank you everybody for supporting us over the years...
                                </a>
                            </li>
                          
                        </ul>
                    </nav>
                </div>

            </div>
            <hr />
            <div class="copyright">
                &copy; 2015 Fishy Business, LLC.
            </div>
        </div>
    </footer>   
    
    
</div> <!-- wrapper --> 
</body>
    <!--  jQuery and Bootstrap core files    -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
	<script src="../bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
		
	<!--  Plugins -->
	<script src="../assets/js/gsdk-checkbox.js"></script>
	<script src="../assets/js/gsdk-morphing.js"></script>
	<script src="../assets/js/gsdk-radio.js"></script>
	<script src="../assets/js/gsdk-bootstrapswitch.js"></script>
	<script src="../assets/js/bootstrap-select.js"></script>
	<script src="../assets/js/bootstrap-datepicker.js"></script>
	<script src="../assets/js/chartist.min.js"></script>
    <script src="../assets/js/jquery.tagsinput.js"></script>
    <script src="../assets/js/retina.min.js"></script>
    <script src="../assets/js/login-register.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    
	<!--  Get Shit Done Kit PRO Core javascript 	 -->
	<script src="../assets/js/get-shit-done.js"></script>
    
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
    
    <!-- If you are using TypeKit.com uncomment this code otherwise you can delete it -->
    <!--
    <script src="https://use.typekit.net/[your kit code here].js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    -->
    
</html>
