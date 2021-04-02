<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    //include database and table files
    include ("/var/www/html/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/events.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $event = new event($conn);

    if(isset($_GET['id']))
    {
        $event->id = isset($_GET['id']) ? $_GET['id']:"";
        if($event->deleteEvent())
        {
            http_response_code(200);
            echo json_encode(array("Message" => "Event deleted successfully"));
        }
        else
        {
            http_response_code(401);
            echo json_encode(array("Message" => "Unable to delete event"));
        }
    }
    else
    {
        http_response_code(401);
        echo json_encode(array("Message" => "Unable to delete event"));
    }
?>