<?php
namespace DataBase\Connect;


trait DataBaseConnect{
	private $host;
	private $name;
	private $password;
	private $db;
	private $connection;

	public function __construct($host,$name,$password,$db){
	$this->host = $host;
	$this->name = $name;
	$this->password = $password;
	$this->db = $db;
}

public function connect(){
	$this->connection = new \mysqli($this->host,$this->name,$this->password,$this->db);

	if($this->connection->connect_error){
		die("Ошибка подключени".$this->connection->connect_error);
	}
}

public function getConnection(){
	return $this->connection;
}

public function closeConnection(){
	$this->connection->close();
}
}





?>