<?php 

 // Connects to your Database 

 mysql_connect("localhost", "vpnflix", " ") or die(mysql_error()); 

 mysql_select_db("vpnflix") or die(mysql_error()); 


 //Checks if there is a login cookie

 if(isset($_COOKIE['ID_my_site']))


 //if there is, it logs you in and directes you to the members page

 { 
 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site'];

 	 	$check = mysql_query("SELECT * FROM clients WHERE username = '$username'")or die(mysql_error());

 	while($info = mysql_fetch_array( $check )) 	

 		{

 		if ($pass != $info['password']) 

 			{

 			 			}

 		else

 			{

 			header("Location: members.php");



 			}

 		}

 }


 //if the login form is submitted 

 if (isset($_POST['submit'])) { // if form has been submitted



 // makes sure they filled it in



 	



	// checks it against the database

 	$check = mysql_query("SELECT * FROM clients WHERE username = '".$_POST['username']."'")or die(mysql_error());



 //Gives error if user dosen't exist

 $check2 = mysql_num_rows($check);

 if ($check2 == 0) {
		header("Location: login.php"); 

 				}

 while($info = mysql_fetch_array( $check )) 	

 {

 $_POST['pass'] = stripslashes($_POST['pass']);

 	$info['password'] = stripslashes($info['password']);

	$_POST['pass'] = md5($_POST['pass']);

 //gives error if the password is wrong

 	if ($_POST['pass'] != $info['password']) {

 		header("Location: login.php"); 

 	}
	
	else 

 { 

 
 // if login is ok then we add a cookie 

 	 $_POST['username'] = stripslashes($_POST['username']); 

 	 $hour = time() + 3600; 

 setcookie(ID_my_site, $_POST['username'], $hour); 

 setcookie(Key_my_site, $_POST['pass'], $hour);	 

 

 //then redirect them to the members area 

 header("Location: members.php"); 

 } 

 } 

 } 

 else 

