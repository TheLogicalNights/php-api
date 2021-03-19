<?php
    class Trafic
    {
        private $conn;
        private $table_name = "trafic";
        public $ip_addr;
        public $session;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }
        
    }
    
?>