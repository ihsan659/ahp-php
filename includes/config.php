<?php
session_start();
class Koneksi{
	private $server = "localhost";
	private $username = "root";
	private $pass = "pass";
	private $db = "dbname";
	private $conn = null;

	public function __construct(){
		$this->conn = new mysqli($this->server, $this->username, $this->pass, $this->db);
	}

	public function getConnection(){
		return $this->conn;
	}
}
?>