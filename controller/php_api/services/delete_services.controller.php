<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/service.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $service = new Service($conn);

    if(isset($_GET['id']))
    {
        $service->id = isset($_GET['id']) ? $_GET['id']:"";
        if($service->deleteService())
        {
            http_response_code(200);
            echo json_encode(array("Message" => "Service deleted successfully"));
        }
        else
        {
            http_response_code(401);
            echo json_encode(array("Message" => "Unable to delete Service"));
        }
    }
    else
    {
        http_response_code(401);
        echo json_encode(array("Message" => "Unable to delete Service"));
    }
?>