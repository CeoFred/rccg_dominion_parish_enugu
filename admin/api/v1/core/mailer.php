<?php
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("./sendgrid-php.php");
// If not using Composer, uncomment the above line

function sendMail($to,$from,$subject,$message,$toName,$fromName){
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom($from, $fromName);
    $email->setSubject($subject);
    $email->addTo($to, $toName);
    $email->addContent(
        "text/html", $message
    );
    $sendgrid = new \SendGrid("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");
    try {
        $sendgrid->send($email);
        // print $response->statusCode() . "\n";
        // print_r($response->headers());
        // print $response->body() . "\n";
        return true;
    } catch (Exception $e) {
        // echo 'Caught exception: ',  $e->getMessage(), "\n";
        return false;
    }
    
}