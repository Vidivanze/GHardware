<?php
class DbManager {
	
	// attributs
	private $servername = "localhost";
	private $username = "projet151";
	private $password = "projet151";
	private $dbname = "projet151";
	
	private $conn = null;
	
	function __construct() {
		$this->Connect();
	}
	
	
	// connexion � la db
	public function Connect() {
		$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
		// set the PDO error mode to exception
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	// execute une requ�te
	public function Query($query) {
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}
