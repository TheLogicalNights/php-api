<?php
    class TodoList
    {
        private $conn;
        private $table_name = "todolist";

        public $sr_no;
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
        public function deleteTask()
        {
            $query = "DELETE FROM ".$this->table_name." where sr_no=?";
            //Preparing Query
            $stmt = $this->conn->prepare($query);
            //Binding Data
            $stmt->bindParam(1,$this->sr_no);
            if($stmt->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function readList()
        {
            $query = "SELECT * from ".$this->table_name." ORDER BY date ASC";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            $result = $stmt->fetchAll();
            http_response_code(200);
            return $result;
        }
    }
?>