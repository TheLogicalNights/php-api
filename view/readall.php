<?php

    include ("C:/xampp/htdocs/php-api/controller/php_api/php_api.controller.php");
    $read = new controller1();
    $data=json_decode(file_get_contents("php://input"));
    $result = $read->insertRecord($data);
    if($result)
    {
        echo "Added Successfully.....";
    }
    else
    {
        echo "Error.....";
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