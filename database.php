<?php
    define ('DB_HOST', 'febinaevents.com');
    define ('DB_NAME', 'febinaevents18_community');
    define ('DB_CHARSET', 'utf8');
    define ('DB_USER', 'febinaevents18_community_admin');
    define ('DB_PASSWORD', 'Febina@123');
    
    class Database
    {
        public $pdo = null;
        public $error = "";
        public $stmt = null;

        function getConnection()
        {
            try 
            {
                $this->pdo = new PDO(
                  "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
                  DB_USER, DB_PASSWORD, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                  ]
                );
                
            } 
            catch (Exception $ex) 
            { 
                die($ex->getMessage()); 
            }
            return $this->pdo;
        }
    }
    
?>