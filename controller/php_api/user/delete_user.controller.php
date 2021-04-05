<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    

    include ("C:/xampp/htdocs/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/user.model.php");
    //include ("$controller/php_api/login/validate_token.controller.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $user = new user($conn);
    if (isset($_GET['id']))
    {
        // $data = json_decode(file_get_contents("php://input"));
        // $user->email = isset($data->email) ? $data->email : "";
        // $user->id = isset($data->id) ? $data->id : "";
        $user->email = isset($_GET['email']) ? $_GET['email']:"";
        $user->id = isset($_GET['id']) ? $_GET['id']:"";
        
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
    }
?>