<?php
session_start();

require('inc/signup.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Donate - RCCG Dominion Parish Enugu Province 2
	</title>
	  <link rel="icon" href="images/logo.png" type="image/x-icon" class="animated tada infinite">
		  <meta name="description" content="Contribution or donations can now be made online and even more secured."/>
  <meta name="keywords" content="donate,dominion donate,rccg forum,rccg discussion,rccg radio,rccg,adeboye,church forums,rccg church forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">
	<?php
include('inc/header.inc.php');
	?>

</head>
<body style="font-family:'Raleway', sans-serif;">
  <?php
include('inc/modal.inc.php');
  ?>

<?php
include('inc/sub-errors.php');
?>
<?php
include('inc/nav.inc.php');
?>

<div class="container" align="center" style="margin-top: 110px;">
	
<div class="modal fade" id="tithe" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

		<H2 align="center"><b>Donation Forms Quick an easy,No extra charges</b></H2>
	<div class="row">
		<div class="col-md-4 col-sm-12 col-xs-12" align="center" style="background:url(images/w1.jpg);border-radius: 6px;height: 250px;margin: 2px;margin-left: -10px;">
			<div class="card" style="margin: 20px;">
				<div class="card-body">
					<h1>TITHES</h1>
					<i class="fa fa-spinner fa-spin" style="font-size:30px;"></i>
				</div>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tithe">
  PAY TITHE<i class="fas fa-credit-card"> </i>
</button>


			</div>
		</div>
		<div class="col-md-4 col-sm-12 col-xs-12" align="center" style="background:url(images/w2.jpg);border-radius: 6px;height: 250px;margin: 2px;">
		<div class="card" style="margin: 20px;">
				<div class="card-body">
					<h1>OFFERING</h1>
					<i class="fa fa-spinner fa-spin" style="font-size: 30px;"></i>
				</div>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#offering">
  PAY OFFERING<i class="fas fa-credit-card"> </i>
</button>


			</div>	
		</div>
		<div class="col-md-4 col-sm-12" align="center" style="background:url(images/w3.jpg);border-radius: 6px;height: 250px;margin: 2px;">
		<div class="card" style="margin: 20px;">
				<div class="card-body">
					<h1>EVENT</h1>
					<i class="fa fa-spinner fa-spin" style="font-size: 30px;"></i>
				</div>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#event">
  PAY NOW<i class="fas fa-credit-card"> </i>
</button>


			</div>
		</div>
		<div class="col-sm-12" align="center" style="font-size: 30px;">

			<i class="fa fa-cc-paypal"></i>
		
		<h6>Your paymets and credit card details are secured</h6>
		</div>
	</div>
</div>


<?php
include('inc/footer.inc.php');
?>
</body>
</html>