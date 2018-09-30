<!DOCTYPE HTML>
<html>
	<head>
	<title>Sermons - RCCG Dominion Parish</title>
		<link rel="icon" href="images/logo.png" type="image/x-icon">
		<meta name="description" content="Know more about our church, from historical references, spiritual activites and physical chievements." />
		<meta name="keywords" content="rccg,adeboye,church around me,rccg in phase 6,rccg in transekulu,about-us,about dominion parish,dominion-paarish,enugu-province-2,redeemed christian church of god,praise clinic,bible study " />
<?php
include 'inc/header.inc.php';
?>
</head>	
<body>
		
	<?php
include 'inc/maintop.inc.php';
	?>
	<div class="container-wrap">
		<aside id="fh5co-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/DSC_0543.JPG);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-1 text-center slider-text" >
				   				<div class="slider-text-inner" style="background-color: rgba(0,20,190,0.09);margin-top: 50px;">
				   					<h1>Missed out on any sermon?</h1>
				   						<h4>Don't worry,catch all your favourite sermons here.</h4>
										   <form method="POST" action="inc/search.php">
										   <input type='text' name="search" style="border-radius: 7px;height: 40px;display: inline-block;" class="form-control"
										    placeholder="Search sermons">
											</form>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div id="fh5co-sermon">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 text-center fh5co-heading">
					<h2>Latest Sermons</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 text-center animate-box">
					<div class="sermon-entry">
						<div class="sermon" style="background-image: url(images/DSC_0543.JPG);">
							<div class="play">
								<a class="popup-vimeo" href="#!"><i class="icon-play3"></i></a>
							</div>
						</div>
						<h3>Soul Winning</h3>
						<h4><i class="fa fa-user-o"></i>Pstr. John Doe</h4>
						<h4><i class="fa fa-calender"></i>13TH May,2018</h4>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="sermon-entry">
						<div class="sermon" style="background-image: url(images/DSC_0540 (2).JPG);">
							<div class="play">
								<a class="popup-vimeo" href="#!"><i class="icon-play3"></i></a>
							</div>
						</div>
						<h3>God's Plan</h3>
						<h4><i class="fa fa-user-o"></i>Pstr. John Doe</h4>
						<h4><i class="fa fa-calender"></i>13TH May,2018</h4>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="sermon-entry">
						<div class="sermon" style="background-image: url(images/sermon-2.jpg);">
							<div class="play">
								<a class="popup-vimeo" href="#!"><i class="icon-play3"></i></a>
							</div>
						</div>
						<h3>Our World Today</h3>
						<span>Pstr. John Doe</span>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="sermon-entry">
						<div class="sermon" style="background-image: url(images/sermon-1.jpg);">
							<div class="play">
								<a class="popup-vimeo" href="#!"><i class="icon-play3"></i></a>
							</div>
						</div>
						<h3>Soul Winning</h3>
						<span>Pstr. John Doe</span>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="sermon-entry">
						<div class="sermon" style="background-image: url(images/sermon-3.jpg);">
							<div class="play">
								<a class="popup-vimeo" href="#!"><i class="icon-play3"></i></a>
							</div>
						</div>
						<h3>Message From God</h3>
						<span>Pstr. John Doe</span>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="sermon-entry">
						<div class="sermon" style="background-image: url(images/sermon-2.jpg);">
							<div class="play">
								<a class="popup-vimeo" href="#!"><i class="icon-play3"></i></a>
							</div>
						</div>
						<h3>Our World Today</h3>
						<span>Pstr. John Doe</span>
					</div>
				</div>
			</div>
		</div>
		<?php
include 'inc/funfacts.php';
		?>
	</div><!-- END container-wrap -->
<?php
include'inc/footer.inc.php';
?>
	</body>
</html>

