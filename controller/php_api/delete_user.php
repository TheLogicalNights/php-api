<?php
    
    include ("C:/xampp/htdocs/php-api/model/config/database.php");
    include ("C:/xampp/htdocs/php-api/model/user.model.php");
    include ("C:/xampp/htdocs/php-api/controller/php_api/validate_token.php");

    use \Firebase\JWT\JWT;

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $user = new user($conn);
    $data = json_decode(file_get_contents("php://input"));
    $user->email = isset($data->email) ? $data->email : "";
    $user->id = isset($data->id) ? $data->id : "";
    if(!$user->userexists())
    {
        http_response_code(401);
        echo json_encode(array("message" => "Unable to delete user"));
    }
    else
    {
        if($user->deleteUser())
        {
            http_response_code(200);
            echo json_encode(array("Message" => "User deleted successfully"));
        }
        else
        {
            http_response_code(401);
            echo json_encode(array("Message" => "Unable to delete user"));
        }
    }
?>