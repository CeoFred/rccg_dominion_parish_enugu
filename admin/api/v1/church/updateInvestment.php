<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/db.php';
include_once '../core/index.php';
include_once '../core/settings.php';

// get database connection
$database = new Database();
$db = $database->getConnection();


$deposit = new Deposit($db);

if (!empty($_POST['id'])) {

  $amount = $_POST['amount'];
  $plan_id = $_POST['plan_id'];
  $payment_method = $_POST['payment_method'];
  $date_due = $_POST['date_due'];
  $id = $_POST['id'];
  
  $deposit->deposit_id = $id;
  $deposit->plan_id = $plan_id;
  $deposit->payment_method = $payment_method;
  $deposit->date_due = $date_due;
  $deposit->amount = $amount;

  try {

    $update =  $deposit->updateInvestment();

    if ($update === true) {

      http_response_code(200);

      echo $deposit->actionSuccess("Investment updated.", $update);

      return;
    } else {

      // set response code - 403 
      http_response_code(405);

      echo $deposit->actionFailure("Deposit deposit was not updated.", $update);

      return;
    }
  } catch (\Throwable $th) {

    // set response code - 503 service unavailable
    http_response_code(503);

    echo $deposit->forbidden("Unable to update deposit. " . $th->getMessage());
    return;
  }
} else {

  // set response code - 400 bad request
  http_response_code(403);

  // tell the user
  echo $deposit->forbidden("Deposit ID is required");
}
