<?php

    class Database
    {
        private $pdo = null;
        public $error = "";
        public $stmt = null;
        private $host = "febinaevents.com";
        private $dbname = "febinaevents18_community";
        private $dbcharset = "utf8";
        private $dbusername = "febinaevents18_community_admin";
        private $dbpassword = "Febina@123";
        function getConnection()
        {
            try 
            {
                $this->pdo = new PDO(
                  "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=".$this->dbcharset, 
                  $this->dbusername,$this->dbpassword, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                  ]
                );
                return $this->pdo;
            } 
            catch (Exception $ex) 
            { 
                die($ex->getMessage()); 
            }
        }
    }
?>