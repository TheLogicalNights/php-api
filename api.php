<?php
    class api
    {
        public $conn = null;
        public $id;
        public $name;
        public $email;
        private $table_name = "php_api";
        public function __construct($db)
        {
            $this->conn = $db;
        }
        function getAllDetails()
        {
            $result = false;
            try 
            {
                $this->stmt = $this->conn->prepare("select * from ".$this->table_name);
                $this->stmt->execute();
                $result = $this->stmt->fetchAll();
                return json_encode($result);
            } 
            catch (Exception $ex) 
            { 
                $this->error = $ex->getMessage();
                echo $this->error; 
                return false;
            }
        }
    }
?>