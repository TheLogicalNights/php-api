<?php
    include ('./database.php');

    $db = new Database();
    
    $results = $db->getAllDetails("php_api");
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