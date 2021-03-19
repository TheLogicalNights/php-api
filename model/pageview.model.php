<?php
    class PageView
    {
        private $conn;
        private $table_name = "pageview";
        public $ip_addr;
        public $session;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        public function viewPageView()
        {
            $query = "select sum(count) as count from ".$this->table_name."";
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