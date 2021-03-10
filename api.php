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
    
    $results = $db->fetchAllDetails(
            "SELECT * FROM `php_api` WHERE `id` = ?",
            ["1"]
          );
    print_r($results);

    $ret = $db->updateDetails(
        "UPDATE `php_api` set `name` = ? where `id` = ?",
        ["Devarshi Pimpale","5"] 
    );
    if ($ret)
        echo "Update success";
    else
        echo "update failure";
?>