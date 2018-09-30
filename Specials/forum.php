<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Forums - RCCG Dominion Parish</title>
	  <meta name="description" content="Welcome to our interactive forum, read very inspirational topics, comment or add a reply." />
    <link rel="icon" href="images/logo.png" type="image/x-icon" class="animated tada infinite">
  <meta name="keywords" content="rccg forum,rccg discussion,rccg radio,rccg,adeboye,church forums,rccg church 
  forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">
	<?php
include('inc/header.inc.php');
	?>
</head>
<body style="font-family:'Raleway', sans-serif;background: url(images/bg.jpeg);background-size: cover;background-repeat: no-repeat;">
  <?php
include('inc/modal.inc.php');
  ?>

<?php
include('inc/sub-errors.php');
?>
<?php
include('inc/nav.inc.php');
?>


<!-- <div class="container-fluid">
	<div class="row">
		<div class="col-12 col-sm-12 d-md-none" style="margin-top: 50px;">
<img class="image-responsive" src="images/forum.jpg" style="width: 100%">
		</div>

		<div class="col-12 col-sm-12 mb-4 d-none d-md-block" style="margin-top: 50px;">
<img class="image-responsive" src="images/forum.jpg" style="width: 100%;height: 500px;">
		</div>
	</div>
</div>
 -->
<div align="center" style="margin-top: 75px;">
	<h2>Select a Forum to continue</h2>
</div>
<div class="container" style="margin-bottom: 100px;">
	<div class="row">
		<div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 col-xl-3" style="background: url(../images/DSC00082.JPG);height: 200px;background-size: cover;background-repeat: no-repeat;border-radius: 6px;margin-top: 30px;">
				<div style="background-color: rgba(164,38,49,0.8);font-size: 20px;padding: 20px;">Youth's Forum</div>
				<a href="youths-forum" class="btn btn-success" style="margin-top: 30px;">Continue >></a>
				<br>
				<br>
				<br>
				<div>
					<b class="d-md-none" style="color: white;">NB: Access is granted to only youths.</b>
			        
					<b class="mb-4 d-none d-md-block">NB: Access is granted to only youths.</b>
			
				</div>
				</div>
		<div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 col-xl-3" style="background: url(../images/DSC_0536.JPG);height: 200px;background-size: cover;background-repeat: no-repeat;margin-top: 30px;">
          
				<div style="background-color: rgba(164,38,49,0.8);font-size: 20px;padding: 20px;">Adult's Forum</div>
				<a href="adults-forum" class="btn btn-success" style="margin-top: 30px;">Continue >></a>
				<br>
				<br>
				<br>
				<div>
					<b class="d-md-none" style="color: white;">NB: Access is granted to only Adults.</b>
			        
					<b class="mb-4 d-none d-md-block">NB: Access is granted to only Adults.</b>
			
				</div>
				
       </div>
		<div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 col-xl-3" style="background: url(../images/DSC_0017.JPG);height: 200px;background-size: cover;background-repeat: no-repeat;margin-top: 30px;border-radius: 6px;">
			
				<div style="background-color: rgba(164,38,49,0.8);font-size: 20px;padding: 20px;">General Forum</div>
				<a href="general-forum" class="btn btn-success" style="margin-top: 30px;">Continue >></a>
			<br>
				<br>
				<br>
				<div>
					<b class="d-md-none" style="color: white;">NB: Access is granted to Everyone.</b>
			        
					<b class="mb-4 d-none d-md-block">NB: Access is granted to only Everyone.</b>
			
				</div>
				
		</div>
		<div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 col-xl-3" style="background: url(../images/DSC_02742.JPG);height: 200px;background-size: cover;background-repeat: no-repeat;border-radius: 6px;margin-top: 30px;">
			
				<div style="background-color: rgba(164,38,49,0.8);font-size: 20px;padding: 20px;">Teen's Forum</div>
				<a href="teens-forum" class="btn btn-success" style="margin-top: 30px;">Continue >></a>
				<br>
				<br>
				<br>
				<div>
					<b class="d-md-none" style="color: white;">NB: Access is granted to only Teenagers.</b>
			        
					<b class="mb-4 d-none d-md-block">NB: Access is granted to only Teenagers.</b>
			
				</div>
		</div>
	</div>
</div>








<?php
include('inc/footer.inc.php');
?>
</body>
</html>