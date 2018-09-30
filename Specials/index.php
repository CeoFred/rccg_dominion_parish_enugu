<?php
session_start();

if (isset($_POST['submit'])) {

require'inc/dbh.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (isset($_POST['loggedin'])) {
  $remember = true;
}else{
  $remember = false;
}

// $curl = curl_init();
//  curl_setopt_array($curl, [
// CURLOPT_RETURNTRANSFER => 1,CURLOPT_URL => 'https://wwww.google.com/recaptcha/api/siteverify',
// CURLOPT_POST => 1,
// CURLOPT_POSTFIELDS => [
// 'secret' => '6LdR9lsUAAAAAOfIt2RDewSKebD609ewTXmdF0oL',
// 'response' => $_POST['g-recaptcha-response'],
// ],
//  ]);

//  $response = json_decode(curl_exec($curl));
//  if (!$response->success) {
  
//  }

if (isset($_POST['remember'])) {$remember = true;}
else{$remember = false;}

//Error Hnadlers
//Check if inputs are empty
if(empty($email) || empty($password)) {
  $_SESSION['error'] = 'Empty Fields'.'<i class="fa fa-warning (alias)"></i>';
}
else{
  $sql = "SELECT * FROM userss WHERE email = '$email' ";
  $result = mysqli_query($conn , $sql);
  $resultcheck = mysqli_num_rows($result);
  if($resultcheck < 1){
    $_SESSION['error'] = 'Ooops!Details Seem Incorrect'.'<i class="fa fa-warning (alias)"></i>';
  }else{
 if ($row = mysqli_fetch_assoc($result)) {
//Dehashing the password
$hashedpwdcheck = password_verify($password,$row['password']);
$_SESSION['password'] = $hashedpwdcheck;;
if ($hashedpwdcheck == false) {
  $_SESSION['error'] = 'Hmmm,Try Again'.'<i class="fa fa-warning (alias)"></i>';
  
} 
elseif ($hashedpwdcheck == true) {
  //Login the user here
  
  $sql = "SELECT * FROM userss WHERE email = '$email' ";
  $result = mysqli_query($conn , $sql);
  $resultcheck = mysqli_num_rows($result);
 $row = mysqli_fetch_assoc($result);
 if($row['email_confirm'] == 0)
 {
   $_SESSION['error'] = 'Hey there,Seems you have not Verified Your Email,Please check your inbox';
 }
 elseif($row['email_confirm'] == 1){
if($remember == true)

$_SESSION['u_id'] = $row['id'];     
$_SESSION['email'] = $row['email'];
$_SESSION['fname'] = $row['first_name'];
$_SESSION['lname'] = $row['last_name'];
$_SESSION['phone'] = $row['phone'];
$_SESSION['m_role'] = $row['role'];
$_SESSION['roleid'] = $row['role_id'];

$_SESSION['gender'] = $row['gender'];
 $expiry = time() + 7*24*60*60;
       setcookie('email',$email,$expiry);
       setcookie('password',$hashedpwdcheck,$expiry);
header("Location: forum");
exit();

}
}
}
}
}
}
?>

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
 
define ('gmailUserame','yourhomefuto@gmail.com');
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
        
  $_SESSION['error'] = "Sorry,there was an error sending a mail,details have been submitted please contact an admin to activate your account manually";
header("Location: signup");
exit();
    } else {

  $_SESSION['success'] = "Email was successfully sent to your inbox,please check and activate your account";
header("Location: signup");
exit();
    }
}
 
//Call method
 smtpmailer($email,'yourhomefuto@gmail.com','Yourhomefuto','Account Activation',$message);
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
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Specials - RCCG Dominion Parish Enugu Province 2</title>
  <link rel="icon" href="../images/logo.png" type="image/x-icon">
<meta name="robots" content="all">
  <meta name="description" content="Get access and enjoy special contents like ask the pastor,audio and bulletin donwloads, forumns, photo gallery,and lots more." />
  <meta name="keywords" content="rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
  <?php
