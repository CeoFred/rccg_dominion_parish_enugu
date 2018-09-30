<?php
session_start();
require('inc/dbh.php');

$reply = mysqli_real_escape_string($conn, $_POST['comment']);

$topic = mysqli_real_escape_string($conn, $_GET['topic']);
	$addedon = mysqli_real_escape_string($conn, $_GET['posttime']);
	$topichash = mysqli_real_escape_string($conn, $_GET['topic_id']);
	$added_by = mysqli_real_escape_string($conn, $_GET['added_by']);
	$forumname = mysqli_real_escape_string($conn, $_GET['forumname']);

	$sql = "INSERT INTO repliess (topic,topic_id,added_by,forum_name,reply) VALUES ('$addedon','$topichash','$added_by','$forumname','$reply');" ;
if (mysqli_query($conn,$sql)) {
		$_SESSION['reply_success'] = 'comment was added successfully';
		header("Location: read-topic?topic=".$topic."&posttime=".$addedon."&topic_id=".$topichash."&added_by=".$added_by."&forumname=".$forumname."&condition=success");
		exit();
	}else{
		$_SESSION['reply_error'] = 'comment was not added,please try again';
				header("Location: read-topic?topic=".$topic."&posttime=".$addedon."&topic_id=".$topichash."&added_by=".$added_by."&forumname=".$forumname."&condition=failed");
		exit();
	}
 
  ?>