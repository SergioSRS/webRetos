<?php

require_once 'config/config.php';

class Db {

	private $host;
	private $db;
	private $user;
	private $pass;
	private $codificacion;
	public $conection;

	public function __construct() {

		$this->host = constant('DB_HOST');
		$this->db = constant('DB');
		$this->user = constant('DB_USER');
		$this->pass = constant('DB_PASS');
		$this->codificacion = constant("CODIFICACION");

		$this->conection = new mysqli($this->host, $this->user, $this->pass, $this->db);
		$this->conection->set_charset($this->codificacion);

		if ($this->conection->connect_error) {
			die("Connection failed: " . $this->conection->connect_error);
		}

	}

}

