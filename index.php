<?php
declare(strict_types=1);

session_start();
//include all your model files here
require 'Model/Customer.php';
require 'Model/Product.php';
require 'Model/CustomerGroup.php';
require 'Model/DatabaseHandler.php';

//include all your controllers here
require 'Controller/IndexController.php';


//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!




