<?php 
//*****************  Cron.php ***************************
//Cronned everday to disable expired accounts ***********




//Let's connect to the fucking database
mysql_connect("localhost", "vpnflix", " ") or die(mysql_error()); 
mysql_select_db("vpnflix") or die(mysql_error());
 
//Select all the clients and check their expiry time
$selectall = mysql_query("SELECT * FROM clients");
	while($row = mysql_fetch_array($selectall)) {
	
	$now = time();
	$expiry = $row['expiry'];
	$username = $row['username'];
	$disabled = $row['disabled'];
	
	if ($disabled = 0) {
	
		if ($now > $expiry) {
			mysql_query("UPDATE clients SET disabled='1'
			WHERE username='$username'");
			
			//Disable their VPN account
			$sshConnection = ssh2_connect(' ', 22);
			if(!$sshConnection) {
			die('Could not connect to VPN server.');
			}
			if(!ssh2_auth_password($sshConnection, 'root', 'jxuxvmfvd5aw')){
			die('VPN server Auth Failed.');
			}
			if (!ssh2_exec($sshConnection, "vpnuserlock $username")) {
			die ("Could not disable account $username <br/>");
			}
			//End disable their VPN account
			echo "Disabled $username <br/>";
			
		
		
		
		}
	}
	
	}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 ?>