<?php
session_start();
require('inc/dbh.php');

if (isset($_POST[['add-topic']])) {
	$topic = mysqli_real_escape_string($conn, $_POST['topic']);
	$content = mysqli_real_escape_string($conn, $_POST['content']);
	$postby = $_SESSION['fname'].$_SESSION['lname'];
	if (empty($topic) || empty($content)) {
		$_SESSION['add_error'] = 'One or More fields were left empty';
	}
}


?>