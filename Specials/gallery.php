<?php
session_start();


require('inc/signup.inc.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Gallery - RCCG Dominion Parish Enugu Province 2</title>
		  <link rel="icon" href="images/logo.png" type="image/x-icon" >
		  <meta name="description" content="Check out our photo gallery from past events, share in our moments."/>
  <meta name="keywords" content="dominion parish enugu,gallery,rrcg gallery,do media,rccgdomedia,rccg Socials,rccg radio,rccg,adeboye,church forums,rccg church forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">

</head>
<body style="font-family:'Raleway', sans-serif;">
	
  <?php
include ('inc/header.inc.php');
include('inc/modal.inc.php');
 include('inc/nav.inc.php');
include('inc/sub-errors.php');
?>
<div class="container-fluid" style="margin-top: 90px;">  
	<div class="row">
		<div class="col-md-12 justify-content-center" align="center"><h2 style="font-family:'Nunito',sans-serif; ">

			<i class="fa fa-image" style="color: green"></i> Photo Gallery</h2></div>

		<div class="col-md-3" style="margin-bottom: 10px;">
			<img src="../images/DSC_0040.JPG" height="100%" width="100%" style="border-radius: 6px;margin-bottom: 10px;">
		</div>
		<div class="col-md-3" style="margin-bottom: 10px;">
			<img src="../images/DSC_0017.JPG" height="100%" width="100%" style="border-radius: 6px;margin-bottom: 10px;">
			
		</div><div class="col-md-3" style="margin-bottom: 10px;">
			<img src="../images/DSC_0043.JPG" height="100%" width="100%" style="border-radius: 6px;margin-bottom: 10px;">
			
		</div><div class="col-md-3" style="margin-bottom: 10px;">
			<img src="../images/DSC_0070.JPG" height="100%" width="100%" style="border-radius: 6px;margin-bottom: 10px;">
			
		</div>
	</div>
</div>





















<?php
include('inc/footer.inc.php')
?>
</body>
</html>