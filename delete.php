<?php 
session_start();

include 'dao/PropertyDao.php';
include 'utils/utils.php';

$propertyDao = new PropertyDao;

if ($_SESSION['id_role'] != 2) {
	redirect("index.php");
} else {

	if (empty($_GET['id']) === false) {
		if ($propertyDao->deleteProperty($_GET['id']) === false) {
			echo "error: the record cannot be deleted";
		} else {
			redirect("index.php?do=available");
		}
	}
}
?>