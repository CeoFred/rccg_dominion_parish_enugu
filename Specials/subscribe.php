<?php

session_start();

$msg = '';
	if (isset($_POST['subscribe'])) {
		$con = new mysqli('localhost', 'root', '', 'dpe2');

		$name = $con->real_escape_string($_POST['name']);
		$email = $con->real_escape_string($_POST['email']);

		if ( $email == "" ){
			$_SESSION['sub_error'] = "Please check your inputs!";
			header("Location: suberror?inputs");
        exit();
		
	}

		else {
			$sql = $con->query("SELECT email FROM subscriberss WHERE email='$email'");
			if ($sql->num_rows > 0) {
				$_SESSION['sub_error'] = "Email already exists in the database!";
				header("Location: suberror?exiting-email");
        exit();
			} else {
				
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				 $con->query("INSERT INTO subscriberss (email,token,isconfirmed,name)
				 	VALUES ('$email','$token',0,'$name');");

 $message = "
<!DOCTYPE html>
<html>
<head>
	<title></title>

<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
</head>
<body>
 <div class='container'>
		<div class='row'>
			<div class='col' align='center'>
				<p>Dear,$name</p>
<b>Congratulations!</b>
<br>
<p>You have successfully subscribed, click the link below to confirm this subscription was made by you or just ignore this message if it was not you.
</p>
<a href='dpe2.com.ng/Specials/subscription?token=$token&email=$email' class='btn btn-success'>Confrim</a>
or copy this link to your browser <b>https://dpe2.com.ng/Specials/subscription?token=$token&email=$email</b>

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
        $_SESSION['sub_error'] = 'Opps! We encountered a proble sending a mail';
        header("Location: suberror?Mail-erorr");
        exit();
        
    } else {
        $_SESSION['sub_success'] = 'Cogratulations, You have successfully subscribed ,please check your mail for confirmation';
        header("Location: suberror?Mail-Success");
        exit();
        
    }
}
 

//Call method
 smtpmailer($email,'rccg.dpe2@gmail.com','RCCG Dominion Media Department','Confirm Your Email Subscription',$message);
 //use whatever mail you like


                }
			}
		}
	
?>
