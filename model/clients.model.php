<?php
    private $conn;
    private $table_name = "clients";

    public $id;
    public $name;
    public $img;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function createClient()
    {
        $query = "INSERT INTO ".$this->table_name."(name,img) values(?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->name);
        $stmt->bindParam(2,$this->img);
        if($stmt->execute())
        {   
            return true;
        }
        else
        {
            return false;
        }
    }
?>