<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./assets/images/favicon_io/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="./assets/images/favicon_io/favicon.png" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/favicon_io/">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon_io/favicon-16x16.png">
  <title>Login </title>
  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./assets/css/vendors/font-awesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="./assets/css/vendors/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="./assets/css/vendors/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="./assets/css/vendors/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="./assets/css/vendors/feather-icon.css">
  <!-- Plugins css start-->
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="./assets/css/vendors/bootstrap.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  <link id="color" rel="stylesheet" href="./assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="./assets/css/responsive.css">
</head>

<body>
  <!-- login page start-->
  <section> </section>
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-12">
        <div class="login-card">
          <form class="theme-form login-form" id="adminLoginForm">
            <h4>Login</h4>
            <h6>Welcome back! Log in to your account.</h6>
            <div class=" form-group">
              <label>Email Address</label>
              <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                <input class="form-control" type="email" required name="email" placeholder="Test@gmail.com">
              </div>
            </div>
            <div class="form-group">
              <label>Password</label>
              <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <input class="form-control" type="password" name="password" requiredplaceholder="*********">
                <div class="show-hide"><span class="show"></span></div>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <input id="checkbox1" type="checkbox">
                <label for="checkbox1">Remember password</label>
              </div><a class="link" href="forget-password.php">Forgot password?</a>
            </div>
            <div class="alert alert-danger" style="display:none;" id="error">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-block" type="submit" id="submitButton">Sign in</button>
            </div>
            <p>Don't have account?<a class=" ms-2" href="sign-up.php">Create Account</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- latest jquery-->
  <script src="./assets/js/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap js-->
  <script src="./assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <!-- feather icon js-->
  <script src="./assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="./assets/js/icons/feather-icon/feather-icon.js"></script>
  <!-- scrollbar js-->
  <!-- Sidebar jquery-->
  <script src="./assets/js/config.js"></script>
  <!-- Plugins JS start-->
  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="./assets/js/script.js"></script>
  <!-- login js-->
  <script src="./scripts/login.js"></script>

  <!-- Plugin used-->

</body>

</html>