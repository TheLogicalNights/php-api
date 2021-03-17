<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include ("C:/xampp/htdocs/php-api/model/config/path.php");
    include ("$model/config/database.php");
    include ("$model/user.model.php");
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

    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    $user->email = $data->email;
    
    if ($user->userexists())
    {
        if ($user->checkPass($data->password))
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
                echo json_encode(
                    array(
                                "message" => "Successful login.",
                                "jwt" => $jwt
                            )
                );
                    http_response_code(200);        
        }
        else
        {
            http_response_code(404);
            echo json_encode(array("message" => "Not login"));
        }
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "User not exist"));
    }
?>