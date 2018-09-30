<?php
session_start();


if (isset($_GET['token'])) {

	require 'inc/dbh.php';
	$token = mysqli_real_escape_string($conn, $_GET['token']);
$email = mysqli_real_escape_string($conn, $_GET['email']);
// echo $token;
$sql = "SELECT token FROM subscriberss WHERE token = '$token' AND isconfirmed = 0;";
if($query = mysqli_query($conn, $sql)){
	 // echo "selected";
if(mysqli_num_rows($query) > 0){
$sqli = "UPDATE subscriberss SET isconfirmed = 1 WHERE token = '$token';";
if($query2 = mysqli_query($conn, $sqli)){
	$sqlii = "UPDATE subscriberss SET token = '' WHERE token = '$token';";
	if($query3 = mysqli_query($conn, $sqlii)){
		$_SESSION['sub_success'] = '<h1>Congratulations!</h1>'.'<br>'.'You have successfully subscribed 


		to our newsletter services please continue to'.'<br>'.'<a href="index?subscription-success" class="btn btn-success">Login</a>';
	}
}

}
else{
$_SESSION['sub_error'] = 'Sorry, something went wrong';
}

}


}else{
	header("Location: index?Hmmmm!!");
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Subscription Verification | RCCG Dominion Parish Enugu</title>
  
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <?php 
    include('inc/header.inc.php');
     ?>

</head>
<body style="font-family:'Raleway', sans-serif;">
	  <?php
include('inc/modal.inc.php');
  ?>

	<?php
include('inc/nav.inc.php');
	?>


<div class="container">
	
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
</div>

<?php

include('inc/footer.inc.php');
?>
</body>
</html>
