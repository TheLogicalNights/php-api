<?php
    include ('database.php');

    $db = new Database();
    if(isset($_GET['name']) && isset($_GET['email']))
    {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $query = "insert into php_api(name,email) values('$name','$email')";
        $result = $db->insert($query);
        if($result)
        {
            echo "Inserted successfully...";
        }
        else
        {
            echo $result;
        }    
    }
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $query = "delete from php_api where id = ?";
        $result = $db->delete($query,[$id]);
        if($result)
        {
            echo "Deleted successfully...";
        }
        else
        {
            echo $result;
        }
    }
    
?>