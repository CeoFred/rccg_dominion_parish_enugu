<?php
session_start();
$error = '';
$error1 = '';
$error2 = '';
require('inc/signup.inc.php');
if (isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$question = mysqli_real_escape_string($conn,$_POST['question']);
	if (empty($email)) {
		$error = 'Email Canniot be Empty';
	}
	if (empty($name)) {
		$error1 = 'Name cannot be empty';
	}
	if (empty($question)) {
		$error2 = 'You should supply your question before submitting';
	}
	if (!preg_match("/^[a-zA-Z]*$/",$name) ){
    $error2 = "Invalid Characters Used!";
   }
else{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       
      $error = "Invalid Email";
    }else{
    	//semnd mail to pastor
$pastor = 'johnsonmessilo19@gmail.com';
    	 $message = "
<!DOCTYPE html>
<html>
<body>
 <div class='container'>
		<div class='row'>
			<div class='col-12'>
				<p>Hello,Pastor</p>
<h3>You have a new question awaiting your reply,details are as below:</h3>
<h4>
Sender Nane: $name;
<br>
Seder Email: $email;
<br>
Question: $question;
</h4>
			</div>
		</div>
	</div>
	</body>
</html>";
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
     $mail->isHTML(true);
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
 $_SESSION['add_error'] = 'Your Question was Not Sent,Please try again';       
    } else {
    	$_SESSION['add_success'] = 'Your Question was sent to the pastor successfully';
        
    }
}
 

//Call method
 smtpmailer($pastor,'rccg.dpe2@gmail.com','RCCG Dominion Media Department','NEW QUESTION!!',$message);
 //use whatever mail you like

    }

}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ask the pastor - RCCG Dominiion Parish Enugu Province 2</title>
		  <link rel="icon" href="images/logo.png" type="image/x-icon">
		  <meta name="description" content="Get more interactive with us,join our live broadcast on facebook,twitter and instagram."/>
  <meta name="keywords" content="ask the pastor,do media,rccgdomedia,rccg Socials,rccg radio,rccg,adeboye,church forums,rccg church forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">

</head>
<body style="font-family:'Raleway', sans-serif;background-image: url(images/w2.jpg);">
	
  <?php
include ('inc/header.inc.php');
include('inc/modal.inc.php');
 include('inc/nav.inc.php');
include('inc/sub-errors.php');
?>




<div class="container-fluid" style="margin-top: 170px;">
	<div class="row">
		<div class="col-12" align="center">
			<h5>Have something bothering you? Can't share with anyone??The pastor is available and ready to hear you out. Use this form properly ,ask the right questions.		</h5>
		</div>
	</div>
</div>
<div class="container">
	 <div class="row">
	 	<div class="col-md-12">
		<form class="form-control md-form form-inline" method="post">
			<div class="col-12"  align="center">
				
	 		<i class="fa fa-envelope" style="font-size: 50px;"></i>
	 		<br>
	 			<small style="color: red;">
<?php echo $error2 ?>
<br>
<?php echo $error ?>
<br>
<?php echo $error1 ?>
	</small>
	 		<hr>
			</div>
			<div class="col-md-3 col-sm-12 col-xm-12 col-lg-4">
				<input type="text" class="form-control" name="name" placeholder="Name"></div>
<small style="color: red;">

	</small>		<div class="col-md-3 col-sm-12 col-xm-12 col-lg-4">
				<input type="text" class="form-control" name="email" placeholder="Email"></div>
				<small style="color: red;">

	</small>		
			<div class="col-md-3 col-sm-12 col-xm-12 col-lg-4">
				<input type="text" class="form-control" name="question" placeholder="Question Here">
					
			</div>
			<div class="col-xm-12 col-md-3 col-sm-12 col-lg-4">
				<input type="submit" name="submit" class="btn btn-secondary" value="Submit">
			</div>

		</form>
		</form>
	</div>
	 </div>
</div>




<?php

include('inc/footer.inc.php')
?>
</body>
</html>