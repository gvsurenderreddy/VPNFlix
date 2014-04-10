<?php 

 // Connects to your Database 

 mysql_connect("localhost", "vpnflix", " ") or die(mysql_error()); 

 mysql_select_db("vpnflix") or die(mysql_error()); 

 
 //checks cookies to make sure they are logged in 

 if(isset($_COOKIE['ID_my_site'])) 

 { 

 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site']; 

 	 	$check = mysql_query("SELECT * FROM clients WHERE username = '$username'")or die(mysql_error()); 

 	while($info = mysql_fetch_array( $check )) 	 

 		{ 

 

 //if the cookie has the wrong password, they are taken to the login page 

 		if ($pass != $info['password']) 

 			{ 			
			
			setcookie(ID_my_site, gone, $past); 

			setcookie(Key_my_site, gone, $past);
			header("Location: login.php"); 

 			} 


 	else 

 			{ 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://www.w3.org/2005/10/profile">
<link rel="icon" 
      type="image/png" 
      href="images/services-icons/global_telecom.png" />
<meta charset="UTF-8" />
<meta charset="UTF-8" />
<title>VPNFlix | Client Area - Edit Account Info</title>
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
	var x=document.forms["password"]["currentpassword"].value;
	var y=document.forms["password"]["newpassword"].value;
	var z=document.forms["password"]["newpasswordconfirm"].value;
	if (x==null || x=="")
	{
	alert("Please enter current password.");
	return false;
	}
	if (y==null || y=="")
	{
	alert("Please enter new password.");
	return false;
	}
	if (z==null || z=="")
	{
	alert("Please confirm your password.");
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
		<li><a href="pricing.php">Features</a></li>
        <li><a href="contact.php">Contact Us</a></li>
		<li><a href="trial.php">Free Trial</a>
		<li class="current_page_item"><a href="login.php"><font color="#e60707"><b><?php if(isset($_COOKIE['ID_my_site'])) {echo $_COOKIE['ID_my_site'];}else{echo "Client Login";}  ?></b></font></a></li>
      </ul>
      <!-- navigation END here -->
      <div id="pagename">
        <div class="inside">
          <h2>Client Area - Edit Account Info</h2>
          <p class="breadcrumbs">You are here : <a href="#">Home</a> / Client Area - Edit Account Info</p>
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

	<!-- Member Area -->
	


	<center>
	
	<h2>Change Password for VPN and Client Area</h2>
	<form name="password" method="post" action="<?php echo $PHP_SELF;?>" onsubmit="return validateForm()">
	<input type="password" placeholder="Current Password" name="currentpassword"/><br/>
	<input type="password" placeholder="New Password" name="newpassword"/><br/>
	<input type="password" placeholder="Confirm Password" name="newpasswordconfirm"/><br/>
	<input type="submit" value="Submit" name="submit"/>
	</form>
		<?php

	
	if (isset($_POST['submit'])) {
	
		$result = mysql_query("SELECT * FROM clients WHERE username='$_COOKIE[ID_my_site]'");
		$row = mysql_fetch_array($result);
		
		$currentpassworddb = $row['password'];
		$currentpassword = md5($_POST['currentpassword']);
		
		$newpassword = $_POST['newpassword'];
		$newpasswordconfirm = $_POST['newpasswordconfirm'];
		
		if ($currentpassworddb != $currentpassword) {
			echo "<font color='red'>Incorrect current password.</font>";
		}
		elseif ($newpassword != $newpasswordconfirm) {
			echo "<font color='red'>Passwords do not match.</font>";
		} else {
		
			$encryptpw = md5($newpasswordconfirm);
		
			mysql_query("UPDATE clients SET password='$encryptpw' WHERE username='$_COOKIE[ID_my_site]'");
			echo "<font color='green'>Password changed successfully.</font>";
			
			
			//Edit password on VPN ********************************
			$sshConnection = ssh2_connect(' ', 22);
			if(!$sshConnection) {
			die('Could not connect to VPN server.');
			}
			if(!ssh2_auth_password($sshConnection, 'root', 'jxuxvmfvd5aw')){
			die('VPN server Auth Failed.');
			}
			if (!ssh2_exec($sshConnection, "vpnpasswd $_COOKIE[ID_my_site] $newpasswordconfirm")) {
			die ('Could not change password.');
			}
			//Edit password on VPN ********************************
			
			$past = time() - 100; 

			//this makes the time in the past to destroy the cookie 

			setcookie(ID_my_site, gone, $past); 

			setcookie(Key_my_site, gone, $past);
		
		
		
		}
	
	}
	
	?>
	
	</center>
	
        <!-- End Member Area -->
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

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 
