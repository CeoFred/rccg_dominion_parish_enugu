<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include'inc/header.inc.php';
?>
    <title> 404 Error - Page Not Found </title>
</head>
<style type="text/css">
	a{
		color: black;
	}
	a:hover{
		color: black;
	}
</style>
<body>

    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-6 col-lg-12 col-xl-12 justify-content-center" align="center"><a href="index.php">
    			<img src="images/logo.png" width="100" height="100"></a>
    			<span><h4>404 Error<i style="color: red" class="fa fa-warning"></i><p>Page Requested For Does not exist</p></h4></span>
    			<h6>Do A proper Navigation</h6>

    		<br>


    		</div>

    	</div>


    </div>
    	<?php
include'inc/footer.php';
    	?>

    </body>
</html>
