<?php

	function redirect($url) {
		header("Location: /$url");
	}

	function checkParam($param) {
		if (!empty($param) && isset($param) && is_numeric($param)) {
			return $param;
		} else {
			redirect("index.php?do=available");
		}
	}

	function checkRole($role) {

		$id_role;

		if ($role == "EMPLOYEE") {
			$id_role = 2;
		} else {
			$id_role = 1;
		}

		// id_role en la sesion actual
		$role_session = $_SESSION['id_role'];


		if (empty($role_session)) {
			redirect("index.php");
		} elseif ($role_session == $id_role) {
			return true;
		} else {
			redirect("index.php?do=available");
		}
	}

?>