<?php

class Database{

private $conn;
static $_instance;

private $servername = "localhost";
private $username = "root";
private $password = "adminadmin";
private $dbname = "real_state_db";

public function __construct(){
	try {
	    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
	    // set the PDO error mode to exception
	    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //echo "Connected successfully"; 
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }
	}

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getConn() {
    	return $this->conn;
    }
 }
?>