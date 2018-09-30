<?php
session_start();

require 'inc/modal.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscription Error</title>
	<link rel="icon" href="../images/logo.png" type="image/x-icon">
    <?php 
    include('inc/header.inc.php');
     ?>
</head>
<body>
<div class="container" style="margin-bottom:130px;">
	<?php
	include('inc/nav.inc.php');
include('inc/sub-errors.php');
     
	?>
</div>


<?php
include('inc/footer.inc.php');
        ?>
</body>

</html>