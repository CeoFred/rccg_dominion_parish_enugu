<?php
session_start();


require('inc/signup.inc.php');

?>

<!DOCTYPE html>
<html>
<head>

	<title>Quiz - RCCG Dominion Parish Enugu Province 2</title>
		  <link rel="icon" href="images/logo.png" type="image/x-icon">
		  <meta name="description" content="Take Quiz online, your scores are viewed immedialtly after submision"/>
  <meta name="keywords" content="ask the pastor,do media,rccgdomedia,rccg Socials,rccg radio,rccg,adeboye,church forums,rccg church forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">

</head>
<body style="font-family:'Raleway', sans-serif;background-image: url(images/comming-soon.jpg);margin-bottom: 100px">
	
  <?php
include ('inc/header.inc.php');
include('inc/modal.inc.php');
 include('inc/nav.inc.php');
include('inc/sub-errors.php');
?>

<?php
//include('inc/footer.inc.php')
?>
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(){
        $("#p").toggle();
    });
});
</script>

</body>
</html>