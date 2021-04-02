<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    //include database and table files
    include ("/var/www/html/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/blog.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $blog = new blog($conn);

    if(isset($_GET['id']))
    {
        $blog->id = isset($_GET['id']) ? $_GET['id']:"";
        if($blog->deleteBlog())
        {
            http_response_code(200);
            echo json_encode(array("Message" => "Blog deleted successfully"));
        }
        else
        {
            http_response_code(401);
            echo json_encode(array("Message" => "Unable to delete blog"));
        }
    }
    else
    {
        http_response_code(401);
        echo json_encode(array("Message" => "Unable to delete blog"));
    }
?>