include('inc/header.inc.php');
  ?>

  <style type="text/css">
    html,
    body,
    header,
    .view {
      height: 100%;
    }

    @media (max-width: 740px) {
      html,
      body,
      header,
      .view {
        height: 1000px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .view {
        height: 650px;
      }
    }
    @media (min-width: 800px) and (max-width: 850px) {
              .navbar:not(.top-nav-collapse) {
                  background: #1C2331!important;
              }
          }
  </style>
</head>


<body style="font-family:'Raleway', sans-serif;">

<?php
include('inc/sub-errors.php');
?>
<?php
include('inc/nav.inc.php');
?>
  <?php
//include('inc/modal.inc.php');
  ?>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" class="md-form">
                   <input type="email" class="form-control" name="email" placeholder="Your Email">
          <input type="text"  name="first" class="form-control" placeholder="First Name"> 
          <input type="text" class="form-control" name="last" placeholder="Last Name">
          <input type="password" class="form-control" name="pwd" placeholder="password"> 
           
          <input type="text" class="form-control" name="phone" placeholder="Telephone" value="+234">
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
     
          <small><i>NB:This would be used to grant and restrict you to different forums</i></small>
     
 <input type="submit" name="signup" class="btn btn-success btn-lg btn-block" value="Join Now">

        </form>
        <h6>By submitting this form, you have agreed to our <a href="../policy">user policy</a> and <a href="../cookies">cookies policy.</a></h6>
      </div>
       
    </div>
  </div>
</div>

 <div class="view full-page-intro" style="background-image: url('images/logo.png'); background-repeat: no-repeat; background-size: contain;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

      <!-- Content -->
      <div class="container">

        <!--Grid row-->
        <div class="row wow fadeIn">

          <!--Grid column-->
          <div class="col-md-6 mb-4 white-text text-center text-md-left mb-4 d-none d-md-block">

             <h2 class="display-4 font-weight-bold">Hey there!</h2>
                             <hr class="hr-dark">

      <h3>Get Registered, Access Unlimited Special Contents just because you are special.</h3>
    <p class="mb-4 d-none d-md-block">
              <strong><h2>
                Did You know?</h2></strong>
                <h5>
                  <hr class="hr-dark" 
              >
                You can Now pay your thithes online using our secure payment gateway?Hurry now, don't 
                wait till sunday, Remember when you pay your tithes regularly and correctly, curses are destroyed, and you enjoy lots of unlimited blessings.</h5>
            </p>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">

            <!--Card-->
            <div class="card">

              <!--Card content-->
              <div class="card-body">

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <!-- Heading -->

                  <h3 class="dark-grey-text text-center">
                    <strong>Login</strong>
                  </h3>
                  <hr>

<?php if(isset($_SESSION['error'])){ ?>
        <div class="error" style="background-color: rgba(244,0,0,0.08);text-align: center;font-size: 1.2em;padding: 10px;font-family:;">
          <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
        </div>
      <?php
        } 
      ?>    

<div class="form-group">

  <input value="" placeholder="Enter your email" class="form-control" name="email" type="email">
</div>

<div class="form-group">
  <input name="password" value="" placeholder="Enter your password" class="form-control"  autocomplete="none" type="password">
</div>
<div class="g-recaptcha" data-sitekey="6LdR9lsUAAAAACNoKVYZdSbfaYQgXxwZKT9BdSVn"></div>
                  <div class="text-center"><button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                    <hr>
                    <fieldset class="form-check">
                      <input type="checkbox" class="form-check-input" id="checkbox1" name="loggedin">
                      <label for="checkbox1" class="form-check-label dark-grey-text">Keep Me Logged In</label>
                    </fieldset>
                    <h6>Don't have an account?</h6>
                     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Join Us
</button>

<!-- Modal -->
                  </div>


<script type="text/javascript">
  $(document).ready(

    function hide() {

    // on click signup, login form hids and registration form displays
    $("#signup").click(function () {
        $("#login").slideUp("slow", function(){
          $("#signup").slideDown("slow");
        });
      })
  })

</script>
                </form>
              </div>

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </div>
      <!-- Content -->

    </div>
    <!-- Mask & flexbox options-->

  </div>
  <!-- Full Page Intro -->

  <!--Main layout-->
  <!--Footer-->
 <?php

include('inc/footer.inc.php');

?>

 </body>

</html>