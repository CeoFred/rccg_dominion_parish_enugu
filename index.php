<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
  <head>
  <title>RCCG Dominion Parish, Enugu Province 2</title>
  <link rel="icon" href="images/logo.png" type="image/x-icon" class="animated tada infinite">
  <meta name="description" content="Welcome to the official website of RCCG dominion parish Enugu Province 2. Jesus Christ the same yesterday today and foreverr" />
  <meta name="keywords" content="dominion-Parish,rccg province 2,province 2,province 2 enugu,rccg,dominion parish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />

  <?php
include'inc/header.inc.php';
  ?>
  </head>
  <body style="font-family: 'Raleway', sans-serif;">

<?php if(isset($_SESSION['sub_error'])){ ?>
  <div class="alert alert-danger animated tada alert-dismissible"
   style="text-align: center;font-size:2.0em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 100%;
  height: 400px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close"
   style="font-size: 30px;color: black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-down" style="font-size: 170px;"></i>
  <br>
  <?php echo $_SESSION['sub_error'];unset($_SESSION['sub_error']); ?>
  <div class="alert alert-footer fixed bottom" style="text-align: center;">Powered by Do-media</div>
  </div>
  <?php
  }
  ?>
<?php
include 'inc/maintop.inc.php';
?>

<?php if(isset($_SESSION['sub_success'])){ ?>
  <div class="alert alert-success animated tada alert-dismissible" style="text-align: center;font-size:2.0em;padding:10px;color: white;
  position: fixed;
  left: 20px;
  top: 20px;
  right: 40px;
  bottom: 20px;
  width: 100%;
  height: 400px;
  z-index: 9999;">

  <a href="#" class="close" data-dismiss="alert" aria-label="close" style="font-size: 30px;color: black;margin-right: 40px;">&times;</a><i class="fa fa-thumbs-up" style="font-size: 70px;"></i>
  <br>
  <?php echo $_SESSION['sub_success'];unset($_SESSION['sub_success']); ?>
  <div class="alert alert-footer fixed bottom" style="text-align: center;">Powered by Do-media</div>
  </div>
  <?php
  }
  ?>
  <div class="container-wrap">
  <aside id="fh5co-hero">
  <div class="flexslider">
  <ul class="slides">
     	<li style="background-image: url(images/DSC00062.JPG);">
     		<div class="overlay"></div>
     		<div class="container-fluid">
     			<div class="row">
     			<div class="col-md-6 col-md-offset-3 text-center">
     				<div class="slider-text">
     				<div class="slider-text-inner">
     					<h1>Living &amp; Sharing the Gospel of God</h1>
  <p><a class="btn btn-primary btn-demo popup-vimeo" href="https://youtube.com/dominionparish"> <i class="fa fa-video-camera"></i> Watch Video</a> <a class="btn btn-primary btn-learn">Read More<i class="icon-arrow-right3"></i></a></p>
     				</div>
     				</div>
     			</div>
     		</div>
     		</div>
     	</li>
     	<li style="background-image: url(images/DSC_0543.JPG);">
     		<div class="overlay"></div>
     		<div class="container-fluid">
     			<div class="row">
     			<div class="col-md-6 col-md-offset-3 text-center">
     				<div class="slider-text">
     				<div class="slider-text-inner">
     					<h1>Tell The World About His coming</h1>
  <p><a class="btn btn-primary btn-demo popup-vimeo" href="https://Soundcloud.com/"> <i class="fa fa-soundcloud"></i>Listen on Soundcloud</a> <a class="btn btn-primary btn-learn">Read More <i class="icon-arrow-right3"></i></a></p>
     				</div>
     			</div>
     			</div>
     		</div>
     		</div>
     	</li>
     	<li style="background-image: url(images/DSC_0528.JPG);">
     		<div class="overlay"></div>
     		<div class="container-fluids">
     			<div class="row">
     			<div class="col-md-6 col-md-offset-3 text-center">
     				<div class="slider-text">
     				<div class="slider-text-inner text-center">
     					<h1>Keep the Fire burning,Know More About Jesus</h1>
  <p><a class="btn btn-primary btn-demo popup-vimeo" href="https://youtube.com/dominionparish"><i class="fa fa-video-camera"></i> Watch Video</a> <a class="btn btn-primary btn-learn">Read more<i class="icon-arrow-right3"></i></a></p>
     				</div>
     			</div>
     			</div>
     		</div>
     		</div>
     	</li>
     	<li style="background-image: url(images/DSC_0564.JPG);">
     		<div class="overlay"></div>
     		<div class="container-fluids">
     			<div class="row">
     			<div class="col-md-6 col-md-offset-3 text-center">
     				<div class="slider-text">
     				<div class="slider-text-inner text-center">
     					<h1>Rejoice and Be exceeding Glad: for great is your reward in heaven.</h1>
  <p> <a class="btn btn-primary btn-learn">Read more<i class="icon-arrow-right3"></i></a></p>
     				</div>
     			</div>
     			</div>
     		</div>
     		</div>
     	</li>
    	</ul>
    	</div>
  </aside>
  <div id="fh5co-intro">
  <div class="row animate-box">
  <div class="col-md-12 col-md-offset-0 text-center">
  <h2>Jesus Christ the same,yesterday, today and forever!Heb 13:8</h2>
  <span>We are open Sunday to Monday</span>
  </div>
  </div>
  </div>
  <hr>
  <?php
