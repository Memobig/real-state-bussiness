<?php

include 'config/Database.php';

class UserDao {

	private $db;
	private $conn;

	public function __construct() {
		$this->db = Database::getInstance();
		$this->conn = $this->db->getConn();
	}

	public function userLogin($username, $password) {
		try {
			$stmt = $this->conn->prepare("SELECT id, username, id_role FROM users WHERE username=:username AND password=:password");
			$stmt->bindParam("username", $username, PDO::PARAM_STR);
			$stmt->bindParam("password", $password, PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			$db = null;

			if ($count) {
				// si el usuario y contraseña son correctos, registra estos datos en la sesión
				$_SESSION['id'] = $data->id;
				$_SESSION['username'] = $data->username;
				$_SESSION['id_role'] = $data->id_role;
				//echo "Logged succesfully";
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "error: " . $e->getMessage();
		}
	}
}

?>