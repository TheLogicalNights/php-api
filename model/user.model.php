<?php
    class user
    {
        private $conn;
        private $table_name = "php_api_user";

        public $id;
	    public $name;
	    public $email;
	    public $password;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        public function createUser()
        {
            $query = "INSERT into ".$this->table_name."(name,email,password) values(?,?,?)";
            //prepare this query
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->name);
            $stmt->bindParam(2,$this->email);
            $stmt->bindParam(3,$this->password);
            // execute query
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