<?php
$mailTo = 'support@vpnflix.com';
$name = htmlspecialchars($_POST['Name']);
$mailFrom = htmlspecialchars($_POST['Email']);
$subject = 'Message from your VPNFlix';
$message_text = htmlspecialchars($_POST['Message']);

$message =  'From: '.$name.' --- Email: '.$mailFrom.' --- Message: '.$message_text;

mail($mailTo, $subject, $message);
?>