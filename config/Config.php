<?php
	// inicia la sesión
	session_start();

	include 'entities/Client.php';
	include 'utils/utils.php';
	include 'dao/PropertyDao.php';

	if(!isset($_GET['do']))
		$_GET['do'] = 'login';

	switch ($_GET['do']) {
		case 'login':
			$currentPage = "Login";
			$title = "Login to Real State Bussiness";
			$pageContainer = "layout/LoginForm.php";
			break;
		case 'available':
			$currentPage = "ListProperties";
			$title = "Available Properties List";
			$propertyDao = new PropertyDao();
			$properties = $propertyDao->findAll();
			$pageContainer = "layout/ListProperties.php";
			break;
		case 'addProperty':
			checkRole("EMPLOYEE");	// solo el usuario con rol empleado puede entrar
			$property = new Property;
			$propertyId = 0;
			$currentPage = "New Property";
			$title = "New Property Form";
			$pageContainer = "layout/newPropertyForm.php";
			break;
		case 'modify':
			checkRole("EMPLOYEE");	// solo el usuario con rol empleado puede entrar
			$propertyId = checkParam($_GET['id']);
			$propertyDao = new PropertyDao;
			$property = $propertyDao->findById($propertyId);
			if (!$property) {
				redirect("index.php");
			}
			$currentPage = "Modify Property";
			$title = "Modify Property Form";
			$pageContainer = "layout/newPropertyForm.php";
			break;
		case 'logout':
			session_unset();
			session_destroy();
			redirect("index.php");
			break;
		default:
			$currentPage = "Login";
			$title = "Login to Real State Bussiness";
			$pageContainer = "layout/LoginForm.php";
			break;
	}
?>