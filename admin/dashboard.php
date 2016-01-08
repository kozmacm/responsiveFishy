<?php
    include_once '../includes/db_connect.php';
    include_once '../includes/register.inc.php';
    include_once '../includes/functions.php';
    require 'includes/gapi.class.php';
 
    sec_session_start();

    if(isset($_GET['success'])) 
    {
        echo"<div id='successAlert' class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert'>&times;</a>
                <strong>Success!</strong>&nbsp;You have registered a new user.&nbsp;&nbsp;<br>
             </div>";
    }

    $ga = new gapi("fishy-business-service@fishy-business-1182.iam.gserviceaccount.com", "keys/Fishy Business-a9f7453a79f4.p12");
    //$filter = 'country == United States && browser == Firefox || browser == Chrome';
    $ga->requestReportData(91085606,array('browser','browserVersion'),array('pageviews','visits'),'-visits',$filter, NULL, NULL, 1, 10);
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
            
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    
</head>
<body> 
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
                    <a href="totm.php">
                        <i class="pe-7s-photo"></i> 
                        <p>Tank of the Month</p>
                    </a>            
                </li>
                <li class="active">
                    <a href="news.php">
                        <i class="pe-7s-news-paper"></i> 
                        <p>Weekly News Updates</p>
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
                    <a class="navbar-brand">Dashboard</a>
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
                        <p>This is the secure backend for administrators. You are currently logged in. </p>
                        <div class="content table-responsive table-full-width">
                            <table class='table table-hover'>
                                <tr>
                                  <th>Browser &amp; Browser Version</th>
                                  <th>Pageviews</th>
                                  <th>Visits</th>
                                </tr>
                                <?php
                                foreach($ga->getResults() as $result):
                                ?>
                                <tr>
                                  <td><?php echo $result ?></td>
                                  <td><?php echo $result->getPageviews() ?></td>
                                  <td><?php echo $result->getVisits() ?></td>
                                </tr>
                                <?php
                                endforeach
                                ?>
                                </table>

                                <table>
                                <tr>
                                  <th>Total Results</th>
                                  <td><?php echo $ga->getTotalResults() ?></td>
                                </tr>
                                <tr>
                                  <th>Total Pageviews</th>
                                  <td><?php echo $ga->getPageviews() ?>
                                </tr>
                                <tr>
                                  <th>Total Visits</th>
                                  <td><?php echo $ga->getVisits() ?></td>
                                </tr>
                                <tr>
                                  <th>Result Date Range</th>
                                  <td><?php echo $ga->getStartDate() ?> to <?php echo $ga->getEndDate() ?></td>
                                </tr>
                            </table>
                        </div>
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
                         <div class="error"></div>
                         <div class="form loginBox">
                            <form action="../includes/login.php" method="post"> 
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
                            <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form"> 
                                <label>Username:</label> 
                                <input id="username" class="form-control" type="text" placeholder="Username" name="username" /> 
                                <label>Email: <strong style="color:darkred;">*</strong></label> 
                                <input id="email" class="form-control" type="text" placeholder="Email" name="email" /> 
                                <label>Password:</label> 
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password" />
                                <label>Confirm Password:</label> 
                                <input id="confirmpwd" class="form-control" type="password" placeholder="Confirm Password" name="confirmpwd" /> <br /><br />
                                <input type="submit" class="btn btn-default btn-register" value="Register" 
                                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);"/> 
                            </form>
                        </div>
                     </div>
                </div>
            </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                    <span>Looking to 
                    <a href="javascript: showRegisterForm();">create an account</a>
                    ?</span>
                </div>
                <div class="forgot register-footer" style="display:none">
                    <!--
                    <span>Already have an account?</span>
                    <a href="javascript: showLoginForm();">Login</a>
                    -->
                </div>
            </div>        
        </div>
    </div>
</div>
<!-- /.login/register modal -->
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

    <script src="../assets/js/login-register.js" type="text/javascript"></script>
	
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
