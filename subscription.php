<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscription Verified</title>
<?php
include 'inc/header.inc.php';
 ?>
</head>
<body style="background:url(images/body-bg.png);background-position:cover;">
<?php
if (isset($_GET['token'])) {

	require 'inc/dbh.php';
	$token = mysqli_real_escape_string($conn, $_GET['token']);
$email = mysqli_real_escape_string($conn, $_GET['email']);

$sql = "select token from subscribers where token = '$token' and email = '$email' and isconfirmed = 0; ";
$query = mysqli_query($conn, $sql);
$result = mysqli_num_rows($query);
if ($row = mysqli_fetch_assoc($query) > 0)
 {
	// echo "ok";
	if(mysqli_query($conn,$sql = "UPDATE subscribers SET isconfirmed='1' WHERE email = '$email';")){
		echo "successfully updated table";
	}else{
		echo "noo";
	}

}
 else{
	 $_SESSION['sub_error'] = 'Email has alredy been verifired, arre you sure you
	 are viewing the right page??';
	 // header("Location: index?idiot");
	 // exit();
 }
}
//restrict entry to this page
else{
	header("Location: 404-Error");
	exit();
}
?>

<?php if(isset($_SESSION['sub_error'])){ ?>
				<div >

					<?php echo $_SESSION['sub_error'];unset($_SESSION['sub_error']); ?>
				</div>
			<?php
				}
			?>

</body>
</html>
