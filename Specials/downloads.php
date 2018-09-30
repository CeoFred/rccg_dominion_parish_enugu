<?php
session_start();


require('inc/signup.inc.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Downloads - RCCG Dominion Parish Enugu Province 2</title>
		  <link rel="icon" href="images/logo.png" type="image/x-icon" class="animated tada infinite">
		  <meta name="description" content="Download audios,videos, gifs, books, and many more."/>
  <meta name="keywords" content="download rccg bulletin,dominion parish downlaod,downloads,rccg download,dominion parish download,download message from dominion parish,rccg radio,rccg,adeboye,church forums,rccg church forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">

</head>
<body style="font-family:'Raleway', sans-serif;backg">
	
  <?php
include ('inc/header.inc.php');
include('inc/modal.inc.php');
 include('inc/nav.inc.php');
include('inc/sub-errors.php');
?>

<div class="container-fluid" style="margin-top: 80px;">
  <div class="row">
    <div class="col-md-12">
      <h2 align="center">Downloads<i class="fa fa-download"></i></h2>
    
      <div align="center">
      Sort by Category<select name="category" align="center">
        <option value="all" class="form-control" style="width: 200px;">All</option>
    <option value="books">Books</option>
    <option value="audios">Audios</option>
    <option value="videos">Videos</option>
      </select>
    </div>
    </div>
  </div>
</div>









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

<?php
//include('inc/footer.inc.php')
?>
</body>
</html>