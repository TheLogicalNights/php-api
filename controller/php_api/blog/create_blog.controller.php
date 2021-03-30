<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/blog.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $blog = new blog($conn);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // set product property values
    $blog->title = $data->title;
    $blog->description = $data->description;

    if($blog->createBlog())
    {
        http_response_code(200);
        echo json_encode(array("message" => "Blog Created successfully"));
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "Unable to create blog"));
    }
?>