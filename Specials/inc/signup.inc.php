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

  $_SESSION['sub_error'] = "First Name cannot be left empty";
header("Location: signuperror?");
exit();
}
if (empty($last)) {
  $_SESSION['sub_error'] = "Last Name cannot be left empty";
header("Location: signuperror?");exit();
}
if (empty($role)) {

  $_SESSION['sub_error'] = "Please select a role";
header("Location: signuperror?");
exit();
}
if (empty($phone)) {
  $_SESSION['sub_error'] = "Telephone cannot be left empty";
header("Location: signuperror?");
exit();
}
if (empty($email)) {
  $_SESSION['sub_error'] = "Email cannot be left empty";
header("Location: signuperror?");
exit();
}
if (empty($gender)) {
$_SESSION['sub_error'] = "Please select a gender";
header("Location: signuperror");exit();
}
if (empty($password)) {
$_SESSION['sub_error'] = "password was left empty";
header("Location: signuperror");exit();}
if (!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last) ){
    $_SESSION['sub_error'] = "Invalid Characters Used!";
header("Location: signuperror?Invalid-Characters");
  exit();
    
   }
else{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       
      $_SESSION['sub_error'] = "Invalid Email";
header("Location: signuperror?");
       exit();
    }
    
}

$sql = "SELECT * FROM userss WHERE email = '$email'";
        $result = mysqli_query($conn , $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
          
  $_SESSION['sub_error'] = "User Exisits with Email";
header("Location: signuperror?");
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
        
  $_SESSION['sub_error'] = "Sorry,there was an error sending a mail,you can no longer activate your account manually please contact an admin to activate your account manually";
header("Location: signuperror?");
exit();
    } else {

  $_SESSION['sub_success'] = "Email was successfully sent to your inbox,please check and activate your account";
header("Location: signupsuccess?");
exit();
    }
}
 
//Call method
 smtpmailer($email,'rccg.dpe2$@gmail.com','RCCG Dominion Media Department','Account Activation',$message);
 //use whatever mail you like

  }
  else{
  $_SESSION['sub_error'] = "There was a problem submitting your details,please try again";
header("Location: signuperror?");
exit();
  }
}
}


?>
