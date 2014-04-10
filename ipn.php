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

// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', '/home/admin/vpnflix/ipn_errors.log');

// intantiate the IPN listener
include('ipnlistener.php');
$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = false;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}

// ...

if ($verified) {

    $errmsg = '';   // stores errors from fraud checks
    
    // 1. Make sure the payment status is "Completed" 
    if ($_POST['payment_status'] != 'Completed') { 
        // simply ignore any IPN that is not completed
        exit(0); 
    }

    // 2. Make sure seller email matches your primary account email.
    if ($_POST['receiver_email'] != 'tompavey@gmail.com') {
        $errmsg .= "'receiver_email' does not match: ";
        $errmsg .= $_POST['receiver_email']."\n";
    }
    
    // 3. Make sure the amount(s) paid match
    if ($_POST['mc_gross'] != '4.00' && $_POST['mc_gross'] != '20.00') {
        $errmsg .= "'mc_gross' does not match: ";
        $errmsg .= $_POST['mc_gross']."\n";
    }
    
    // 4. Make sure the currency code matches
    if ($_POST['mc_currency'] != 'USD') {
        $errmsg .= "'mc_currency' does not match: ";
        $errmsg .= $_POST['mc_currency']."\n";
    }

    // TODO: Check for duplicate txn_id
    
    if (!empty($errmsg)) {
    
        // manually investigate errors from the fraud checking
        $body = "IPN failed fraud checks: \n$errmsg\n\n";
        $body .= $listener->getTextReport();
        mail('tompavey@gmail.com', 'IPN Fraud Warning', $body);
        
    } else {
		
		//*** Generate Password Function
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
  
  
		$usernamevpn = $_POST['custom'];
        $email = $_POST['payer_email'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$txn_id = $_POST['txn_id'];
		$payment_date = $_POST['payment_date'];
		$country = $_POST['address_country_code'];
  
		$passwordvpn = generatePassword();
		
		//******** We should encrypt the password *********
		
		$encryptpw = md5($passwordvpn);

		
		
		
		
		$expiry = 180;
		$expiry = round($expiry);
		$expiry = time() + $expiry * 60 * 60 * 24;
		
		
		
		//6 months add
		if ($_POST['mc_gross'] == '20.00') {
		
			$exist = mysql_query("SELECT * FROM clients WHERE username='$usernamevpn'");
			$fetchrow = mysql_fetch_array($exist);
		
			$disabled = $fetchrow['disabled'];
			
			//If they are disabled and renewing
			if ($disabled == 1) {
			
			mysql_query("UPDATE clients SET email='$email', expiry='$expiry', txn_id='$txn_id', payment_date='$payment_date', address_country_code='$country', disabled='0'
			WHERE username='$usernamevpn'");
			
			//Enable their VPN account
			$sshConnection = ssh2_connect(' ', 22);
			if(!$sshConnection) {
			die('Could not connect to VPN server.');
			}
			if(!ssh2_auth_password($sshConnection, 'root', 'jxuxvmfvd5aw')){
			die('VPN server Auth Failed.');
			}
			if (!ssh2_exec($sshConnection, "vpnuserunlock $usernamevpn")) {
			die ("Could not disable account $usernamevpn <br/>");
			}
			//End enable their VPN account
			
			//Edit email body
			$subject = "Account Re-Activated";
			$body = "Hello $first_name,\n\nThank you for choosing VPNFlix to unblock your internet and stay secure.  Your account has successfully been re-activated for 6 months.\n\nConnect to VPN: http://vpnflix.com/choose.php\nClient Area Login: http://vpnflix.com/login.php\n\nIf you have any problems please check out our FAQ articles at http://vpnflix.com/faq.php or you can email us at support@vpnflix.com\n\nEnjoy unblocked and private browsing!\n\nVPNFlix Team\nhttp://vpnflix.com";
		
			
			
			}
			//If they are adding 6 months to their account
			if ($disabled == 0) {
			$exist = mysql_query("SELECT * FROM clients WHERE username='$usernamevpn'");
			$fetchrow = mysql_fetch_array($exist);
			$currentexpiry = $fetchrow['expiry'];
			$updateexpiry = $currentexpiry + (180 * 60 * 60 * 24);
			mysql_query("UPDATE clients SET email='$email', expiry='$updateexpiry', txn_id='$txn_id', payment_date='$payment_date', address_country_code='$country', disabled='0'
			WHERE username='$usernamevpn'");
			
			//Edit email body
			$subject = "6 Months Added";
			$body = "Hello $first_name,\n\nThank you for choosing VPNFlix to unblock your internet and stay secure.  Your account has successfully been added 6 months of time.\n\nConnect to VPN: http://vpnflix.com/choose.php\nClient Area Login: http://vpnflix.com/login.php\n\nIf you have any problems please check out our FAQ articles at http://vpnflix.com/faq.php or you can email us at support@vpnflix.com\n\nEnjoy unblocked and private browsing!\n\nVPNFlix Team\nhttp://vpnflix.com";
		
			}
		
		
		
		
		
		
		
		}
		//End 6 months add 
		
		
		$expiry = 30;
		$expiry = round($expiry);
		$expiry = time() + $expiry * 60 * 60 * 24;
		
		
		$exist = mysql_query("SELECT * FROM clients WHERE username='$usernamevpn'");
		
		$rowcount = mysql_num_rows($exist);
		
		if ($rowcount > 0) {
			$exist = mysql_query("SELECT * FROM clients WHERE username='$usernamevpn'");
			$fetchrow = mysql_fetch_array($exist);
		
			$disabled = $fetchrow['disabled'];
			
			//If they are disabled and renewing
			if ($disabled == 1) {
			
			mysql_query("UPDATE clients SET email='$email', expiry='$expiry', txn_id='$txn_id', payment_date='$payment_date', address_country_code='$country', disabled='0'
			WHERE username='$usernamevpn'");
			
			//Enable their VPN account
			$sshConnection = ssh2_connect(' ', 22);
			if(!$sshConnection) {
			die('Could not connect to VPN server.');
			}
			if(!ssh2_auth_password($sshConnection, 'root', 'jxuxvmfvd5aw')){
			die('VPN server Auth Failed.');
			}
			if (!ssh2_exec($sshConnection, "vpnuserunlock $usernamevpn")) {
			die ("Could not disable account $usernamevpn <br/>");
			}
			//End enable their VPN account
			
			//Edit email body
			$subject = "Account Re-Activated";
			$body = "Hello $first_name,\n\nThank you for choosing VPNFlix to unblock your internet and stay secure.  Your account has successfully been re-activated for another month.\n\nConnect to VPN: http://vpnflix.com/choose.php\nClient Area Login: http://vpnflix.com/login.php\n\nIf you have any problems please check out our FAQ articles at http://vpnflix.com/faq.php or you can email us at support@vpnflix.com\n\nEnjoy unblocked and private browsing!\n\nVPNFlix Team\nhttp://vpnflix.com";
		
			
			
			}
			//If they are adding a month to their account
			if ($disabled == 0) {
			$exist = mysql_query("SELECT * FROM clients WHERE username='$usernamevpn'");
			$fetchrow = mysql_fetch_array($exist);
			$currentexpiry = $fetchrow['expiry'];
			$updateexpiry = $currentexpiry + (30 * 60 * 60 * 24);
			mysql_query("UPDATE clients SET email='$email', expiry='$updateexpiry', txn_id='$txn_id', payment_date='$payment_date', address_country_code='$country', disabled='0'
			WHERE username='$usernamevpn'");
			
			//Edit email body
			$subject = "1 Month Added";
			$body = "Hello $first_name,\n\nThank you for choosing VPNFlix to unblock your internet and stay secure.  Your account has successfully been added 1 month of time.\n\nConnect to VPN: http://vpnflix.com/choose.php\nClient Area Login: http://vpnflix.com/login.php\n\nIf you have any problems please check out our FAQ articles at http://vpnflix.com/faq.php or you can email us at support@vpnflix.com\n\nEnjoy unblocked and private browsing!\n\nVPNFlix Team\nhttp://vpnflix.com";
		
			}
		} else {
		//Client does not exist, create
		mysql_query("INSERT INTO clients (username, password, firstname, lastname, email, expiry, txn_id, payment_date, address_country_code, client_email, disabled)
		VALUES ('$usernamevpn', '$encryptpw', '$first_name', '$last_name', '$email', '$expiry', '$txn_id', '$payment_date', '$country', '$email', '0')");
		
		//Add user to USA/CA VPN ********************************
		$sshConnection = ssh2_connect(' ', 22);
		if(!$sshConnection) {
		die('Could not connect to VPN server.');
		}
		if(!ssh2_auth_password($sshConnection, 'root', 'jxuxvmfvd5aw')){
		die('VPN server Auth Failed.');
		}
		if (!ssh2_exec($sshConnection, "addvpnuser {$usernamevpn} {$passwordvpn}")) {
		die ('Could not add user.');
		}
		//End add user to USA/CA VPN ****************************
		
		
		//Edit email body
		$subject = "Login Info";
		$body = "Hello $first_name,\n\nThank you for choosing VPNFlix to unblock your internet and stay secure.  Your login information is below.\n\nUsername: $usernamevpn\nPassword: $passwordvpn\nConnect to VPN: http://vpnflix.com/choose.php\nClient Area Login: http://vpnflix.com/login.php\n\nIf you have any problems please check out our FAQ articles at http://vpnflix.com/faq.php or you can email us at support@vpnflix.com\n\nEnjoy unblocked and private browsing!\n\nVPNFlix Team\nhttp://vpnflix.com";
		
		
		}
		//Send them a confirmation email with password ****************************************
		 smtpmailer("$email", 'vpnflix@gmail.com', 'VPNFlix', "$subject", "$body");
		//End Send Email ***********************************************************************
		
		
		
		
		
		
		 
		
		
    }
    
} else {
    // manually investigate the invalid IPN
    mail('tompavey@gmail.com', 'Invalid IPN', $listener->getTextReport());
}

// ...





















?>


