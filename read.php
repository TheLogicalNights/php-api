<?php
    include ('./database.php');
    include('./api.php');

    $database = new Database();
    $db = $database->getConnection();
    $api = new api($db);
    $results = $api->getAllDetails();
    $result = json_decode($results,true);
    
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
        echo " </tbody>
        </table>";
    
?>