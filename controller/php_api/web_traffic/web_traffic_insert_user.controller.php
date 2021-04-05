<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/traffic.model.php");

    $ip = $_SERVER['REMOTE_ADDR'];

    $db = new Database();
    $conn = $db->getConnection();

    $traffic = new Trafic($conn);

    $stmt = $traffic->searchByIP($ip);
    $num = $stmt->rowCount();
    if($num>0)
    {
        $row = $stmt->fetchAll();
        $session = $row[0]['session'];
        $session = $session+1;
        $result = $traffic->updateUser($ip,$session);
        if($result)
        {
            http_response_code(200);
            echo json_encode(array("Message"=>"updated successfully"));
        }
        else
        {
            http_response_code(401);
            echo json_encode(array("Message"=>"access denied"));
        }
    }
    else
    {
        $result = $traffic->insertUser($ip);
        if($result)
        {
            http_response_code(200);
            echo json_encode(array("Message"=>"added successfully"));
        }
        else
        {
            http_response_code(401);
            echo json_encode(array("Message"=>"access denied"));
        }
    }
?>