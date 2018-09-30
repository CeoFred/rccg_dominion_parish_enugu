<?php
session_start();
$topic = '';
$content = '';
require('inc/dbh.php');
require('inc/signup.inc.php');
include('inc/sub-errors.php');


$role = $_SESSION['roleid'];
$forumname = 'teens-forum';
if ($role != 3) {
	$_SESSION['access_error'] = 'You do not have role access to view contents in this forum,try singning up or logging in with existing pass details.';
	header("Location: forum");
	exit();
}

require('inc/dbh.php');

if (isset($_POST['add-topic'])) {
	$topic = mysqli_real_escape_string($conn, $_POST['topic']);
	$content = mysqli_real_escape_string($conn, $_POST['content']);
	$postby = $_SESSION['fname'].' '.$_SESSION['lname'];
	if (empty($topic) || empty($content)) {
		$_SESSION['add_error'] = 'One or More fields were left empty';
	}else{


$hashedtopic = password_hash($topic, PASSWORD_BCRYPT);


		$sql = "INSERT INTO muser (topic,content,added_by,topic_hash,forum_category) VALUES

		 ('$topic','$content','$postby','$hashedtopic','$role');";
		 if(mysqli_query($conn, $sql)){
		 	$_SESSION['add_success'] = 'Successfully Added Topic';
		 }else{
		 	$_SESSION['add_error'] = 'Sorry,there was a problem adding that topic,please try again';
		 }
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Teens Forum - RCCG Dominion Parish Enugu Province 2 </title>
		  <meta name="description" content="Welcome to the Teens forum, start now to explore great topics with unlimited contents." />
    <link rel="icon" href="images/logo.png" type="image/x-icon" >
  <meta name="keywords" content="rccg forum,rccg discussion,rccg radio,rccg,adeboye,church forums,rccg church 
  forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">
	<?php
include('inc/header.inc.php');
	?>
</head>
<body style="font-family:'Raleway', sans-serif;background: url(images/bg.jpeg);background-size: cover;background-repeat: no-repeat;">
  <?php
include('inc/modal.inc.php');
  ?>

<?php
include('inc/sub-errors.php');
?>
<?php
include('inc/nav.inc.php');
?>

<div class="container-fluid" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-2" style="margin-top: 30px;">
			<h3>Most Viewed Topics </h3>

<?php   
          $sql = "SELECT * FROM muser WHERE forum_category = '$role' ORDER BY views DESC LIMIT 10";
          $res = mysqli_query($conn, $sql); 
          while ($r = mysqli_fetch_assoc($res)) {

        ?>
			 <div class="alert alert-secondary">
		    <a href="read-topic?topic=<?php echo $r['topic']; ?>&posttime=<?php echo $r['added_on'] ?>
	&topic_id=<?php echo $r['topic_hash'] ?>&added_by=<?php echo $r['added_by']?>
	&forumname=<?php echo $forumname; ?>"><?php echo $r['topic'] ?>
	<i class="fa fa-eye"></i><?php echo $r['views'] ?></a>	 	
			 </div>
			<?php } ?>
		</div>



		<div class="col-md-10" style="border-left: 5px solid lightblue;">
			<div align="center">
			<form action="post" class="">
			<input type="search" class="form-control" name="Search For Topics" style="width: 300px;" placeholder="Search Topics">
            <input type="submit"  class="btn btn-warning" value="Search" name="">
		</form>
		<form action="teens-forum.php" method="post">
			<input type="submit" class="btn btn-secondary" value="Add Topic" name="add">
		</form>

		<?php
if (isset($_POST['add'])) {
	echo '<div>
<form class="md-form form-control" action="teens-forum" method="post">
	<input type="text" class="form-control" name="topic" placeholder="Topic" >
	<textarea class="form-control" name="content">Content</textarea>
	<input type="submit" class="btn btn-success" name="add-topic" value="Submit Topic">
</form>
	</div>';
}
		?>
		</div>

        <?php   
          $sql = "SELECT * FROM muser WHERE forum_category = '$role' ORDER BY id DESC";
          $res = mysqli_query($conn, $sql); 
          while ($r = mysqli_fetch_assoc($res)) {
          	$f_type = 'Teens Forum';
        ?>
<div class="tab" style="border-botom:2px solid black;">
	<div style="font-size: 20px;text-transform: uppercase;color: black;"><b><u><a href="read-topic?topic=<?php echo $r['topic']; ?>&posttime=<?php echo $r['added_on'] ?>
	&topic_id=<?php echo $r['topic_hash'] ?>&added_by=<?php echo $r['added_by']?>
	&forumname=<?php echo $forumname; ?>"><?php  echo $r['topic']; ?></a></u></b>(<?php echo $r['views'] ?> Views)</div>
	<span><i>Posted for:<?php echo $f_type; ?></i><i>,Posted by:<?php echo $r['added_by'] ?> </i>,<i>Posted on:
<?php echo $r['added_on']  ?>
	</i></span>
	<div class="card card-success">
		<?php  echo substr($r['content'], 0, 200)."..." ; ?><a href="read-topic?topic=<?php echo $r['topic']; ?>&posttime=<?php echo $r['added_on'] ?>
	&topic_id=<?php echo $r['topic_hash'] ?>&added_by=<?php echo $r['added_by']?>
	&forumname=<?php echo $forumname; ?>" >Read More</a>
	</div>

<?php } ?>
</div>

		</div>




	</div>


</div>


























<footer>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(){
        $("#p").toggle();
    });
});
</script>

</footer>

</body>
</html>