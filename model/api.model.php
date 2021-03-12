<?php
    class api
    {
        private $conn;
        private $table_name = "php_api";

        public $id;
        public $name;
        public $email;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        public function readAll()
        {
            $query = "SELECT * FROM ".$this->table_name." order by id asc";
            //prepare this query
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            $result = $stmt->fetchAll();
            http_response_code(200);
            return $result;
        }
        public function readOne()
        {
            $query = "SELECT  * FROM  ".$this->table_name." where id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            http_response_code(200);
            return $result;
        }
        public function insertRecords()
        {
            $query = "INSERT into ".$this->table_name."(name,email) values(?,?)";
            //prepare this query
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->name);
            $stmt->bindParam(2,$this->email);
            // execute query
            if($stmt->execute())
            {
                http_response_code(200);
                return true;
            }
            else
            {
                http_response_code(404);
                return false;
            }
        }
        public function updateRecord()
        {
            $query = "UPDATE ".$this->table_name." SET name=?,email=? where id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->name);
            $stmt->bindParam(2,$this->email);
            $stmt->bindParam(3,$this->id);

            if ($stmt->execute())
            {
                http_response_code(200);
                return true;
            }
            else
            {
                http_response_code(404);
                return false;
            }
        }
        public function deleteRecord()
        {
            $query = "DELETE FROM ".$this->table_name." where id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            
            if ($stmt->execute())
            {
                http_response_code(200);
                return true;
            }
            else
            {
                http_response_code(404);
                return false;
            }
        }
    }
?>