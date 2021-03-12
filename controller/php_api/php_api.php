<?php
    header("Access-Control-Allow-Origin: *");
    //include database and table files
    include ("C:/xampp/htdocs/php-api/model/config/database.php");
    include ("C:/xampp/htdocs/php-api/model/api.php");

    class controller1
    {
        public $db;
        public $conn;
        public $app;

        public function __construct()
        {
            //created object of database and table
            $this->db = new Database();
            $this->conn = $this->db->getConnection();
            $this->app = new api($this->conn);
        }
        function readAll()
        {
            $result = $this->app->readAll();
            return json_encode(count($result) == 0 ? null : $result);
        }
    }
?>