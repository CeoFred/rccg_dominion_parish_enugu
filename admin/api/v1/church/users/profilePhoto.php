<?php
session_start();
include '../../core/user.php';
include_once '../../config/db.php';
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$current_user = $user->getUser($_SESSION['user_id']);

if(!$current_user){
  return header('Location: ../../../index.php?error=AUTH');
}

$target_dir = "../../../uploads/";
$target_file = $target_dir .hash('ripemd160', time()).basename($_FILES["upload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["upload"]["tmp_name"]);
  if($check !== false) {
      "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $_SESSION['ERROR_'] = "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    $_SESSION['ERROR_'] =  "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["upload"]["size"] > 500000) {
    $_SESSION['ERROR_'] =  "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
) {
    $_SESSION['ERROR_'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   return header('Location: ../../../dashboard/invest/profile.php?UPLOAD=null');
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
    $_SESSION['UPLOAD_SUCCESS'] =  "The file ". htmlspecialchars( basename( $_FILES["upload"]["name"])). " has been uploaded.";
   
    try {
      $profile_set = $user->query("UPDATE users SET profile_photo_url = ? WHERE user_id = ?",[$target_file,$_SESSION['user_id']],true,false);

    } catch (\Throwable $th) {
      throw $th;
    }

    return header('Location: ../../../dashboard/invest/profile.php');
    
} else {
    $_SESSION['ERROR_'] =  "Sorry, there was an error uploading your file.";
    return header('Location: ../../../dashboard/invest/profile.php?UPLOAD=null');

  }
}