<?php
session_start();
$email = '';
$name = '';
if (isset($_POST['submit'])) {
	require('inc/dbh.php');
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$request = mysqli_real_escape_string($conn, $_POST['request']);
	if (empty($name)) {
	$_SESSION['contact_error_name'] = 'This Field cannot be left Empty';
	}if (empty($email)) {
	$_SESSION['contact_error_email'] = 'This Field cannot be left Empty';
	}if (empty($request)) {
		$_SESSION['contact_error_message'] = 'This Field cannot be left Empty';
	}else{

		//send  prayer to pastor
		 $message = "
 <div class='container'>
    <div class='row'>
      <div class='col' align='center' style='color:black;'>
<b>Hello,admin</b>
<br>
<p>You have a new contact request query,details are as follows.</p>
<br>
Name: $name
<p>Email: $email</p>
<p>Prayer Request: $Request</p>
<br>
      </div>
    </div>
  </div>
";

require_once('PHPMailer/PHPMailerAutoload.php');
//makes use of php mailer library
 
define ('gmailUserame','rccg.dpe2@gmail.com');
define ('gmailPassword','messilo18');
 
//uses gmail as mail server hence you need to provide your credentials
 
global $error;
 
function smtpmailer($to, $from, $from_name, $subject, $body) {
   
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
  $mail->isHTML(true);
    
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
/*
  this lines of code is unnecessary if you are running on a secure server
*/
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
 
    /*
 
     unnecessary code on secure server ends here
 
    */
);
 
    $mail->Username = gmailUserame;  
    $mail->Password = gmailPassword;          
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        
 $_SESSION['prayer_error'] = 'Sorry,There was an error while sending your request to the admins';
    } else {
 $_SESSION['prayer_success'] = 'Your Request was successfully sent to the admins.';
    require('inc/dbh.php');

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$request = mysqli_real_escape_string($conn, $_POST['request']);

    	$sql = "INSERT INTO contact (sender_name,sender_email,sender_message) VALUES ('$name','$email','$request');";
    	mysqli_query($conn, $sql);
    }
}
 
//Call method
 smtpmailer('rccg.dpe2@gmail.com',$email,'RCCG Dominion Media Department','NEW CONTACT REQUEST',$message);
 //use whatever mail you like


	}

}

require('inc/signup.inc.php');

?>
<!DOCTYPE HTML>
<html>
	<title>Contact Us - RCCG Dominion Parish Enugu Province 2</title>
	<link rel="icon" href="images/logo.png" type="image/x-icon">
		  <link rel="icon" href="images/logo.png" type="image/x-icon" class="animated tada infinite">
		  <meta name="description" content="Get closer to us, use our easy contact center and send us a message we could be glad to help."/>
  <meta name="keywords" content="contact us,phone rccg,contact rccg,rccg phone number,rccg help line,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">


<?php

include 'inc/header.inc.php';

?>

	</head>
    <body style="background-image: url(images/bg.jpeg);background-size:cover;background-repeat: no-repeat;font-family:'Raleway', sans-serif;">
  <?php
include('inc/modal.inc.php');
  ?>

<?php
include'inc/nav.inc.php';
?>

<?php
include('inc/sub-errors.php');
?>
<style type="text/css">
	.fa{
		color: green;
	}a{
		color: black;
	}
</style>

<div class="container" style="margin-top: 90px">
		<div >
			<div class="row ">
				<div class="col-md-12 text-center">
					<h2>Contact us</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<h3>Our Address</h3>
					<ul style="list-style-type: none;">
						<li style="font-size: 20px;"><i class="fa fa-location-arrow"></i>No 13 Christ the king Avenue, Off Emyson Guest Inn, TransEkulu,Enugu.</li>
						<li style="font-size: 20px;"><i class="fa fa-phone"></i>+ 234 *** *** ***</li>
						<li><i class="fa fa-envelope-open"></i><a href="mail-to:">rccg.dpe2@gmail.com</a></li>
						<li><i class="fa fa-globe"></i><a href="">www.dpe2.com.ng</a></li>
					</ul>
				</div>
				<div class="col-sm-12 col-md-3" align="center" style="margin-left:20px;padding: 10px;border-radius: 46px;box-shadow: 9px;">
					<div class="row">
<form method="post" action="contact.php" class="md-form" style="border: 4px solid lightblue;border-radius: 46px;box-shadow: 9px;padding: 20px;">
						<div>
							<div class="form-group">
								<input type="text" value="<?php echo $name; ?>" name="name" class="form-control" placeholder="Name">
							</div>

<?php if(isset($_SESSION['contact_error_name'])){ ?>
  <small style="text-align: center;color: red;">

  <?php echo $_SESSION['contact_error_name'];unset($_SESSION['contact_error_name']); ?>
  </small>
  <?php
  }
  ?>
						</div>

						<div >
							<div class="form-group">
								<input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email">
							</div>
						</div>

<?php if(isset($_SESSION['contact_error_email'])){ ?>
  <small style="text-align: center;color: red;">

  <?php echo $_SESSION['contact_error_email'];unset($_SESSION['contact_error_email']); ?>
  </small>
  <?php
  }
  ?>
						<div >
							<div class="form-group">
								<textarea name="request"
							 class="form-control" id="" cols="30" rows="7" placeholder="Message"></textarea>
							</div>
						</div>

<?php if(isset($_SESSION['contact_error_message'])){ ?>
  <small style="text-align: center;color: red;">

  <?php echo $_SESSION['contact_error_message'];unset($_SESSION['contact_error_message']); ?>
  </small>
  <?php
  }
  ?>
						<div >
							<div class="form-group">
								<input type="submit" name="submit" value="Send Message" class="btn btn-primary btn-modify">
							</div>
						</div>
</form>
					</div>
				</div>
			</div>
		</div>

	</div>
<?php
 include 'inc/footer.inc.php';
  ?>
	</body>
</html>
