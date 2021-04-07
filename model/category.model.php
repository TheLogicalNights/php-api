<?php
    class Category
    {
        private $conn;
        private $table_name = "category";

        public $cat;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }
        public function addCategory()
        {
            $query = "INSERT INTO ".$this->table_name."(cat) values(?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->cat);
            if($stmt->execute())
            {   
                return true;
            }
            else
            {
                return false;
            }
        }
        public function readCategories()
        {
            $query = "SELECT * FROM ".$this->table_name.";";
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            $result = $stmt->fetchAll();
            http_response_code(200);
            return $result;
        }
        public function deleteCategories()
        {
            $query = "delete from ".$this->table_name." where cat = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->cat);
            
            return $stmt->execute()? true : false;
        }
    }
?>