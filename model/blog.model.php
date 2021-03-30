<?php
    class blog
    {
        private $conn;
        private $table_name = "blog";

        public $id;
	    public $title;
	    public $description;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        function createBlog()
        {
            $query = "INSERT into ".$this->table_name."(title,description) values(?,?)";
            //prepare this query
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->title);
            $stmt->bindParam(2,$this->description);
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