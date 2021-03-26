<?php
    class user
    {
        private $conn;
        private $table_name = "php_api";

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
            $query = "INSERT into ".$this->table_name."(name,email) values(?,?)";
            //prepare this query
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->name);
            $stmt->bindParam(2,$this->email);
           // $stmt->bindParam(3,$this->password);
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
        public function deleteUser()
        {
            $query = "delete from ".$this->table_name." where id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            
            return $stmt->execute()? true : false;
        }
        public function updateUser()
        {
            $query = "UPDATE ".$this->table_name." SET name=?,email=?,password=? where id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->name);
            $stmt->bindParam(2,$this->email);
            $stmt->bindParam(3,$this->password);
            $stmt->bindParam(4,$this->id);

            if ($stmt->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function userexists()
        {
            $query = "select * from ".$this->table_name." where email =?";
            $stmt = $this->conn->prepare($query);
            $stmt ->bindParam(1,$this->email);
        
            $stmt->execute();
            if ($stmt->rowCount() > 0)
            {
                
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->email = $row['email'];
               // $this->password = $row['password'];
                return true;
            }
            else
            {
                return false;
            }
        }
        public function checkPass($pass)
        {
            if ($pass == $this->password)
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