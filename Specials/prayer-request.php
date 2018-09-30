	<?php
session_start();

require('inc/signup.inc.php');
$fullname ='';
$email = '';
$phone ='';
$request ='';
if (isset($_POST['submit'])) {
	require('inc/dbh.php');

	$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$request = mysqli_real_escape_string($conn, $_POST['request']);
	if (empty($fullname)) {
		$_SESSION['prayer_error_name'] = 'Full Name cannot be left empty';
	}if (empty($email)) {
		$_SESSION['prayer_error_email'] = 'Email Cannot be left empty';
	}if (empty($phone)) {
		$_SESSION['prayer_error_phone'] = 'Telephone cannot be left empty';
	}if (empty($request)) {
		$_SESSION['prayer_error_request'] = 'Request cannot be left empty';
	}else{

		//send  prayer to pastor
		 $message = "
 <div class='container'>
    <div class='row'>
      <div class='col' align='center' style='color:black;'>
<b>Calvary Greetings Pastor</b>
<br>
<p>You have a new prayer request,details are as follows.</p>
<br>
Name: $fullname;
<p>Email: $email</p>
<p>Phone Number: $phone</p>
<p>Prayer Request: $request</p>
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
        
 $_SESSION['prayer_error'] = 'Sorry,There was an error while sending your request to the pastor please try again';
    } else {
 $_SESSION['prayer_success'] = 'Your Request was successfully sent to the pastor.For quality assurance,your request is between you and the pastor in charge,Thank you.';
    }
}
 
//Call method
 smtpmailer('johnsonmessilo19@gmail.com','rccg.dpe2@gmail.com','RCCG Dominion Media Department','NEW PRAYER REQUEST',$message);
 //use whatever mail you like


	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Prayer Request - RCCG Dominion Parish Enugu Province 2
	</title>
	  <link rel="icon" href="images/logo.png" type="image/x-icon" class="animated tada infinite">
		  <meta name="description" content="We trust God your prayers would be answered.Get your request staright to the pastor"/>
  <meta name="keywords" content="rccg forum,rccg discussion,rccg radio,rccg,adeboye,church forums,rccg church forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">
	<?php
include('inc/header.inc.php');
	?>

</head>
<body style="font-family:'Raleway', sans-serif;">
  <?php
include('inc/modal.inc.php');
  ?>

<?php
include('inc/sub-errors.php');
?>
<?php
include('inc/nav.inc.php');
?>
<div class="container" style="margin-top: 85px;">
	<div class="row">

		<img src="images/prayer_request.jpg">
		<div class="col">
		<h2 align="center">PRAYER REQUEST FORM</h2>
		<hr>	
		<p align="center">When you need help , remember we are always there for you to pray and stand with you. Use this online prayer form here to send in your prayers,we trust God for speedy answers.This request is kept exclusive and sent directly to the pastor.</p>
			<form class="md-form form-control" style="border:2px solid green" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
				<input type="text" value="<?php echo $fullname;  ?>" class="form-control" name="fullname" placeholder="Your Full Name" style="border-left:5px solid green" >

<?php if(isset($_SESSION['prayer_error_name'])){ ?>
  <small style="text-align: center;color: red;">

  <?php echo $_SESSION['prayer_error_name'];unset($_SESSION['prayer_error_name']); ?>
  </small>
  <?php
  }
  ?>
				<input type="email" class="form-control" value="<?php echo $email;  ?>" name="email" placeholder="Your Email" style="border-left:5px solid green">

<?php if(isset($_SESSION['prayer_error_email'])){ ?>
  <small style="text-align: center;color: red;">

  <?php echo $_SESSION['prayer_error_email'];unset($_SESSION['prayer_error_email']); ?>
  </small>
  <?php
  }
  ?>
				<input type="text" name="phone" value="<?php echo $phone;  ?>" placeholder="Telephone" style="border-left:5px solid green" class="form-control">

<?php if(isset($_SESSION['prayer_error_phone'])){ ?>
  <small style="text-align: center;color: red;">

  <?php echo $_SESSION['prayer_error_phone'];unset($_SESSION['prayer_error_phone']); ?>
  </small>
  <?php
  }
  ?> 
				<textarea  name="request" class="form-control" value="<?php echo $request;  ?>" >
					
				</textarea>

<?php if(isset($_SESSION['prayer_error_request'])){ ?>
  <small style="text-align: center;color: red;">

  <?php echo $_SESSION['prayer_error_request'];unset($_SESSION['prayer_error_request']); ?>
  </small>
  <?php
  }
  ?>
			<input type="submit" value="Send" class="btn btn-success" name="submit">
			</form>
		<b>If you need Further assistance please do not hessitate to <a href="contact">contact us</a></b>
		</div>
	</div>
</div>

<?php

include('inc/footer.inc.php');
?>
</body>
</html>