<?php session_start();

/**
 * Here we want to register a new site
 */

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('HEY NIGGA!! SEND THE RIGHT REQUEST TYPE');
}

// include database and object file
include_once '../../config/db.php';
include_once '../../core/settings.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$site = new SiteSettings($db);

// get site_i

$Name = isset($_REQUEST['Name']) ? $_REQUEST['Name'] : null;
$btc_address = isset($_REQUEST['btc_address']) ? $_REQUEST['btc_address'] : null;
$support_email = isset($_REQUEST['support_email']) ? $_REQUEST['support_email'] : null;
$eth_address = isset($_REQUEST['eth_address']) ? $_REQUEST['eth_address'] : null;
$commission_percent = isset($_REQUEST['commission_percent']) ? $_REQUEST['commission_percent'] : null;
$address_1 = isset($_REQUEST['address_1']) ? $_REQUEST['address_1'] : null;
$telephone = isset($_REQUEST['telephone']) ? $_REQUEST['telephone'] : null;
$customer_support_script = isset($_REQUEST['customer_support_script']) ? $_REQUEST['customer_support_script'] : null;
$perfect_money = isset($_REQUEST['perfect_money']) ? $_REQUEST['perfect_money'] : null;
$bnb_address = isset($_REQUEST['bnb_address']) ? $_REQUEST['bnb_address'] : null;
$doge_address = isset($_REQUEST['doge_address']) ? $_REQUEST['doge_address'] : null;
$ltc_address = isset($_REQUEST['ltc_address']) ? $_REQUEST['ltc_address'] : null;
$bch_address = isset($_REQUEST['bch_address']) ? $_REQUEST['bch_address'] : null;


$logo_url = isset($_REQUEST['logo_url']) ? $_REQUEST['logo_url'] : null;
$modified_by = isset($_REQUEST['modified_by']) ? $_REQUEST['modified_by'] : null;


if($Name === null || $eth_address === null || $btc_address ===   null || $address_1 === null){
        http_response_code(403);
        echo $site->forbidden('Site Name or ETH Address or BTC Address or Location was left empty');
        return;
}

$site->Name =  $Name;
$site->btc_address = $btc_address;
$site->commission_percent = $commission_percent;
$site->address_1 = $address_1;
$site->support_email = $support_email;
$site->eth_address = $eth_address;
$site->telephone = $telephone;
$site->logo_url = $logo_url;
$site->modified_by = $modified_by;
$site->customer_support_script = $customer_support_script;
$site->ltc_address = $ltc_address;
$site->doge_address = $doge_address;
$site->bnb_address = $bnb_address;
$site->perfect_money = $perfect_money;
$site->bch_address = $bch_address;

 try {

    $site_id =  $site->create();
    if($site_id){
        http_response_code(201);
        echo $site->actionSuccess('Account Was created successfully');
        return;
    } else {
        
        echo $site->actionFailure('Could not create site'); 
        die;
    }

 } catch (\Throwable $th) {
    http_response_code(505);

        echo $site->actionFailure('Opps! Something went wrong, error code xm112c3 '. $th->getMessage()); 
        die;
}

