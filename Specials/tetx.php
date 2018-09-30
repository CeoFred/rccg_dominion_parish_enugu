<?php
session_start();
$msg = '';

//CHECK FOR POSTED DATA
if (isset($_POST['submit'])) {

//database connection
  $dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "dpe2";

$conn = mysqli_connect($dbhost ,$dbuser, $dbpassword, $dbname);
$errorlog = false;
  $email = mysqli_real_escape_string($conn, $_POST['email']);  
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  if (empty($email) || empty($password)) {
    $errorlog = true;
    $msg = 'Opps!Fields cannot be empty';
  $_SESSION['error'] = $msg;
  header("Location: index?Empty-Fields");
  }
if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {

  $sql = "SELECT email FROM users WHERE email = '$email' or userame = $email;";
  
  if (mysqli_num_rows(mysqli_query($conn, $sql)) < 1) {
    $errorlog = true;
    $msg = 'User Email does not exist , try signing up';
    $_SESSION['error'] = $msg;
    header("Location: index?Email-does-not-exist");
  }
  elseif($row = mysqli_fetch_assoc(mysqli_num_rows(mysqli_query($conn, $sql))) > 0) {
$errorlog = false;
//verify password
if ($row['email_confirm'] = 0) {
  $errorlog = true;
  $msg = 'Your Email is not yet confirmed, please check your inbox for a confirmation mail from';
  $_SESSION['error'] = $msg;
  header("Location: index?email-not-confirmed");
}else{

        $hashedPwdCheck = password_verify($password, $row['password']);
        if ($hashedPwdCheck == false) {
          $errorlog = true;
          $msg = 'Email and password do not match a user';
          $_SESSION['error'] = $msg;
          header("Location: index?Email-and-pass-do-not-match");
        }
        elseif ($hashedPwdCheck == true) {
          $errorlog = false;


      $_SESSION['username'] = $row['username'];
      $_SESSION['firstname'] = $row['firs_tname'];
      $_SESSION['lastname'] = $row['last_name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['uid'] = $row['id'];

          $cookiess = ['email' => $email , 'password' => $password  ];
          $cookiesserialized = serialize($cookiess);
          setcookie('user', $cookiesserialized, time() + (86400 * 30));
          header("downloads?welcome-back");
        }
      }

  }
}
  else{ 
//    $errorlog = true;
//    $msg = 'Invalid Email Format';
//    $_SESSION['error'] = $msg;
// header("Location: index?Invalid email Format");
}
   }
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <title>Specials | RCCG Dominion Parish Enugu Province 2</title>
  <link rel="icon" href="../images/logo.png" type="image/x-icon" class="animated tada infinite">

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
include('inc/nav.inc.php');
?>
  
<!-- < Modal-->

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
        <form method="post" class="md-form" action="<?php echo $_SERVER['PHP_SELF'];?>" > 
          <input type="email" class="form-control" name="email" placeholder="Your Email Email">
          <input type="text"  name="fname" class="form-control" placeholder="First Name"> 
          <input type="text" class="form-control" name="lname" placeholder="Last Name">
          <input type="password" class="form-control" name="password1" placeholder="password"> 
          <input type="password" class="form-control" name="password2" placeholder="Password Again">
        <button type="submit" class="btn btn-success btn-lg btn-block">Join Now</button>
      
        </form>
      </div>
       
    </div>
  </div>
</div>
<!-- modal/ -->


 <div class="view full-page-intro" style="background-image: url('images/logo.png'); background-repeat: no-repeat; background-size: contain;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

      <!-- Content -->
      <div class="container">

        <!--Grid row-->
        <div class="row wow fadeIn">

          <!--Grid column-->
          <div class="col-md-6 mb-4 white-text text-center text-md-left">

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

<div class="form-group">
<?php if(isset($_SESSION['error'])){ ?>
        <div class="alert alert-danger">
          <?php echo $_SESSION['error'];
          // unset($_SESSION['error']); ?>
        </div>
      <?php
        } 
      ?>    

  <input value="" placeholder="Enter your email" class="form-control" name="email" type="email">
</div>

<div class="form-group">
  <input value="" placeholder="Enter your password" class="form-control"  autocomplete="none" type="password">
</div>

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