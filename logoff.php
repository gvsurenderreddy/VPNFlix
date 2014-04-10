<?php 

 // Connects to your Database 

 mysql_connect("localhost", "vpnflix", " ") or die(mysql_error()); 

 mysql_select_db("vpnflix") or die(mysql_error()); 

 


 $past = time() - 100; 

 //this makes the time in the past to destroy the cookie 

 setcookie(ID_my_site, gone, $past); 

 setcookie(Key_my_site, gone, $past); 

 header("Location: login.php"); 

 ?>  

