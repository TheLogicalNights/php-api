<?php
    include("./database.php");
    $db = new Database();
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