{	 

 

 // if they are not logged in 

 ?>




<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://www.w3.org/2005/10/profile">
<link rel="icon" 
      type="image/png" 
      href="images/services-icons/global_telecom.png" />
<meta charset="UTF-8" />
<meta charset="UTF-8" />
<title>VPNFlix | Client Login</title>
<!-- CSS -->
<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="css/custom.css" type="text/css" />
<link rel="stylesheet" href="css/tipsy.css" type="text/css" />
<link rel="stylesheet" href="css/superfish.css" type="text/css" />
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.1.css" type="text/css" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css">
<![endif]-->
<!-- Scripts -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="js/cufon-yui.js"></script>
<script src="js/jquery.easing.js"></script>
<script src="js/Harabara.js"></script>
<script src="js/superfish.js"></script>
<script src="js/css_browser_selector.js"></script>
<script src="js/jquery.cycle.all.js"></script>
<script src="fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/tipsy.js"></script>
<script src="js/bluz.js"></script>



<script>
	function validateForm() {
	var x=document.forms["login"]["username"].value;
	var y=document.forms["login"]["pass"].value;
	if (x==null || x=="")
	{
	alert("Please enter a username.");
	return false;
	}
	if (y==null || y=="")
	{
	alert("Please enter a password.");
	return false;
	}
  
 }


</script>

</head>
<body id="sub-page">
<!-- site-wrapper START here -->
<div id="site-wrapper">
  <!-- header START here -->
  <header>
    <!-- container START here -->
    <div class="container">
      <!-- logo START here -->
      <div id="logo">
        <h1><a href="index.php"><img src="images/logo2.png" alt="" /></a></h1>
      </div>
      <!-- logo END here -->
      <div id="login-holder"> <a href="http://vpnflix.com/choose.php" class="sml-btn green">Connect to VPN</a> </div>
      <!-- navigation START here -->
      <ul class="sf-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="why.php">Why Choose VPNFlix?</a></li>
        <li><a href="what-is-a-vpn.php">What is a VPN?</a></li>
        <li><a href="faq.php">FAQ and How-to</a></li>
		<li><a href="pricing.php">Features</a>
        <li><a href="contact.php">Contact Us</a></li>
		<li><a href="trial.php">Free Trial</a>
		<li class="current_page_item"><a href="login.php"><font color="#e60707"><b><?php if(isset($_COOKIE['ID_my_site'])) {echo $_COOKIE['ID_my_site'];}else{echo "Client Login";}  ?></b></font></a></li>
      </ul>
      <!-- navigation END here -->
      <div id="pagename">
        <div class="inside">
          <h2>Client Login Area</h2>
          <p class="breadcrumbs">You are here : <a href="#">Home</a> / Client Login</p>
        </div>
      </div>
    </div>
    <!-- container END here -->
  </header>
  <!-- header END here -->
  <!-- content START here -->
  <div id="content">
    <!-- container START here -->
    <div class="container">

	<!-- Login Code -->

	
	 
		<center>
	<h4>Client Login</h4><br/>
	<form name="login" method="post" action="<?php echo $PHP_SELF;?>" onsubmit="return validateForm()">
	<input name="username" type="text" id="username" width="150" placeholder="Username"><br/>								
	<input name="pass" type="password" id="pass" width="150" placeholder="Password"><br/>
	<input name="submit" type="submit" id="submit" value="Login">
	</form>
	<a href="forgotpw.php">Forgot Password?</a>
	</center>
	
	
	
	
	
        <!-- End Login Code -->
    </div>
    <!-- container END here -->
  </div>
  <!-- content END here -->
</div>
<!-- site-wrapper END here -->
<!-- footer START here -->
<footer>
  <!-- container START here -->
  <div class="container">
   <div id="footer-colums">
    <!-- footer-colum1 START here -->
    <div class="footer-colum">
      <h4>Company</h4>
      <ul>
        <li><a href="#">What is VPNFlix?</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Jobs</a></li>
      </ul>
    </div>
    <!-- footer-colum1 END here -->
    <!-- footer-colum2 START here -->
    <div class="footer-colum">
      <h4>Useful Links</h4>
      <ul>
        <li><a href="#">Tutorials and How-to</a></li>
        <li><a href="#">Connect to VPN</a></li>
      </ul>
    </div>
    <!-- footer-colum2 END here -->
    <!-- footer-colum3 START here -->
    <div class="footer-colum">
      <h4>Contact Methods</h4>
      <ul>
        <li><a href="#">support@vpnflix.com</a></li>
      </ul>
    </div>
    <!-- footer-colum3 END here -->
    <!-- footer-colum4 START here -->
    <div class="footer-colum no-margin">
      <h4>Learn about VPNs</h4>
      <ul>
        <li><a href="http://en.wikipedia.org/wiki/Virtual_private_network">VPN on Wikipedia</a></li>
      </ul>
    </div>
    <!-- footer-colum4 END here -->
   </div>
  </div>
  <!-- container END here -->
  <!-- bottom-footer START here -->
  <div id="bottom-footer">
    <!-- container START here -->
    <div class="container">
      <p class="alignleft">&copy; 2012 All Rights Reserved.</p>
      <ul id="social-list" class="alignright">
        <li><a href="#" rel="tipsy" title="Monthly Newsletter"><img src="images/social-icons/email.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Facebook"><img src="images/social-icons/facebook.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Twitter"><img src="images/social-icons/twitter.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Flickr"><img src="images/social-icons/flickr.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Last FM"><img src="images/social-icons/lastfm.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Linked In"><img src="images/social-icons/linkedin.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Myspace"><img src="images/social-icons/myspace.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Skype"><img src="images/social-icons/skype.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Stumble Upon"><img src="images/social-icons/stumbleupon.png" alt="" /></a></li>
        <li><a href="#" rel="tipsy" title="Youtube"><img src="images/social-icons/youtube.png" alt="" /></a></li>
      </ul>
    </div>
    <!-- container END here -->
  </div>
  <!-- bottom-footer END here -->
</footer>
<!-- footer END here -->
<div class="hidden">
  <div id="login-box">
    <form action="" method="post">
      <label for="login-username">Username:</label>
      <input type="text" name="login_username" id="login-username" />
      <label for="login-password">Password:</label>
      <input type="text" name="login_password" id="login-password" />
      <div class="submit-block"> <span class="alignleft">
        <input name="" type="checkbox" value="" class="checkbox" />
        Remember me</span> <span class="alignright">
        <input type="submit" name="submit" id="login-submit" value="Login" class="sml-btn grey" />
        </span> </div>
      <a href="#" class="lostpass">Lost your password or username?</a>
    </form>
  </div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
<script src="js/init_form.js"></script>
</body>
</html>
	 <?php 

 } 

 

 ?> 