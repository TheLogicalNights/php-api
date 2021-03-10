<?php
    include("./database.php");
    $db = new Database();
    if(isset($_GET['name']) && isset($_GET['email']))
    {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $result = $db->insert($name,$email);
        if($result)
        {
            echo "Inserted successfully...";
        }
        else
        {
            echo $result;
        }    
    }
    else
    {
        echo "POST variables not set";
    }
    
?>