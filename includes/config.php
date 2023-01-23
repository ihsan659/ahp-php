<?php
session_start();
class Koneksi{
	private $server = "localhost";
	private $username = "root";
	private $pass = "M1r34cl3";
	private $db = "polda_makassar";
	private $conn = null;

	public function __construct(){
		$this->conn = new mysqli($this->server, $this->username, $this->pass, $this->db);
	}

	public function getConnection(){
		return $this->conn;
	}
}
?>