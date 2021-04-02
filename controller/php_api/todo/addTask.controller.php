<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    //include database and table files
    include ("/var/www/html/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/todolist.model.php");

    //created object of database and table
    $db = new Database();
    $conn = $db->getConnection();
    // instantiate product object
    $todoList = new TodoList($conn);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // set product property values
    $todoList->task = $data->task;

    if($todoList->addTask())
    {
        http_response_code(200);
        echo json_encode(array("message" => "Task Created successfully"));
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "Unable to create task"));
    }
?>