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
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>About Us - Fishy Business</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/gsdk.css" rel="stylesheet"/>
    <link href="assets/css/fishy.css" rel="stylesheet"/>
    <link href="assets/css/login-register.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> 
    <link href='https://fonts.googleapis.com/css?family=Grand+Hotel|Open+Sans:400,300' rel='stylesheet' type='text/css'>  
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />  
</head>

<body class="about-us">

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
    <div class="parallax filter-black">
        <div class="parallax-image">
            <img src="assets/img/thumb.jpg">
        </div>    
        <div class="small-info">
            <h1>About Us</h1>
            <h3></h3>    
        </div>
    </div>

    <div class="section">
           <div class="container">
               <h2 class="section-title">About our Company</h2>
               <div class="row">
                   <div class="col-md-12">
                       </p>Welcome to the new and improved Fishy Business website and webstore! In the coming weeks you are going to see improvements in every aspect of Fishy Business Aquatics...so much is coming your way in our effort to better serve both our local customer base and those of you who have, up till now, been beyond our reach! </p>
                       <p>Fishy Business was established in 1986 as Guy Griffin put his childhood dream into motion by creating what has now become the largest aquatic store in South Carolina. With over 5000 square feet of retail shopping, Fishy Business boasts the largest selection of freshwater fish, saltwater fish, corals, live plants, and invertebrates in the area.We only stock the best quality livestock from the best distributors all over the world! </p>
                       <p>What makes Fishy Business truly unique is the passion and knowlege each staff member has for the hobby and for the helping advise and the individual care we put into each of our customers' aquariums. This is what makes us different and this is what makes us special. Our commitment is that we aid every novice aquarist in achieving their dream no matter what size or type of aquarium they have. In every aspect we will use all the resources we have to make this hobby gratifying to each and every person we have the pleasure of meeting. Success is our sole desire - customer satisfaction our only goal! </p>
                       <p>Fishy Business is now entering a new era in our history as we go forward expanding every aspect of our livestock selection and opening our first online coral store for customers nationwide in the days to come. </p>
                   </div>
               </div>
           </div>
    </div><!-- section -->
    
    <div class="section section-gray">
        <div class="container">
            <h2 class="section-title">Meet our Team <small> </small></h2>
            <div class="team-presentation">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-user card-plain">
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                    <img class="avatar border-gray" src="assets/img/faces/guygriffin.png" alt="..."/>
                                    <h4 class="title">Guy Griffin <br />
                                        <small>Owner/President</small>
                                    </h4> 
                                    </a>
                                </div>  
                                <p class="description text-center"> 
                                    Guy Griffin is the CEO and founder of Fishy Business. Guy has spent the majority of his life keeping fish, catching fish, displaying fish and managing all the day to day operations that have made Fishy Business the Midlands largest aquatic pet retailer. With 40 years experience under his belt, He has Fishy Business poised to become the largest aquatic retailer in South Carolina with the greatest selection of aquariums, fish and supplies!
                                </p>
                            </div>
                        </div> <!-- end card--> 
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user card-plain">
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="assets/img/faces/chuckmaier.png" alt="..."/>
                                        <h4 class="title">Chuck Maier <br />
                                            <small>Owner/Vice President</small>
                                        </h4> 
                                    </a>
                                </div>  
                                <p class="description text-center"> 
                                    Chuck Maier is co-owner and Vice President of Fishy Business. His tenure with Fishy Business spans 25 years and his experience with saltwater aquatics spans longer than that. His specialty is in aquatic creative design and saltwater reef keeping with day to day support of the service side of Fishy Business.
                                </p>
                            </div>
                        </div> <!-- end card -->
                    </div> 
                    <div class="col-md-4">
                        <div class="card card-user card-plain">
                            <!-- <div class="image"></div> -->
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="assets/img/faces/scott.jpg" alt="..."/>
                                        <h4 class="title">Scott Gibbs <br />
                                            <small>General Manager</small>
                                        </h4> 
                                    </a>
                                </div>  
                                <p class="description text-center"> 
                                    Scott Gibbs is the General Manager of Fishy Business and has been here 15 years with over 25 years experience maintaining and designing aquariums. His knowledge of aquatics and aquarium design are unequaled and his friendly disposition and attention to customer service makes him the perfect person to consult on aquarium design.
                                </p>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-user card-plain">
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                    <img class="avatar border-gray" src="assets/img/faces/mike.jpg" alt="..."/>
                                    <h4 class="title">Mike Griffin <br />
                                        <small>Chief Service Tech</small>
                                    </h4> 
                                    </a>
                                </div>  
                                <p class="description text-center"> 
                                    Mike Griffin is the backbone of Fishy Business. Mike is an expert aquarist with 30 years experience maintaining and designing aquaria. He is also our chief service tech and there is absolutely no aspect of aquarium design, service, or problem-solving he cannot perform!
                                </p>
                            </div>
                        </div> <!-- end card--> 
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user card-plain">
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="assets/img/faces/kevin.jpg" alt="..."/>
                                        <h4 class="title">Kevin Walker <br />
                                            <small>Freshwater Manager</small>
                                        </h4> 
                                    </a>
                                </div>  
                                <p class="description text-center"> 
                                    Kevin Walker is our Freshwater manager par excellence. With over 30 years taking care of aquariums( with special emphasis on hard to keep species), he is the 1# guy to see at Fishy Business with any questions, problems or advice on aquarium keeping.
                                </p>
                            </div>
                        </div> <!-- end card -->
                    </div> 
                    <div class="col-md-4">
                        <div class="card card-user card-plain">
                            <!-- <div class="image"></div> -->
                            <div class="content">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="assets/img/faces/gracie.jpg" alt="..."/>
                                        <h4 class="title">Gracie Cubbler <br />
                                            <small>Saltwater Manager</small>
                                        </h4> 
                                    </a>
                                </div>  
                                <p class="description text-center"> 
                                    Gracie Cubbler is not only the prettiest face at Fishy Business she is also the manager of all our Saltwater and Reef aquatic systems. Her strong emphasis and attention towards customer service and a background as a certified Scuba diver, make her the ideal candidate to speak with when you have questions or concerns with saltwater reef keeping and design. 
                                </p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end section meet our team -->
    
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
	<script src="assets/js/chartist.min.js"></script>
    <script src="assets/js/jquery.tagsinput.js"></script>
    <script src="assets/js/retina.min.js"></script>
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
