<?php
declare(strict_types=1);
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

//include all your model files here
require 'Model/Customer.php';
require 'Model/Product.php';
require 'Model/CustomerGroup.php';
require 'Model/DatabaseHandler.php';
require 'Model/Price.php';
session_start();

if(isset($_POST['logout'])){
    session_unset();
}
//include all your controllers here
require 'Controller/IndexController.php';
require 'Controller/LoginController.php';


if(!$_SESSION['loggedIn']){
    $_SESSION['loggedIn'] = false;
}
if(isset($_POST['first-name'], $_POST['last-name']) || !$_SESSION['loggedIn']){
    $controller = new LoginController();
    $controller->render($_GET, $_POST);
} else {
    $controller = new IndexController();
    $controller->render($_GET, $_POST);
}


//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!




