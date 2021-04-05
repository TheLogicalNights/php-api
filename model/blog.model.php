<?php
    class blog
    {
        private $conn;
        private $table_name = "blog";

        public $id;
	    public $title;
	    public $description;
        public $category;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        function createBlog()
        {
            $query = "INSERT into ".$this->table_name."(category,title,description) values(?,?,?)";
            //prepare this query
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->category);
            $stmt->bindParam(2,$this->title);
            $stmt->bindParam(3,$this->description);
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
        public function readBlog()
        {
            $query = "SELECT * from ".$this->table_name." order by date desc";
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            $result = $stmt->fetchAll();
            http_response_code(200);
            return $result;
        }
        public function deleteBlog()
        {
            $query = "delete from ".$this->table_name." where id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            
            return $stmt->execute()? true : false;
        }
    }
?>