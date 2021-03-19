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
        public function searchByIP($ip)
        {
            $query = "select * from ".$this->table_name." where ip_address = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$ip);
            $stmt->execute();
            return $stmt;
        }
        public function insertUser($ip)
        {
            $session = 1;
            $query = "insert into ".$this->table_name."(ip_address,session) values(?,?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$ip);
            $stmt->bindParam(2,$session);
            if($stmt->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function updateUser($ip,$updatedsession)
        {
            // UPDATE MyGuests SET lastname='Doe' WHERE id=2
            $query = "update ".$this->table_name." set session = ? where ip_address = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$updatedsession);
            $stmt->bindParam(2,$ip);
            if($stmt->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>