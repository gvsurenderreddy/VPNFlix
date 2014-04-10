<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://www.w3.org/2005/10/profile">
<link rel="icon" 
      type="image/png" 
      href="images/services-icons/global_telecom.png" />
<meta charset="UTF-8" />
<title>VPNFlix | Surf the Web Anonymously</title>
<meta name="description" content="Unblock your internet now.  Surf the web securely and freely." /> 
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
jQuery(document).ready(function() {
	jQuery('#slider').cycle({
			timeout:         15000,  // milliseconds between slide transitions
			pager:  '#slider-nav',
			fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		});
});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34484742-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body id="home-page">
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
        <li class="current_page_item"><a href="index.php">Home</a></li>
        <li><a href="why.php">Why Choose VPNFlix?</a></li>
        <li><a href="what-is-a-vpn.php">What is a VPN?</a></li>
        <li><a href="faq.php">FAQ and How-to</a></li>
		<li><a href="pricing.php">Features</a>
        <li><a href="contact.php">Contact Us</a></li>
		<li><a href="trial.php">Free Trial</a>
		<li><a href="login.php"><font color="#e60707"><b><?php if(isset($_COOKIE['ID_my_site'])) {echo $_COOKIE['ID_my_site'];}else{echo "Client Login";}  ?></b></font></a></li>
      </ul>
      <!-- navigation END here -->
      <!-- slider-holder START here -->
      <div id="slider-holder">
        <div id="slider-nav-container">
          <div id="slider-nav"></div>
          <img src="images/slider-nav-right.png" alt="" style="float:left;" />        </div>
        <div id="slider"> 
           <!-- slide1 START here -->
           <div class="slide">
             <div class="inside">
                 <img src="images/slider-icons/network.png" alt="" class="slide-img" width="200" height="200" />
                 <h2>Surf the Web Anonymously</h2>
                 <p>Don't be afraid to download your favorite movie or album. Use VPNFlix to protect yourself when downloading torrents and browsing the internet. While connected to our virtual private network (VPN) you become anonymous online. Connect to our Canadian servers for best protection.</p>
                 <a href="why.php" class="big-btn grey">Learn More</a>
                 <a href="pricing.php" class="big-btn red">Buy Now $4/month</a>
             </div>
           </div>
           <!-- slide1 END here -->
           <!-- slide2 START here -->
           <div class="slide">
             <div class="inside">
                 <img src="images/slider-icons/lock.png" alt="" class="slide-img" />
                 <h2>Secure Your Internet Connection</h2>
                 <p>Do you use online banking or send personal information through the Internet?  Your information could be at risk to hackers who can see the data pass through the Internet.  While connected to your VPNFlix account all your data will be encrypted so hackers have no chance at seeing your data.</p>
                 <a href="why.php" class="big-btn grey">Learn More</a>
                 <a href="pricing.php" class="big-btn red">Buy Now $4/month</a>             </div>
           </div>
           <!-- slide2 END here -->
           <!-- slide3 START here -->
           <div class="slide">
             <div class="inside">
                 <img src="images/slider-icons/help.png" alt="" class="slide-img" width="200" height="200" />
                 <h2>World Class Customer Support</h2>
                 <p>Our number one goal is to make sure you are satisfied with our service.  If you have any problems or issues at all please do not hesitate to shoot us an E-mail.  We will respond as soon as possible.  Don't forget to check our tutorials and FAQ pages to see if you can find a resolution.</p>
                 <a href="why.php" class="big-btn grey">Learn More</a>
                 <a href="pricing.php" class="big-btn red">Buy Now $4/month</a>             </div>
           </div>
           <!-- slide3 END here -->
           <!-- slide4 START here -->
           <!-- slide4 END here -->
        </div>
      </div>
      <!-- slider-holder END here -->
    </div>
    <!-- container END here -->
  </header>
  <!-- header END here -->
  <!-- hosting-plans START here -->
  <div id="hosting-plans">
    <!-- container START here -->
    <div class="container">
      <!-- plan1 START here -->
      <div class="plan">
        <div class="title">
          <h4>Unblock Your Internet</h4>
        </div>
        <div class="content">
            <div class="price">
              <div class="inside">
              $4<br>
              <span>/month</span>              </div>
              <a href="pricing.php" class="sml-btn red">Order Now!</a>            </div>
            <ul>
              <li>Watch Netflix, Youtube</li>
              <li>Freedom over your internet</li>
              <li>Browse Facebook and Twitter</li>
			  <li>Unblock work & school internet</li>
            </ul>
          </div>
      </div>
      <!-- plan1 END here -->
      <!-- plan2 START here -->
      <div class="plan">
        <div class="title">
          <h4>Lightning Fast Connection</h4>
        </div>
        <div class="content">
            <div class="price">
              <div class="inside">
              $4<br>
              <span>/month</span>              </div>
              <a href="pricing.php" class="sml-btn red">Order Now!</a>            </div>
            <ul>
              <li>Unlimited bandwidth</li>
              <li>Utilizes Cloud Servers</li>
              <li>OpenVPN Technology</li>
			  <li>Blazing Speeds</li>
            </ul>
          </div>
      </div>
      <!-- plan2 END here -->
      <!-- plan3 START here -->
      <div class="plan no-margin">
        <div class="title">
          <h4>Download Anonymously</h4>
        </div>
        <div class="content">
            <div class="price">
              <div class="inside">
              $4<br>
              <span>/month</span>              </div>
              <a href="pricing.php" class="sml-btn red">Order Now!</a>            </div>
            <ul>
              <li>Download Torrents</li>
              <li>256 Bit Encryption</li>
              <li>Enjoy Internet Privacy</li>
			  <li>Protect Your Information</li>
            </ul>
          </div>
      </div>
      <!-- plan3 END here -->
    </div>
    <!-- container END here -->
  </div>
  <!-- hosting-plans START here -->
  <!-- content START here -->
  <div id="content">
    <!-- container START here -->
    <div class="container">
     <div id="home-colums">
      <!-- colum1 START here -->
      <div class="colum">
        <h3>Welcome to VPNFlix</h3>
        <p>Hello and welcome to VPNFlix.  My name is Tom and I started VPNFlix to offer an affordable VPN solution for people who live in the United States and abroad.  Most people browse the Internet unsecurely and restricted.  Most times internet providers are throttling your connection speed and watching how you surf the internet. While connected to VPNFlix your internet connection becomes encrypted.  While encrypted you prevent hackers and other prying eyes from seeing your internet data.  Also while connected you will unthrottle your provider's connection so you can download and upload at higher speeds.  
		<br/><br/>
		If you do online banking, send important data through the internet, download torrents, or want to browse unrestricted then you need to have a VPN.  VPNFlix makes it affordable and easy to do.
		</p>
        <p><a href="why.php" class="big-btn red">Learn More</a></p>
      </div>
      <!-- colum1 END here -->
      <!-- colum2 START here -->
      <div class="colum">
        <h3>Why VPNFlix?</h3>
        <ul id="services-list">
          <li>
            <img src="images/services-icons/lightning.png" alt="" class="icon" />
            Lightning fast connections perfect for streaming, downloading and browsing.          </li>
          <li>
            <img src="images/services-icons/green.png" alt="" class="icon" />
            100% green.  We utilize only the resources we need via cloud servers.          </li>
          <li>
            <img src="images/services-icons/events.png" alt="" class="icon" />
            Enjoy unblocked and unrestricted Internet.         </li>
          <li>
            <img src="images/services-icons/headphone.png" alt="" class="icon" />
            Superb support is key to any business and is our #1 priority.          </li>
          <li>
            <img src="images/services-icons/coins.png" alt="" class="icon" />
            Affordable price and supreme service makes VPNFlix hard to beat.         </li>
		<li>
            <img src="images/services-icons/cart.png" alt="" class="icon" />
            Hassle free. No subscriptions or hidden fees. Add time whenever you want easily.   </li>
		<li>
            <img src="images/services-icons/creditcards.png" alt="" class="icon" />
            Pay securely with Paypal.  Credit cards accepted.   </li>
		<li>
            <img src="images/services-icons/shield.png" alt="" class="icon" />
            Use VPNFlix to protect your Internet from hackers.   </li>
        </ul>
      </div>
      <!-- colum2 END here -->
      <!-- colum3 START here -->
      <div class="colum no-margin">
        <h3>Unblock ISP Filters</h3>
        
          <p>Your Internet provider is throttling your connection.  While connected to VPNFlix your Internet becomes encrypted and unthrottled so you can enjoy faster Internet speeds. Check out these screenshots I did while testing.  You can notice my provider is throttling my connection without the VPN. </br><br/>
		  Without VPNFlix:
		  <img src="images/withoutVPN.png" /> <br/>
		  With VPNFlix:
		  <img src="images/withVPN.png" />
		  
		  </p>
      </div>
      <!-- colum3 END here -->
     </div>
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
        <li><a href="contact.php">Contact Us</a></li>
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
      <p class="alignleft">&copy; 2013 All Rights Reserved.</p>
      <ul id="social-list" class="alignright">
        <li><a href="#" rel="tipsy" title="Monthly Newsletter"><img src="images/social-icons/email.png" alt="" /></a></li>
        <li><a href="http://www.facebook.com/VPNFlix" rel="tipsy" title="Facebook"><img src="images/social-icons/facebook.png" alt="" /></a></li>
        <li><a href="http://twitter.com/vpnflix" rel="tipsy" title="Twitter"><img src="images/social-icons/twitter.png" alt="" /></a></li>
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