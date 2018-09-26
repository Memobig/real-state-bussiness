<?php
	session_start();
	
	include 'dao/UserDao.php';
	include 'utils/utils.php';

	$userDao = new UserDao();

	if (empty($_POST) === false) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username) === true || empty($password) === true) {
			echo "username and password can't be empty";
		} else {
			if($userDao->userLogin($username, $password) === false){
				echo "username or password is invalid";
			} else {
				redirect("index.php?do=available");
			}
		}
	}

?>