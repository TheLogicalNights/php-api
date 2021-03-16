<?php
header("Access-Control-Allow-Origin: *");
//include database and table files
include ("C:/xampp/htdocs/php-api/model/config/database.php");
include ("C:/xampp/htdocs/php-api/model/api.model.php");
// 'user' object
class User{

	// database connection and table name
	public $db;
    public $conn;
    public $app;
	private $table_name = "user";

	// constructor
	public function __construct($db){
		$this->conn = $db;
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
// create() method will be here
}