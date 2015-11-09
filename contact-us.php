<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
 
    sec_session_start();
 
    if (login_check($mysqli) == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Contact Us - Fishy Business</title>

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

<body class="contact-us">

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
    <a class="navbar-brand" href="index.php"><img src="../assets/img/logo.png" alt="..." /></a>
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
    <div class="parallax">
           <div class="company-description">
               <h4>Fishy Business</h4>
               <p>Columbia, South Carolina</p>
           </div>
            <div id="contactUsMap" class="big-map"></div>
    </div>

    <div class="section">
           <div class="container">
               <h2 class="section-title">Send us a message</h2>
               <div class="row">
                   <div class="col-md-6">
                       <p>
                           You can contact us with anything related to our Products. We'll get in touch with you as soon as possible.<br><br>
                        </p>
                        <form role="form" id="contact-form" method="post">
    						<div class="form-group">
    				    		<label for="name">Your name</label>
    				    		<input type="text" name="name" class="form-control" id="name" placeholder="First Name and Last Name"/>
    				  		</div>
    				  		<div class="form-group">
    				    		<label for="email">Email address</label>
    				    		<input type="email" name="email" class="form-control" id="email" placeholder="Your personal email address"/>
    				  		</div>
    				  		<div class="form-group">
    				    		<label for="phone">Phone</label>
    				    		<input type="text" name="phone" class="form-control" id="phone" placeholder="Phone number"/>
    				  		</div>
    				  		<div class="form-group">
    				    		<label for="message">Your message</label>
    				    		<textarea name="message" class="form-control" id="message" rows="6"></textarea>
    				  		</div>
    				  		<div class="submit">
    				  			<input type="submit" class="btn btn-info btn-fill" value="Contact Us" />
    				  		</div>
    					</form>
                   </div>
                   <div class="col-md-4 col-md-offset-2">
                        <div class="contact-info">
                            <h5><i class="fa fa-map-marker text-muted"></i> Address</h5>
                            <p class="text-muted"> 652 Bush River Road #K<br>
                                Columbia, SC 29210
                            </p><br>
                            <h5><i class="fa fa-phone text-muted"></i> Live Support</h5>
                            <p class="text-muted"> In-Store or by Phone<br>
                                (803) 731-4004<br>
                                Mon - Fri, 11:00am-6:00pm<br>
                                Sat, 11:00am-4:00pm<br>
                                Sun, 1:30pm-4:00pm
                            </p><br>
                            <h5><i class="fa fa-building text-muted"></i> Business Info</h5>
                            <p class="text-muted"> Fishy Business, LLC.
                            </p>
                        </div>
                   </div>
               </div>
           </div>
    </div><!-- section -->
    <div class="space-50"></div>
    
    <footer class="footer footer-big footer-black">
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
                                <a href="on-sale.php">
                                    On Sale
                                </a>
                            </li>
                            <li>
                                <a href="gallery.php">
                                   Gallery
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
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <h5 class="title"> Help and Support</h5>
                    <nav>
                        <ul>
                            <li>
                                <a href="contact-us.php">
                                   Contact Us
                                </a>
                            </li>
                            <li>
                                <a href="about-us.php">
                                    About Us
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3">
                    <h5 class="title">Follow us on</h5>
                    <nav>
                        <ul>
                            <li>
                                <a href="http://www.facebook.com/FishyBusinessSC/" class="btn btn-round btn-fill btn-social btn-facebook">
                                <i class="fa fa-facebook-square"></i> Facebook
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/fishyguys" class="btn btn-round btn-fill btn-social btn-twitter">
                                <i class="fa fa-twitter"></i> Twitter
                                </a>
                            </li>
                            <li>
                                <a href="" class="btn btn-round btn-fill btn-social btn-google">
                                <i class="fa fa-google-plus-square"></i> Google+
                                </a>
                            </li>
                            <li>
                                <a href="http://www.youtube.com/channel/UCKAoquCimTvJs8_J9iLX1Ag?feature=CAQQwRs%3D" class="btn btn-round btn-fill btn-social btn-youtube">
                                <i class="fa fa-youtube"></i> YouTube
                                </a>
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
    <script type="text/JavaScript" src="assets/js/sha512.js"></script> 
    <script type="text/JavaScript" src="assets/js/forms.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    
	<!--  Get Shit Done Kit PRO Core javascript 	 -->
	<script src="../assets/js/get-shit-done.js"></script>
    
    <script type="text/javascript">
        var parallax_map;
        $().ready(function(){
            responsive = $(window).width();
        
            examples.initContactUsMap();
            
            if (responsive >= 768){
                parallax_map = $('.parallax').find('.big-map');
                
                $(window).on('scroll',function(){           
                    parallax();
                    gsdk.checkScrollForTransparentNavbar();
                });
            }
            
        });        

       var parallax = function() {
            var current_scroll = $(this).scrollTop();
            
            oVal = ($(window).scrollTop() / 3); 
            parallax_map.css('top',oVal);
        };

    </script>
    
    <!-- If you are using TypeKit.com uncomment this code otherwise you can delete it -->
    <!--
    <script src="https://use.typekit.net/[your kit code here].js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    -->
    
</html>
