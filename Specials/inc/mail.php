<?php


 $message = "
 <div class='container'>
    <div class='row'>
    <p>Hello $first,</p>
      <div class='col' align='center' style='color:black;'>
        
<b>Calvary Greetings</b>
<br>
<p>Congrats on signing up on Rccg Dominion parish Enugu Province 2! In order to activate your account please click the button below to verify your email address:
</p>
<a href='dpe2.com.ng/Specials/confirm_email?token=$token&email=$email' style='background:green;color:white;font-size:25px;border-radius:6px;box-shadow:19px;padding:9px;'>Activate Account</a>
<br>
<br>
 If the button above doesnt work copy and paste this link into your browser <b>https://dpe2.com.ng/subscription?token=$token&email=$email</b>
<p>For additional help, visit our<a href='https://dpe2.com.ng/contact.php'>Support Center</a></p>
<b>Gracias!</b>
      </div>
    </div>


  </div>
";
require_once('../PHPMailer/PHPMailerAutoload.php');
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
        
$_SESSION['s_error'] = 'There was an error while sending a mail';
header("Location: signuperror?mail-error");
exit();
    } else {

$_SESSION['success'] = 'Your Account Has Been Created ,Please Check Your Email for Veification';
header("Location: signupsuccess");

exit();
    }
}
 
//Call method
 smtpmailer($email,'rccg.dpe2$@gmail.com','RCCG Dominion Media Department','Account Activation',$message);
 //use whatever mail you like

?>