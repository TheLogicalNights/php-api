<?php
    include ("/var/www/html/php-api/model/config/path.model.php");
    include ("$controller/php_api/php_api.controller.php");
    $read = new controller1();
    $data=json_decode(file_get_contents("php://input"));

  /*  if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
       /* if (isset($data->name) && isset($data->email) && !isset($data->id))
        {
            $result = $read->insertRecord($data);
            if($result)
            {
                echo gettype($data);
                echo "Added Successfully.....";
            }
            else
            {
                echo "Error.....";
            }
        } 
    */
	if (isset($_GET['id']))
    {
            $id = $_GET['id'];
            $result = $read->readOne($id);
            if ($result)
            {
                    $data = json_decode($result,true);
                    foreach($data as $row)
                    {
                        if (!empty($row['id']))
                            echo json_encode(array("name" => $row['name'], "email" => $row['email']));
                        else
                            echo json_encode(array("message" =>"Not found"));

                        http_response_code(200);
                    }
            }
            else
            {
                http_response_code(404);
                echo json_encode(array("msg" => "not found"));
            }
    }
    else
    {
        $result = $read->readAll();
    	if ($result)
        {
            http_response_code(200);
            echo $result;
        }
        else
        {
            http_response_code(401);
            echo json_encode(array("msg" => "Not found"));
        }
    }
    /*} 
    // if ($_SERVER['REQUEST_METHOD'] === 'PUT')
    // {
    //     if (isset($data->name) && isset($data->email) && isset($data->id))
    //     {
    //         $result = $read->updateRecord($data);
    //         if ($result)
    //             echo "Update successfully";
    //         else
    //             echo "Error...";
    //     }
       
    // }
    // if ($_SERVER['REQUEST_METHOD'] === 'DELETE')
    // {
    //     if (isset($_GET['id']))
    //     {
    //         $id = $_GET['id']; 
    //         $result = $read->deleteRecord($id);
    //         if ($result)
    //             echo "Delete successfully";
    //         else
    //             echo "Error....";
    //     }
    // }
    */	
?>