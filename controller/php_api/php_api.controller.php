<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: *");

    //include database and table files
    include ("/var/www/html/php-api/model/config/path.model.php");
    include ("$model/api.model.php");

    class controller1
    {
        public $db;
        public $conn;
        public $app;

        public function __construct()
        {
            //created object of database and table
            $this->db = new Database();
            $this->conn = $this->db->getConnection();
            $this->app = new api($this->conn);
        }
        function readAll()
        {
            $result = $this->app->readAll();
            
            return json_encode(count($result) == 0 ? null : $result);
        }
        function readOne($id)
        {
            $this->app->id = $id;
            $result = $this->app->readOne();
            
            return json_encode(count($result) == 0 ? null : $result);
        }
        function insertRecord($data)
        {
            if(isset($data->name) && isset($data->email))
            {
                $this->app->name = $data->name;
                $this->app->email = $data->email;
                $result = $this->app->insertRecords();
                return $result;
            }
        }
        function updateRecord($data)
        {
            if(isset($data->name) && isset($data->email) && isset($data->id))
            {
                $this->app->name = $data->name;
                $this->app->id = $data->id;
                $this->app->email = $data->email;
                $result = $this->app->updateRecord();
                return $result;
            }
            else
            {
                http_response_code(404);
            }
        }
        function deleteRecord($id)
        {
            $this->app->id = $id;
            $result = $this->app->deleteRecord();
            return $result;
        }
    }

?>