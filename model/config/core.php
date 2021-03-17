<?php
// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Asia/Kolkata');

// variables used for jwt
$key = "example_key";
$issued_at = time();
$expiration_time = $issued_at + (86400 * 1); // valid for 1 day
$isuser = "http://localhost/php-api/controller/php_api/login.php";
?>