<?php
require_once('phpmailer/class.phpmailer.php');

define('GUSER', 'vpnflix@gmail.com'); // GMail username
define('GPWD', ' '); // GMail password

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}



$con = mysql_connect("localhost", "vpnflix", " ") or die(mysql_error()); 
mysql_select_db("vpnflix", $con);
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://www.w3.org/2005/10/profile">
<link rel="icon" 
      type="image/png" 
      href="images/services-icons/global_telecom.png" />
<meta charset="UTF-8" />
<meta charset="UTF-8" />
<title>VPNFlix | Recover Password</title>
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
	var x=document.forms["recover"]["email"].value;
	if (x==null || x=="")
	{
	alert("Please enter your Paypal email.");
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
		<li><a href="login.php"><font color="#e60707"><b><?php if(isset($_COOKIE['ID_my_site'])) {echo $_COOKIE['ID_my_site'];}else{echo "Client Login";}  ?></b></font></a></li>
      </ul>
      <!-- navigation END here -->
      <div id="pagename">
        <div class="inside">
          <h2>Recover Password</h2>
          <p class="breadcrumbs">You are here : <a href="index.php">Home</a> / Recover Password</p>
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

	<center>
	<h4>Recover Password</h4><br/>
	<form name="recover" method="post" action="<?php echo $PHP_SELF;?>" onsubmit="return validateForm()">
	<input name="email" type="text" id="email" style="width: 200px;" placeholder="Paypal Email"><br/>								
	<input name="submit" type="submit" id="submit" value="Send Recovery Email">
	</form>
<?php
	if (isset($_POST['submit'])) {
	
		$email = $_POST['email'];
		$query = mysql_query("SELECT * FROM clients WHERE email='$email'");
		$check = mysql_num_rows($query);
	
			if ($check > 0) {
				$query = mysql_query("SELECT * FROM clients WHERE email='$email'");
				$fetchrow = mysql_fetch_array($query);
				$usernamevpn = $fetchrow['username'];
				$first_name = $fetchrow['firstname'];
				$last_name = $fetchrow['lastname'];
				
				
				function generatePassword ($length = 8)
		{

		// start with a blank password
		$password = "";

		// define possible characters - any character in this string can be
		// picked for use in the password, so if you want to put vowels back in
		// or add special characters such as exclamation marks, this is where
		// you should do it
		$possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

		// we refer to the length of $possible a few times, so let's grab it now
		$maxlength = strlen($possible);
  
		// check for length overflow and truncate if necessary
		if ($length > $maxlength) {
		$length = $maxlength;
		}
	
		// set up a counter for how many characters are in the password so far
		$i = 0; 
    
		// add random characters to $password until $length is reached
		while ($i < $length) { 

		// pick a random character from the possible ones
		$char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
		// have we already used this character in $password?
		if (!strstr($password, $char)) { 
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
		}

		}

			// done!
			return $password;

		}
				
				
				$passwordvpn = generatePassword();
				$encryptpw = md5($passwordvpn);
				
				mysql_query("UPDATE clients SET password='$encryptpw'
				WHERE email='$email'");
				
				
				//Edit password on VPN ********************************
				$sshConnection = ssh2_connect(' ', 22);
				if(!$sshConnection) {
				die('Could not connect to VPN server.');
				}
				if(!ssh2_auth_password($sshConnection, 'root', ' ')){
				die('VPN server Auth Failed.');
				}
				if (!ssh2_exec($sshConnection, "vpnpasswd $usernamevpn $passwordvpn")) {
				die ('Could not change password.');
				}
			//Edit password on VPN ********************************
				
				$body = "Hello $first_name,\n\nThank you for choosing VPNFlix to unblock your internet and stay secure.  Your username and new password is below.\n\nUsername: $usernamevpn\nPassword: $passwordvpn\nConnect to VPN: https://vpn.vpnflix.com\nClient Area Login: http://vpnflix.com/login.php\n\nIf you have any problems please check out our FAQ articles at http://vpnflix.com/faq.php or you can email us at support@vpnflix.com\n\nEnjoy unblocked and private browsing!\n\nVPNFlix Team\nhttp://vpnflix.com";
				
				if (smtpmailer("$email", 'vpnflix@gmail.com', 'VPNFlix', 'Recover Password', "$body")) {
				
					echo "<font color='green'>Recovery email sent successfully.</font>";
				}
				//End Send Email ***********************************************************************
			
			} else {
				echo "<font color='red'>Invalid paypal email address.</font>";
				} 

	}
	
?>
	
	
	
	</center>
	
	
        <!-- one_half END here -->
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
