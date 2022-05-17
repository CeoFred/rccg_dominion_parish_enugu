<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';
include_once '../core/index.php';

$database = new Database();
$db = $database->getConnection();

$deposit = new Deposit($db);

$valid_extensions = array('jpeg', 'jpg', 'png', 'pdf', 'doc'); // valid extensions
$path = 'uploads/'; // upload directory

if (!empty($_GET['deposit_id'])) {
  // find deposit and select upload directory
  $deposit->deposit_id = $_GET['deposit_id'];
  $founddeposit = (object) $deposit->readOne();

  if ($founddeposit) {
    $path = $path . $deposit->deposit_id . '/';
    if (!is_dir($path)) mkdir($path, 0777, true);
   
    $fileNames = ($_FILES['upload_file']['name']);
    if (!empty($fileNames)) {

      $error = $errorMessage = false;
      $img = $_FILES['upload_file']['name'];
      $tmp = $_FILES['upload_file']['tmp_name'];
      $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

      // can upload same image using rand function
      $final_image = htmlspecialchars(strip_tags(trim($img)));

      // check's valid format
      if (in_array($ext, $valid_extensions)) {
        $path = $path . rand(3, 20) + time() .'.' .($ext);
        if (!move_uploaded_file($tmp, str_replace(' ','',$path))) {
          $error = true;
          $errorMessage = 'Failed to upload ' . $img;
        }
      } else {
        $error = true;
        $errorMessage = 'File format is invalid ' . $img;
      }

      if (($error)) {
        $_SESSION['message_error'] = $error;
        return header("Location: /dashboard/invest/scheme_details.php?id=$deposit->deposit_id&error=true");
      } else {
        $_SESSION['message_success'] = 'Proof Uploaded Successfully';
        return header("Location: /dashboard/invest/scheme_details.php?id=$deposit->deposit_id&uplaod=true");
      }
    }
  } else {
    $_SESSION['message_error'] = 'deposit ID is required';
    return header("Location: /dashboard/invest/scheme_details.php?id=$deposit->deposit_id&error=true");
  }
}
