<?php
    class user
    {
        private $conn;
        private $table_name = "trafic";
        public $ip_addr;
        public $session;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }
        public function viewTraffic()
        {
            $query = "select count(ip_address),sum(session) from ".$table_name."";
        }
    }
?>