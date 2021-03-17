<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include ("C:/xampp/htdocs/php-api/model/config/path.php");
    include ("$model/config/database.php");
    include ("$model/user.model.php");
    include ("$controller/php_api/validate_token.php");
    include ("$model/config/core.php");

    // generate json web token
    include_once "$jwt/BeforeValidException.php";
    include_once "$jwt/ExpiredException.php";
    include_once "$jwt/SignatureInvalidException.php";
    include_once "$jwt/JWT.php";

    use \Firebase\JWT\JWT;

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $user = new user($conn);
    
    $user->email = isset($decoded->data->email) ? $decoded->data->email : "";;
    if(!$user->userexists())
    {
        http_response_code(401);
        setcookie("jwt","",time() - 3600);
        echo json_encode(array("message" => "Unable to updated user"));
    }
    else
    {
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        // set product property values
        $user->id = $decoded->data->id;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;
        if($user->updateUser())
        {
            $token = array(
                "iat" => $issued_at,
                "exp" => $expiration_time,
                "iss" => $isuser,
                "data" => array(
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email
                ) 
                );
            $jwt = JWT::encode($token, $key);
            setcookie("jwt",$jwt,time() + (86400 * 1));
            http_response_code(200);
            echo json_encode(array("message" => "User updated successfully","jwt" => $jwt));
        }
        else
        {
            http_response_code(404);
            echo json_encode(array("message" => "Unable to updated user"));
        }

    }
?>