<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/path.php");
    include ("$model/config/database.php");
    //include ("$model/user.model.php");

    $db = new Database();
    $conn = $db->getConnection();
?>