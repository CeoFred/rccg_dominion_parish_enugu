<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
require_once '../../config/db.php';
require_once '../../core/settings.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$sitesetting = new SiteSettings($db);

if (!empty($_POST['script'])) {


    $sitesetting->script = ($_POST['script']);


    try {
        $updated = $sitesetting->updateScript();

        if ($updated) {

      http_response_code(200);

      echo $sitesetting->actionSuccess("Script updated.");

      return;
        } else {
          http_response_code(403);

          echo $sitesetting->actionFailure('Failed to update script');
        }
    } catch (\Throwable $th) {

        // set response code - 503 service unavailable
        http_response_code(403);

        // tell the user
        echo $sitesetting->forbidden("Unable to update script. " .$th->getMessage());
        return;
    }
} else {

  // set response code - 400 bad request
  http_response_code(403);

  // tell the user
  echo $sitesetting->forbidden(json_encode($_REQUEST));
  return;

}