include 'inc/funfacts.php';
  ?>
  <div id="fh5co-services" class="fh5co-light-grey" style="font-family: 'Raleway', sans-serif;">
  <div class="row animate-box">
  <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
  <h2>Services</h2>
  <p>	We bring to you the gospel through various voluntery services.</p>
  </div>
  </div>
  <div class="row">
  <div class="col-md-4 animate-box">
  <div class="services">
  <a href="#" class="img-holder"><img class="img-responsive" src="images/DSC_0672.JPG" alt=""></a>
  <div class="desc">
  <h3><a href="#">Annointing</a></h3>
  <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>

  <button class="btn btn-success">Read More</button>
  </div>
  </div>
  </div>
  <div class="col-md-4 animate-box">
  <div class="services">
  <a href="#" class="img-holder"><img class="img-responsive" src="images/DSC_0017.JPG" alt=""></a>
  <div class="desc">
  <h3><a href="#">Biblical Counseling</a></h3>
  <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>

  <button class="btn btn-success">Read More</button>
  </div>
  </div>
  </div>
  <div class="col-md-4 animate-box">
  <div class="services">
  <a href="#" class="img-holder"><img class="img-responsive" src="images/DSC_0607.JPG" alt=""></a>
  <div class="desc">
  <h3><a href="#">Medical Outreach</a></h3>
  <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
  <button class="btn btn-success">Read More</button>
  </div>
  </div>
  </div>
  </div>
  </div>

  <div id="fh5co-sermon" style="font-family: 'Raleway', sans-serif;">
  <div class="row animate-box">
  <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
  <h2>Latest Sermons<i class="fa fa-circle-o"></i></h2>
  <!-- <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p> -->
  </div>
  </div>
  <div class="row">
  <div class="col-md-4 text-center animate-box">
  <div class="sermon-entry">
  <div class="sermon" style="background-image: url(images/DSC_0502.JPG);">
  <div class="play">
  <a class="popup-vimeo" href=""><i class="icon-play3"></i></a>
  </div>
  </div>
  <h3>Soul Winning</h3>
  <span>Pstr.Mrs. N. Alukwu</span>
  <i class="fa fa-calender"></i>
  </div>
  </div>
  <div class="col-md-4 text-center animate-box">
  <div class="sermon-entry">
  <div class="sermon" style="background-image: url(images/DSC00062.JPG);">
  <div class="play">
  <a class="popup-vimeo" href=""><i class="icon-play3"></i></a>
  </div>
  </div>
  <h3>Message From God</h3>
  <span>Pstr. John Doe</span>
  </div>
  </div>
  <div class="col-md-4 text-center animate-box">
  <div class="sermon-entry">
  <div class="sermon" style="background-image: url(images/DSC_0540.JPG);">
  <div class="play">
  <a class="popup-vimeo" href="vids/Hawaiian lava flows ‘faster than a turtle’.mp4"><i class="icon-play3"></i></a>
  </div>
  </div>
  <h3>Our World Today</h3>
  <span>Pstr. John Doe</span>
  </div>
  </div>
  </div>
  </div>
  <div id="fh5co-bible-verse">
  <div class="overlay"></div>
  <div class="row">
  <div class="col-md-10 col-md-offset-1">
  <div class="row animate-box">
  <div class="owl-carousel owl-carousel-fullwidth">
  <div class="item">
  <div class="bible-verse-slide active text-center">
  <blockquote>
  <p>&ldquo;For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life.&rdquo;</p>
  <span>John 3:16</span>
  </blockquote>
  </div>
  </div>
  <div class="item">
  <div class="bible-verse-slide active text-center">
  <blockquote>
  <p>&ldquo;The LORD [is] my strength and my shield; my heart trusted in him, and I am helped: therefore my heart greatly rejoiceth; and with my song will I praise him.&rdquo;</p>
  <span>Psalms 28:7</span>
  </blockquote>
  </div>
  </div>
  <div class="item">
  <div class="bible-verse-slide active text-center">
  <blockquote>
  <p>&ldquo;And we have known and believed the love that God hath to us. God is love; and he that dwelleth in love dwelleth in God, and God in him.&rdquo;</p>
  <span>1 John 4:16</span>
  </blockquote>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <div id="fh5co-events" style="font-family: 'Raleway', sans-serif;">
  <div class="row animate-box">
  <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
  <h2>Upcoming Events</h2>
  </div>
  </div>
  <div class="row">
  <div class="col-md-4 animate-box">
  <div class="events-entry">
  <span class="date">March 10, 2018</span>
  <h3><a href="#">Let's go a fishing</a></h3>
  <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
  <a href="#">Read More <i class="icon-arrow-right3"></i></a>
  </div>
  </div>
  <div class="col-md-4 animate-box">
  <div class="events-entry">
  <span class="date">March 20, 2018</span>
  <h3><a href="#">Welfare weekend</a></h3>
  <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
  <a href="#">Read More <i class="icon-arrow-right3"></i></a>
  </div>
  </div>
  <div class="col-md-4 animate-box">
  <div class="events-entry">
  <span class="date">March 30, 2018</span>
  <h3><a href="#">Thanksgiving Service</a></h3>
  <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
  <a href="#">Read More <i class="icon-arrow-right3"></i></a>
  </div>
  </div>
  </div>
  </div>
  <div id="fh5co-news" class="fh5co-light-grey" style="font-family: 'Raleway', sans-serif;">
  <div class="row animate-box">
  <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
  <h2>Latest Motivationals</h2>
  <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
  </div>
  </div>
  <div class="row">
  <div class="col-md-3 animate-box">
  <div class="news">
  <a href="#" class="img-holder"><img class="img-responsive" src="images/img-1.jpg" alt=""></a>
  <div class="desc">
  <span class="date">March 30, 2017</span>
  <h3><a href="#">Live News</a></h3>
  <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
  <a href="#">Read More <i class="icon-arrow-right3"></i></a>
  </div>
  </div>
  </div>
  <div class="col-md-3 animate-box">
  <div class="news">
  <a href="#" class="img-holder"><img class="img-responsive" src="images/img-3.jpg" alt=""></a>
  <div class="desc">
  <span class="date">March 30, 2017</span>
  <h3><a href="#">Biblical Counseling</a></h3>
  <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
  <a href="#">Read More <i class="icon-arrow-right3"></i></a>
  </div>
  </div>
  </div>
  <div class="col-md-3 animate-box">
  <div class="news">
  <a href="#" class="img-holder"><img class="img-responsive" src="images/img-2.jpg" alt=""></a>
  <div class="desc">
  <span class="date">March 30, 2017</span>
  <h3><a href="#">Helping Children</a></h3>
  <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
  <a href="#">Read More <i class="icon-arrow-right3"></i></a>
  </div>
  </div>
  </div>
  <div class="col-md-3 animate-box">
  <div class="news">
  <a href="#" class="img-holder"><img class="img-responsive" src="images/img-4.jpg" alt=""></a>
  <div class="desc">
  <span class="date">March 30, 2017</span>
  <h3><a href="#">Helping Children</a></h3>
  <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
  <a href="#">Read More <i class="icon-arrow-right3"></i></a>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div><!-- END container-wrap -->
<?php

include 'inc/footer.inc.php';
?>

  </body>
</html>
