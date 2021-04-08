<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/clients.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $client = new Clients($conn);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // set product property values
    $client->name = $data->name;
    $client->img = $data->img;
    //$user->password = $data->password;
    if($client->createClient())
    {
        http_response_code(200);
        echo json_encode(array("message" => "Client Created successfully"));
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "Unable to create client"));
    }
?>