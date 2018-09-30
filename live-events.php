<?php

session_start();

$msg = '';
	if (isset($_POST['subscribe'])) {
		$con = new mysqli('localhost', 'root', '', 'dpe2');

		$name = $con->real_escape_string($_POST['name']);
		$email = $con->real_escape_string($_POST['email']);

		if ( $email == "" ){
			$_SESSION['sub_error'] = "Please check your inputs!";
		header('Location: I-events.php?Empty-Fields');
		
	}

		else {
			$sql = $con->query("SELECT email FROM subscribers WHERE email='$email'");
			if ($sql->num_rows > 0) {
				$_SESSION['sub_error'] = "Email already exists in the database!";
				header("Location: I-events.php?Existing-Email-Address");
				
			} else {
				
				 $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				 $token = str_shuffle($token);
				  $con->query("INSERT INTO subscribers (email,token,isconfirmed,name)
				  	VALUES ('$email','$token',0,'$name');");

 $message = "
 <div class='container'>
		<div class='row'>
			<div class='col' align='center'>
				<p>Dear,$name</p>
<b>Congratulations!</b>
<br>
<p>You have successfully subscribed, click the link below to confirm this subscription was made by you or just ignore this message if it was not you.
</p>
<a href='dpe2.com.ng/subscription?token=$token&email=$email' class='btn btn-success'>Confrim</a>
or copy this link to your browser <b>https://dpe2.com.ng/subscription?token=$token&email=$email</b>

			</div>
		</div>
	</div>";
				require_once('Specials/PHPMailer/PHPMailerAutoload.php');
//makes use of php mailer library
 

define ('gmailUserame','johnsonmessilo19@gmail.com');
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
        
    } else {


 

        $_SESSION['sub_success'] = 'Cogratulations, You have successfully subscribed ,please check your mail for confirmation';
    }
}
 

//Call method
 smtpmailer($email,'admin@dpe2.com.ng','RCCG Dominion Media Department','Confirm Your Email Subscription',$message);
 //use whatever mail you like


                }
			}
		}
	
?>

<!DOCTYPE html>
<html>
<head>
  <title>Live Events - RCCG Dominion Parish</title>
  	<link rel="icon" href="images/logo.png" type="image/x-icon">
<meta name="description" content="Watch events happening now for free.Don't miss a program,distance no longer a barieer." />
    <meta name="keywords" content="dominion nowdominion parish live,rccg live program,live event,rccg,adeboye,church around me,rccg in phase 6,rccg in transekulu,about-us,about dominion parish,dominion-paarish,enugu-province-2,redeemed christian church of god,praise clinic,bible study " />

  <?php
include 'inc/header.inc.php';
  ?>

</head>
<body>
<?php
include 'inc/maintop.inc.php';
?>

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
<div class="container-wrap">

<!-- < Modal-->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">News Letter Subscription</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" class="md-form" action="<?php echo $_SERVER['PHP_SELF'];?>" > 
          <input type="email" class="form-control" name="email" placeholder="Your Email">
          <input type="text" class="form-control" name="name" placeholder="Last Name">
        <button type="submit"   name="subscribe" class="btn btn-success btn-lg btn-block">Subscribe</button>
      
        </form>
        <footer class="modal-footer">
         powered by Do-media
        </footer>
      </div>
       
    </div>
  </div>
</div>
<!-- modal/ -->


	<div class="alert alert-danger">
	<h1 class="text-center">Oooops!!!</h1>
<h2 class="text-center">Sorry, There is no Live event Now. Please check back later or <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Subscribe
</button> to recieve updates about our upcoming events.</h2>
<h3>Meanwhile, you can still stream our last event below.</h3>
	 </div>


				<div class="col-md-12 text-center animate-box">
				
		<div  style="background: url(images/EVENTS.png);">
			<iframe height="315" width="100%" src="https://youtu.be/embed/7mLC2_-P68g?autoplay=1&loop=1controls=1" frameborder="0" allow="autoplay" allowfullscreen></iframe>
		</div>
		</div>
</div>


<?php
include 'inc/footer.inc.php';
?>
</body>
</html>