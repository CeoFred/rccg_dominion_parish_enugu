<?php


require('inc/dbh.php');
if (isset($_POST['signup'])) {
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$first = mysqli_real_escape_string($conn,$_POST['first']);
	$last = mysqli_real_escape_string($conn,$_POST['last']);
	$role = mysqli_real_escape_string($conn,$_POST['role']);
	$password = mysqli_real_escape_string($conn,$_POST['pwd']);
	$phone = mysqli_real_escape_string($conn,$_POST['phone']);
	$gender = $_POST['gender'];

 $role = $_POST['role'];

  Switch ($role) {

    Case 'empty':
    $role = '';
      break;
    Case 'm_a':
    $role = 'Minister/Adult';
      break;
    Case 'w_y':
    $role = 'Worker/Youth';
      break;
    Case 'w_a':
    $role = 'Worker/Adult' ;
      break;
    Case 'm_y':
    $role = 'Minster/Youth' ;
      break;
    Case 'mem_y':
    $role = 'Member/Youth' ;
      break;
    Case 'mem_a':
    $role  =  'Memeber/Adult';
      break;
      Case 'v_y':
    $role ='Visitor/Youth' ;
      break;
    Case 'v_a':
    $role = 'Visitor/Adult' ;
      break;

    Case 'v_t':
    $role = 'Visitor/Teenager' ;
      break;
    Case 't':
    $role = 'Teenager' ;
     break;
     default:
    //  $_SESSION['s_error'] = 'Please select a role';
    //   header("Location: signuperror?y=role-undefined");
    //   exit();
  }
//Error handlers
if (empty($first)) {
	echo "First Name is Empty";
exit();
}
if (empty($last)) {
	echo "Empty Last Name";
exit();
}
if (empty($role)) {
	echo "Empty Role";
exit();
}
if (empty($phone)) {
	echo "Empty Phone";
exit();
}
if (empty($email)) {
	echo "Empty Email";
exit();
}
if (empty($gender)) {
	echo "Empty Gender";
exit();
}
if (empty($password)) {
	echo "Empty password";
exit();}
if (!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last) ){
		$_SESSION['error'] = "Invalid Characters Used!";
		echo "Invalid Characters Used";
	exit();
	 	
	 }
else{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			 
			$_SESSION['error'] = "Invalid Email";
			echo "Invalid Email Format";
			 exit();
	 	}
	 	
}

$sql = "SELECT * FROM userss WHERE email = '$email'";
	 			$result = mysqli_query($conn , $sql);
	 			$resultCheck = mysqli_num_rows($result);

	 			if ($resultCheck > 0) {
					$_SESSION['error'] = "User Already Exists with Email";
					echo "User Exists with email";
					exit();
	 			}else{


$sqli = "SELECT role_id FROM role WHERE role = '$role';";
$query = mysqli_query($conn, $sqli);
$num = mysqli_num_rows($query);
if ($row = mysqli_fetch_assoc($query)) {
  $role_id = $row['role_id'];
}

$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
$token = str_shuffle($token);
$token = substr($token, 0, 10);
$num = 01234567;
$num = str_shuffle($num);

$dpe = 'dpe-';
$userid = $dpe.$num;
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

	$sql = "INSERT INTO userss (first_name,email,last_name,role,password,token,userid,email_confirm,gender,phone,role_id)
	 VALUES ('$first','$email','$last','$role','$hashedPassword','$token','$userid',0,'$gender','$phone','$role_id');";
	if (mysqli_query($conn,$sql)) {
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
        
$_SESSION['s_error'] = 'There was an error while sending a mail';
echo "Couldnt send mail";
exit();
    } else {
echo "Mail sent";
exit();
    }
}
 
//Call method
 smtpmailer($email,'rccg.dpe2$@gmail.com','RCCG Dominion Media Department','Account Activation',$message);
 //use whatever mail you like

	}
	else{
		echo "Not Added";
	}
}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">
		     <input type="email" class="form-control" name="email" placeholder="Your Email">
          <input type="text"  name="first" class="form-control" placeholder="First Name"> 
          <input type="text" class="form-control" name="last" placeholder="Last Name">
          <input type="password" class="form-control" name="pwd" placeholder="password"> 
           
          <input type="text" class="form-control" name="phone" placeholder="Telephone" >
          <input type="radio" name="gender" value="Female">Female
 <input type="radio" name="gender" value="Male">Male
      <select class="form-control" name="role">
            <option name="emptyrole" class="form-control" value="empty">
              Select Role
            </option>
            <option value="m_a">
              Minister/Adult
            </option>
            <option value="w_y">
              Worker/Youth
            </option>
            <option value="w_a">
              Worker/adult
            </option>
            <option value="m_y">
              Minister/Youth
            </option>
            <option value="mem_y">
              Member/Youth
            </option>
            <option value="mem_a">
              Member/Adult
            </option>
            <option value="v_y">
              Visitor/Youth
            </option>
            <option value="v_a">
              Visitor/Adult
            </option>
            <option value="v_t">
              Visitor/Teen
            </option>
            <option value="t">
              Teens
            </option>

          </select>
     
 <input type="submit" name="signup">
	</form></body>
</html>