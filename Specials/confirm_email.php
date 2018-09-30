<?php
session_start();
if (isset($_GET['token'])) {

	require 'inc/dbh.php';
	$token = mysqli_real_escape_string($conn, $_GET['token']);
$email = mysqli_real_escape_string($conn, $_GET['email']);
// echo $token;
$sql = "SELECT token FROM userss WHERE token = '$token' AND email_confirm = 0;";
if($query = mysqli_query($conn, $sql)){
	 // echo "selected";
if(mysqli_num_rows($query) > 0){
$sqli = "UPDATE userss SET email_confirm = 1 WHERE token = '$token'";
if($query2 = mysqli_query($conn, $sqli)){
	$sqlii = "UPDATE userss SET token = '' WHERE token = '$token';";
	if($query3 = mysqli_query($conn, $sqlii)){
		$_SESSION['good'] = '<h1>Congratulations!</h1>'.'<br>'.'You have successfully activated your account to continue using our services please continue to'.'<br>'.'<a href="index?account-activated-welcome" class="btn btn-success">Login</a>';
	}
}

}
else{
$_SESSION['error_o'] = 'Sorry, but this email has already been activated';
}

}


}

?>
<!DOCTYPE html>
<html>
<head>

<?php
include('inc/header.inc.php');
?>
	<title>Email Activation</title>
  <link rel="icon" href="../images/logo.png" type="image/x-icon" >
</head>
<body>
	
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
        <form method="POST" class="md-form" action="<?php echo $_SERVER['PHP_SELF'];?>" > 
          <input type="email" class="form-control" name="email" placeholder="Your Email">
          <input type="text"  name="fname" class="form-control" placeholder="First Name"> 
          <input type="text" class="form-control" name="lname" placeholder="Last Name">
          <input type="password" class="form-control" name="password" placeholder="password"> 
          <input type="text" class="form-control" name="phone" placeholder="Telephone" value="+234">
          <select class="form-control" name="role">
            <option name="emptyrole" class="form-control">
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
        <button type="submit"   name="signup" class="btn btn-success btn-lg btn-block">Join Now</button>
      
        </form>
        <h6>By submitting this form, you have agreed to our <a href="../policy">user policy</a> and <a href="../cookies">cookies policy.</a></h6>
      </div>
       
    </div>
  </div>
</div>
<!-- modal/ -->


<?php

include('inc/nav.inc.php');
?>



<?php if(isset($_SESSION['good'])){ ?>
				<div class="success" style="background-color: rgba(2,244,0,0.08);text-align: center;font-size: 1.2em;padding: 10px;margin-top: 60px;">
					<?php echo $_SESSION['good'];unset($_SESSION['good']); ?>
				</div>
			<?php
				} 
			?>																											
<?php if(isset($_SESSION['error_o'])){ ?>
        <div class="error" style="background-color: rgba(244,0,0,0.08);text-align: center;font-size: 1.2em;padding: 10px;margin-top: 90px;height: 1000px">
          <?php echo $_SESSION['error_o'];unset($_SESSION['error_o']); ?>
        </div>
      <?php
        } 
      ?>    


<?php

include('inc/footer.inc.php');
?>
</body>
</html>