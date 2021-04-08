<?php
    class Service
    {
        private $conn;
        private $table_name = "services";

        public $id;
	    public $title;
	    public $description;
        public $img;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        public function createService()
        {
            $query = "INSERT INTO ".$this->table_name."(title,description,img) values(?,?,?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->title);
            $stmt->bindParam(2,$this->description);
            $stmt->bindParam(3,$this->img);
            if($stmt->execute())
            {   
                return true;
            }
            else
            {
                return false;
            }
        }
        public function deleteService()
        {
            $query = "delete from ".$this->table_name." where sr_no = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            
            return $stmt->execute()? true : false;
        }
    }
?>