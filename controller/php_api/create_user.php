<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/database.php");
    include ("C:/xampp/htdocs/php-api/model/user.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $user = new user($conn);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    // set product property values
    $user->name = $data->name;
    $user->email = $data->email;
    $user->password = $data->password;
    if($user->createUser())
    {
        http_response_code(200);
        echo json_encode(array("message" => "User Created successfully"));
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "Unable to create user"));
    }

?>