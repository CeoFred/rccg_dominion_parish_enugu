<?php
session_start();

if (!isset($_SESSION['success']) && empty($_SESSION['success'])) {
  header("locaton: index?hmmmmmm!!!!!");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SignUp Success</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <?php 
    include('inc/header.inc.php');
     ?>
</head>
<body style="font-family:'Raleway', sans-serif;">

<?php if(isset($_SESSION['success'])){ ?>
        <div class="" style="background-color: rgba(0,224,0,0.04);text-align: center;font-size: 1.2em;padding: 10px;font-family:;">
        	<i class="fa fa-user-o" style="font-size: 30px;"></i>
        	<h4>Congratulations! user, Your signup was successful ,you are almost there,plese confirm the email you provided 
          belongs to you.</h4>
          <?php echo $_SESSION['success'];unset($_SESSION['success']); ?>
          Open your  <a href="https://gmail.com">Mail box</a>
        </div>
      <?php
        } 
      ?>


      
      <?php
include('inc/footer.inc.php');
      ?>
</body>
</html>