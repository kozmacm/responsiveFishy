<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Tank of the Month Signup - Fishy Business</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="../bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/gsdk.css" rel="stylesheet"/>
    <link href="../assets/css/fishy.css" rel="stylesheet"/>
    <link href="../assets/css/fileinput.min.css" media="all" rel ="stylesheet" type="text/css"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> 
    <link href='https://fonts.googleapis.com/css?family=Grand+Hotel|Open+Sans:400,300' rel='stylesheet' type='text/css'>  
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />  
</head>

<body class="totm">

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
                        <a href="#">
                             <i class="pe-7s-photo"></i> Gallery
                        </a>
                    </li>
                      <li>
                        <a href="#">
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
                  </ul>
            </li>
            <li><a href="mailing-list.php" class="btn btn-round btn-default">Join our mailing list!</a></li>
       </ul>
      
    </div><!-- /.navbar-collapse -->
  </div>
</nav>

<div class="wrapper">
    <div class="parallax filter-black">
        <div class="parallax-image">
            <img src="../assets/img/thumb.jpg">
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
                   <div class="col-md-12">
                       <div class="img-container">
                           <a href="https://www.facebook.com/media/set/?set=vb.122002154595568&type=2">
                           <img src="../assets/img/thumb.jpg" alt="..." /> </a>
                       </div>
                   </div>

                   <div class="space-50"></div>

                   <div class="col-md-12">
                       <div>
                           <p>Current tank of the month description goes here...</p>
                       </div>
                   </div>
               </div>
            </div>
    
    <div class="section">
           <div class="container">
               <h2 class="section-title">Send us your entry and win!</h2>
               <div class="row">
                   <div class="col-md-12">
                       <p>
                           <span class="asterisk">*</span> indicates required<br><br>
                        </p>
                        <form method="post" id="form" name="form">
    						<div class="form-group">
                                <label class="control-label">Select File</label>
                                <input id="input-2" type="file" class="file" multiple="true" data-show-upload="false" data-show-caption="true">
    				  		</div>
                            <div class="form-group">
    				    		<label for="LNAME">Full Name</label>
    				    		<input type="text" name="LNAME" class="form-control" id="lname" placeholder="Full Name"/>
    				  		</div>
    				  		<div class="form-group">
    				    		<label for="EMAIL">Email address</label>
    				    		<input type="email" name="EMAIL" class="form-control" id="email" placeholder="Your personal email address"/>
    				  		</div>
                            <div class="form-group">
    				    		<label for="message">Tank Description</label>
    				    		<textarea name="message" class="form-control" id="message" rows="6" placeholder="Enter details about your tank setup here"></textarea>
    				  		</div>
    				  		<div class="submit">
    				  			<input type="submit" class="btn btn-info btn-fill" value="Submit" id="mc-embedded-subscribe" />
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
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="social-area pull-right">                
                    <a class="btn btn-social btn-facebook btn-simple">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                    <a class="btn btn-social btn-twitter btn-simple">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a class="btn btn-social btn-pinterest btn-simple">
                        <i class="fa fa-pinterest"></i>
                    </a>
                </div>
                <div class="copyright">
                    &copy; 2015 <a href="http://www.fishybusinesssc.com/responsive">Fishy Business</a>
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
    <script src="../assets/js/fileinput.min.js" type="text/javascript"></script>
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
