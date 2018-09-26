<?php
session_start();

include 'dao/PropertyDao.php';
include 'utils/utils.php';

class Controller
{
    private $propertyDao;

    function __construct()
    {
        $this->propertyDao = new PropertyDao;
    }
    
    public function addProperty()
    {
        
        if ($_SESSION['id_role'] != 2) {
            redirect("index.php");
        }
        
        if (empty($_POST) === false) {
            
            $property = new Property();
            $property->setLocation($_POST['location']);
            $property->setDescription($_POST['description']);
            $property->setPrice($_POST['price']);
            $property->setType($_POST['type']);
            $property->setStatus(1);
            $property->setIdUser($_SESSION['id']);
            
            if (empty($property->getLocation()) === true || empty($property->getDescription()) === true || ($property->getPrice()) === true) {
                echo "error: there should not be empty fields";
            } else {
                if ($this->propertyDao->registerProperty($property) === false) {
                    echo "no data returned";
                } else {
                    redirect("index.php?do=available");
                }
            }
        }
    }

    public function updateById($id) {
        if ($_SESSION['id_role'] != 2) {
            //redirect("index.php");
        }
        
        if (empty($_POST) === false) {
            
            $property = new Property();
            $property->setId($id);
            $property->setLocation($_POST['location']);
            $property->setDescription($_POST['description']);
            $property->setPrice($_POST['price']);
            $property->setType($_POST['type']);
            $property->setStatus(1);
            $property->setIdUser($_SESSION['id']);
            
            if (empty($property->getLocation()) === true || empty($property->getDescription()) === true || ($property->getPrice()) === true) {
                echo "error: there should not be empty fields";
            } else {
                if ($this->propertyDao->updateById($property) === false) {
                    echo "error updating";
                } else {
                    redirect("index.php?do=available");
                }
            }
        }
    }

    public function filterListByType($filter) {

        
        $properties = $this->propertyDao->filterListByType($filter);
        $this->template($properties);
    }

    public function filterListByPrice() {

        $properties = $this->propertyDao->filterListByPrice();
        $this->template($properties);
    }

    public function filterListAll() {
        
        $properties = $this->propertyDao->findAll();
        $this->template($properties);
    }

    public function template($properties) {

    echo "<table class='table table-striped table-bordered'>
    <thead class='thead-dark'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Location</th>
            <th scope='col'>Description</th>
            <th scope='col'>Price</th>
            <th scope='col'>Status</th>
            <th scope='col'>Type</th>";

            if ($_SESSION['id_role'] == 2) {
            echo "
            <th scope='col'>Modify</th>
            <th scope='col'>Delete</th>";
            }
    echo "
        </tr>
    </thead>
    <tbody>";

    foreach ($properties as $property) {
        echo "
        <tr>
            <td>$property->id</td>
            <td>$property->location</td>
            <td>$property->description</td>
            <td>$property->price</td>
            <td>";

        echo $property->status==1?"available":"not available";
        echo "
            </td>
            <td>";

        echo $property->type==0?"sale":"rent";

        echo "</td>";

            if ($_SESSION['id_role'] == 2) {

        echo "
            <td><a href='index.php?do=modify&id=$property->id' class='btn btn-primary'>modify</a></td>
            <td><a href='delete.php?id=$property->id'' class='btn btn-danger'>delete</a></td>";

            }
        echo "
        </tr>";
        }
    }
}

$controller = new Controller();

// add and update property
if (!isset($_POST['id']) && empty($_POST['id']) && !isset($_GET['filter'])) {

      $controller->addProperty();

} elseif (isset($_POST['id']) && !empty($_POST['id'])) {

    $controller->updateById($_POST['id']);
} 

// filter list ajax
if (isset($_GET['filter']) && !empty($_GET['filter'])) {

    if ($_GET['filter'] == "sale") {

        $controller->filterListByType(0);

    } elseif ($_GET['filter'] == "rent") {

        $controller->filterListByType(1);

    } elseif ($_GET['filter'] == "price") {

        $controller->filterListByPrice();

    } elseif ($_GET['filter'] == "all") {

        $controller->filterListAll();
    }
}

?>