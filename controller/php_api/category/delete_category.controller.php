<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/category.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $category = new Category($conn);

    if(isset($_GET['category']))
    {
        $category->cat = isset($_GET['category']) ? $_GET['category']:"";
        if($category->deleteCategories())
        {
            http_response_code(200);
            echo json_encode(array("Message" => "Category deleted successfully"));
        }
        else
        {
            http_response_code(401);
            echo json_encode(array("Message" => "category to delete category"));
        }
    }
    else
    {
        http_response_code(401);
        echo json_encode(array("Message" => "Unable to delete category"));
    }
?>