<?php
$con = mysql_connect("localhost", "vpnflix", " ") or die(mysql_error()); 

mysql_select_db("vpnflix", $con);


if (isset($_POST['submit'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];

	$sshConnection = ssh2_connect(' ', 22);
	if(!$sshConnection) {
		die('Could not connect to VPN server.');
	}
	if(!ssh2_auth_password($sshConnection, 'root', ' ')){
		die('VPN server Auth Failed.');
	}

	if (!empty($username) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($email)) {
	
		if (!ssh2_exec($sshConnection, "addvpnuser {$username} {$password}")) {
		die ('Could not add user.');
		}
	
	}
	

	

	
}









?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Flixx VPN - Add Client Test</title>
	
	<style type="text/css">
	</style>

</head>





				<h1>Add Client to VPN - Test</h1>
					<form method="post" action="<?php echo $PHP_SELF;?>">
						<table width="300px">
							<tr>
								<th>Data</th>
								<th>Value</th>
							</tr>
							<tr>
								<td><strong>Username:</td></strong></td>
								<td><input type="text" placeholder="username" name="username"/></td>
							</tr>
							<tr>
								<td><strong>Password:</td></strong></td>
								<td><input type="text" placeholder="password" name="password"/></td>
							</tr>
							<tr>
								<td><strong>First Name:</td></strong></td>
								<td><input type="text" placeholder="First Name" name="firstname"/></td>
							</tr>
							<tr>
								<td><strong>Last Name:</td></strong></td>
								<td><input type="text" placeholder="Last Name" name="lastname"/></td>
							</tr>
							<tr>
								<td><strong>Email:</td></strong></td>
								<td><input type="text" placeholder="Email" name="email"/></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" value="Submit" name="submit"/></td>
							</tr>
						</table>
					</form>
					<?php
					if (empty($username)) { echo "You must enter a <b>username</b>.<br/>";  }
					if (empty($password)) { echo "You must enter a <b>password</b>.<br/>";  }
					if (empty($firstname)) { echo "You must enter a <b>first name</b>.<br/>";  }
					if (empty($lastname)) { echo "You must enter a <b>last name</b>.<br/>";  }
					if (empty($email)) { echo "You must enter an <b>email</b>.<br/>";  }
					?>
					
</html>