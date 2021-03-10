<?php
    define ('DB_HOST', 'febinaevents.com');
    define ('DB_NAME', 'febinaevents18_community');
    define ('DB_CHARSET', 'utf8');
    define ('DB_USER', 'febinaevents18_community_admin');
    define ('DB_PASSWORD', 'Febina@123');
    
    class Database
    {
        private $pdo = null;
        public $error = "";
        public $stmt = null;

        function __construct()
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
        }
        function getAllDetails($table_name)
        {
            $result = false;
            try 
            {
                $this->stmt = $this->pdo->prepare("select * from ".$table_name);
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
        function fetchAllDetails($sql,$cond = null)
        {
            $result = false;
            try 
            {
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute($cond);
                $result = $this->stmt->fetchAll();
                return json_encode($result);
            } 
            catch (Exception $ex) 
            { 
                $this->error = $ex->getMessage(); 
                return false;
            }
        }
    }
    
?>