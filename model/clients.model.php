<?php
    class clients
    {
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
        public function deleteClient()
        {
            $query = "delete from ".$this->table_name." where id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            
            return $stmt->execute()? true : false;
        }   
        public function readClient()
        {
            $query = "SELECT * FROM ".$this->table_name.";";
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            $result = $stmt->fetchAll();
            http_response_code(200);
            return $result;
        }
    }
?>