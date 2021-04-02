<?php
    class TodoList
    {
        private $conn;
        private $table_name = "todolist";

        public $id;
	    public $task;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        public function addTask()
        {
            $query = "INSERT into ".$this->table_name."(task) values(?)";
            //Preparing query
            $stmt = $this->conn->prepare($query);
            //Binding data
            $stmt->bindParam(1,$this->task);
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