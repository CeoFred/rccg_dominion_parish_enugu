<?php

session_start();
require('inc/dbh.php');
$error = '';

		
require('inc/signup.inc.php');
include('inc/sub-errors.php');

if(!isset($_SESSION['m_role']) & empty($_SESSION['m_role'])){
		$_SESSION['access_error'] = 'Sorry,You do not have access right to view topics in that forum'.'<br>'
		.'Try logging in or creating an account';
		header('location: index');
		exit();
	
}
else{
if (isset($_GET['topic'])) {
	require('inc/dbh.php');
	$topic = mysqli_real_escape_string($conn, $_GET['topic']);
	$addedon = mysqli_real_escape_string($conn, $_GET['posttime']);
	$topichash = mysqli_real_escape_string($conn, $_GET['topic_id']);
	$added_by = mysqli_real_escape_string($conn, $_GET['added_by']);
	$forumname = mysqli_real_escape_string($conn, $_GET['forumname']);

	$sql = "SELECT content FROM muser WHERE topic_hash = '$topichash';";
	$query = mysqli_query($conn,$sql);
	if ($num = mysqli_num_rows($query) > 0) {
		$content = mysqli_fetch_assoc($query);
		$contentmain = $content['content'];
	}else{
		$contentmain = 'This Topic Has No content Yet';
	}
 
$update = "UPDATE muser SET views = views + 1 WHERE topic_hash = '$topichash';";
mysqli_query($conn, $update);
}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Forum Discussion By <?php echo $added_by; ?> | <?php echo $topic; ?></title>
			  <meta name="description" content="Check out this topic posted by <?php echo $added_by; ?>Read contents about this topic,join the discussion start now to explore great topics with unlimited contents." />
    <link rel="icon" href="images/logo.png" type="image/x-icon" >
  <meta name="keywords" content="rccg forum,rccg discussion,rccg radio,rccg,adeboye,church forums,rccg church 
  forum,rccg dominion parish enugu,adeboye,rccg,dominionparish,rccg dominion parish,rccg churches,dominion parish,redeemed christian church of god,praise clinic,bible study " />
<meta name="robots" content="all">
	<?php
include('inc/header.inc.php');
	?>
</head>

</head>
<body style="font-family:'Raleway', sans-serif;background-color: lightgrey;">
<?php
include('inc/nav.inc.php');
?>


<div class="container" style="margin-top: 150px;">
	<div class="row" style="background-color: white;">
		<div class="col-md-9">
		
			<a href="forum">Forum-Home</a>>><a href='<?php echo $forumname; ?>'><?php echo $forumname; ?></a>>><?php echo $topic; ?>
			<h4><u><?php echo $topic; ?></u></h4>
			<i>By <?php echo $added_by; ?></i>

			<article>
				<?php echo $contentmain; ?>
			</article>
		<hr>
		<div>
			<h6 class="btn btn-outline-primary" style="border-radius: 18px;">		<?php

			require('inc/dbh.php');
$sql = "SELECT topic_id FROM repliess WHERE topic_id = '$topichash'";
$query = mysqli_query($conn, $sql);
if ($num = mysqli_num_rows($query)) {
	echo $num;
}
			?>
	 Replies..</h6>
				<h6>Share your thoughts about this topic</h6>
	


<?php   
          $sql = "SELECT * FROM repliess WHERE topic_id = '$topichash' ORDER BY id DESC LIMIT 5";
          $res = mysqli_query($conn, $sql); 
          while ($r = mysqli_fetch_assoc($res)) {

        ?>
			 <div class="alert alert-secondary">
		    <a><?php echo $r['reply'] ?></a>	 	
			 <p><i>By: <?php  echo $r['added_by'] ?></i></p>
			 </div>
			<?php } ?>

				<form class="md-form" method="post" action="addreply?topic=<?php echo $topic; ?>&topic_id=<?php echo $topichash ?>&added_by=<?php echo $added_by ;?>&forumname=<?php echo $forumname; ?>&posttime=
					<?php echo $addedon; ?>">
					<h6><?php echo $error; ?></h6>
					<input type="text" name="comment" class="form-control" placeholder="Add Replies">
					<input type="submit" name="submit" value="Contribute" class="btn btn-success">	
				</form>
			</div>
		</div>

		<div class="col-md-3">
			 <h4>MORE ARTICLES BY AUTHOR</h4>
			 
<?php   
          $sql = "SELECT * FROM muser WHERE added_by = '$added_by' ORDER BY views DESC LIMIT 5";
          $res = mysqli_query($conn, $sql); 
          while ($r = mysqli_fetch_assoc($res)) {

        ?>
			 <div class="alert alert-primary">
		    <a href="read-topic?topic=<?php echo $r['topic']; ?>&posttime=<?php echo $r['added_on'] ?>
	&topic_id=<?php echo $r['topic_hash'] ?>&added_by=<?php echo $r['added_by']?>&forumname=<?php echo $forumname; ?>"><?php echo $r['topic'] ?></a>	 	
			 </div>
			<?php } ?>
		</div>
	</div>
</div>
































<?php
include('inc/footer.inc.php');
?>
</body>
</html>