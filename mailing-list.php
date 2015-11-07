<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Mailing List - Fishy Business</title>

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

<body class="mailing-list">

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
            <img src="../assets/img/thumb.jpg">
        </div>    
        <div class="small-info">
            <h1>Mailing List</h1>
            <h3>Join our mailing list and recieve updates via email!</h3>    
        </div>
    </div>

    <!-- Begin MailChimp Signup Form -->

    <div class="section">
           <div class="container">
               <h2 class="section-title">Subscribe to our mailing list</h2>
               <div class="row">
                   <div class="col-md-12">
                       <p>
                           <span class="asterisk">*</span> indicates required<br><br>
                        </p>
                        <form action="//fishybusinesssc.us10.list-manage.com/subscribe/post?u=c82fc1108ea581e7beb6e4177&amp;id=aa0b16e5fe" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    						<div class="form-group">
    				    		<label for="FNAME">First name</label>
    				    		<input type="text" name="FNAME" class="form-control" id="fname" placeholder="First Name"/>
    				  		</div>
                            <div class="form-group">
    				    		<label for="LNAME">Last name</label>
    				    		<input type="text" name="LNAME" class="form-control" id="lname" placeholder="Last Name"/>
    				  		</div>
    				  		<div class="form-group">
    				    		<label for="EMAIL">Email address</label>
    				    		<input type="email" name="EMAIL" class="form-control" id="email" placeholder="Your personal email address"/>
    				  		</div>
    				  		<div class="submit">
    				  			<input type="submit" class="btn btn-info btn-fill" value="Subscribe" id="mc-embedded-subscribe" />
    				  		</div>

                            <div class="space-50"></div>

                            <div id="mce-responses" class="clear">
		                        <div class="response" id="mce-error-response" style="display:none"></div>
		                        <div class="response" id="mce-success-response" style="display:none"></div>
	                        </div>
    					</form>
                   </div>
                   <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
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
                        <i class="fa fa-pinterest"></i>
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
