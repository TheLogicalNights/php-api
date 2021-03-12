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
            $query = "SELECT * FROM ".$this->table_name;
            //prepare this query
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
    }
?>