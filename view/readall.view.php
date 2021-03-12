<?php

    include ("C:/xampp/htdocs/php-api/controller/php_api/php_api.controller.php");
    $read = new controller1();
    $data=json_decode(file_get_contents("php://input"));

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($data->name) && isset($data->email) && !isset($data->id))
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
    }
    if ($_SERVER['REQUEST_METHOD'] === 'PUT')
    {
        if (isset($data->name) && isset($data->email) && isset($data->id))
        {
            $result = $read->updateRecord($data);
            if ($result)
                echo "Update successfully";
            else
                echo "Error...";
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE')
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id']; 
            $result = $read->deleteRecord($id);
            if ($result)
                echo "Delete successfully";
            else
                echo "Error....";
        }
    }
    else
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            $result = $read->readOne($id);
            $data = json_decode($result,true);
            foreach($data as $row)
            {
                if (!empty($row['id']))
                    echo $row['id']."-".$row['name']."-".$row['email']."<br>";
            }
        }
    }
    $result = $read->readAll();
    $result = json_decode($result,true);
    echo "
            <table style='border:1px solid black;'>
                <thead>
                    <tr>
                        <th>ID </th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                    </tr>
                </thead>
                <tbody>
        ";
        foreach($result as $r)
        {
            echo "    
                    <tr>
                        <td>".$r['id']."</td>
                        <td>".$r['name']."</td>
                        <td>".$r['email']."</td>
                    </tr>

                    ";
        }
        
        echo "  
                </tbody>
            </table>";
?>