<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include ("C:/xampp/htdocs/php-api/model/config/path.php");
    include_once "$model/config/core.php";
    // generate json web token
    include_once "$jwt/BeforeValidException.php";
    include_once "$jwt/ExpiredException.php";
    include_once "$jwt/SignatureInvalidException.php";
    include_once "$jwt/JWT.php";


    
    use \Firebase\JWT\JWT;

    // get jwt
    $jwt=isset($_COOKIE['jwt']) ? $_COOKIE['jwt'] : "";

    // if jwt is not empty
    if($jwt)
    {
        // if decode succeed, show user details
        try 
        {
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            // set response code
            http_response_code(200);

            // show user details
            // echo json_encode(array(
            //     "message" => "Access granted.",
            //     "data" => $decoded->data
            // ));
        }
        catch(Exception $e)
        {   
            // set response code
            http_response_code(401);
            // tell the user access denied  & show error message
            // echo json_encode(array(
            //     "message" => "Access denied.",
            //     "error" => $e->getMessage()
            // ));
        }
    }
    // show error message if jwt is empty
    else
    {
        // set response code
        http_response_code(401);
        // tell the user access denied
        echo json_encode(array("message" => "Access denied."));
    }


?>