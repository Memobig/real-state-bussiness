<?php

include 'config/Database.php';
include 'entities/Property.php';

class PropertyDao {

	private $db;
	private $conn;

	public function __construct() {
		$this->db = Database::getInstance();
		$this->conn = $this->db->getConn();
	}

	/**
	 * Retrieves all the properties
	 *
	 * @return properties array object
	 **/
	public function findAll() {
		try {
			$stmt = $this->conn->prepare("SELECT * FROM properties");
			$stmt->execute();
			$count = $stmt->rowCount();
			$data = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;

			if ($count) {
				/*print "<pre>";
				print_r($data);
				print "</pre>";*/
				return $data;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "error: " . $e->getMessage();
		}
	}

	/**
	 * Add new property
	 *
	 * @return true if registry added, false otherwise
	 **/
	public function registerProperty($property){

		$location  = $property->getLocation();
		$description = $property->getDescription();
		$price = $property->getPrice();
		$status = $property->getStatus();
		$type = $property->getType();
		$id_user = $property->getIdUser();

				print "<pre>";
				print_r($property);
				print "</pre>";
		try {
			$stmt = $this->conn->prepare("INSERT INTO properties (location, description, price, status, type, id_user) VALUES (:location, :description, :price, :status, :type, :id_user)");
			$stmt->bindParam(':location', $location, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_INT);
			$stmt->bindParam(':status', intval($property->getStatus()), PDO::PARAM_BOOL);
			$stmt->bindParam(':type', $type, PDO::PARAM_BOOL);
			$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
			
			if($stmt->execute()) {
				//echo "Record added successfully";
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "error: " . $e->getMessage();
		}
	}

	/**
	 * Delete a property
	 *
	 * @return true if registry deleted, false otherwise
	 **/
	public function deleteProperty($id) {
		try {
			$stmt = $this->conn->prepare("DELETE from properties WHERE id = :id_property");
			$stmt->bindParam(':id_property', $id, PDO::PARAM_INT);
			$stmt->execute();
			if($stmt->rowCount() > 0) {
				echo "Record deleted successfully";
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "error: " . $e->getMessage();
		}
	}

	/**
	 * Find a property by id
	 *
	 * @return Property object
	 **/
	public function findById($id) {

		$property = new Property;
		try {
			$stmt = $this->conn->prepare("SELECT * FROM properties WHERE id=:propertyId");
			$stmt->bindParam("propertyId", $id, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$data = $stmt->fetch(PDO::FETCH_OBJ);
			$db = null;

			if ($count) {

				$property->setId($data->id);
				$property->setLocation($data->location);
				$property->setDescription($data->description);
				$property->setPrice($data->price);
				$property->setStatus($data->status);
				$property->setType($data->type);
				$property->setIdUser($data->id_user);
				
				return $property;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "error: " . $e->getMessage();
		}
	}

	/**
	 * Updates a property
	 *
	 * @return true if updated successfully, false otherwise
	 **/
	public function updateById($property) {

		$location  = $property->getLocation();
		$description = $property->getDescription();
		$price = $property->getPrice();
		$status = $property->getStatus();
		$type = $property->getType();
		$id_user = $property->getIdUser();
		$id = $property->getId();

		try {
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $this->conn->prepare("UPDATE properties SET location=:location, description=:description, price=:price, status=:status, type=:type, id_user=:id_user WHERE id=:id");
			$stmt->bindParam(':location', $location, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_INT);
			$stmt->bindParam(':status', intval($property->getStatus()), PDO::PARAM_BOOL);
			$stmt->bindParam(':type', $type, PDO::PARAM_BOOL);
			$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			
			if($stmt->execute()) {
				//echo "Record added successfully";
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "error: " . $e->getMessage();
		}
	}

	/**
	 * Filter properties list by type (sale, rent)
	 *
	 * @return array of StdObjetcs (properties), false otherwise
	 **/
	public function filterListByType($filter) {

		try {
			$stmt = $this->conn->prepare("SELECT * FROM properties WHERE type=:type");
			$stmt->bindParam(':type', $filter, PDO::PARAM_BOOL);
			$stmt->execute();
			$count = $stmt->rowCount();
			$data = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;

			if ($count) {
				return $data;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "error: " . $e->getMessage();
		}
	}

	/**
	 * Filter properties list by price (ASC)
	 *
	 * @return array of StdObjetcs (properties), false otherwise
	 **/
	public function filterListByPrice() {

		try {
			$stmt = $this->conn->prepare("SELECT * FROM properties ORDER BY price ASC");
			$stmt->execute();
			$count = $stmt->rowCount();
			$data = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;

			if ($count) {
				return $data;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "error: " . $e->getMessage();
		}
	}
}

?>