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
        public function viewTraffic()
        {
            $query = "select count(ip_address) as ipcount,sum(session) as sessioncount from ".$this->table_name."";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute())
            {
                return $stmt;
            }
            else
            {
                return $stmt;
            }
        }
        public function viewNewUser()
        {
            $query = "select count(session) as sessioncount from ".$this->table_name." where session=1";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute())
            {
                return $stmt;
            }
            else
            {
                return $stmt;
            }
        }
    }
?>