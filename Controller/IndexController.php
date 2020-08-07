<?php
declare(strict_types = 1);
class IndexController
{
    public function render(array $GET, array $POST)
    {
        $database = new DatabaseHandler();
        $pdo = $database->getPdo();
        $customers = $database->fetchFullCustomerList();
        $products = $database->fetchFullProductList();
        $finalPrice = '';
        $familyArray = [];
        if(!isset($_SESSION['currentUser'])){
            if (isset($_POST['product']) && isset($_POST['customer']))
            {
                $Jos = $database->fetchCustomerById(intval($_POST['customer']));
                $produkt = $database->fetchProductById(intval($_POST['product']));
                $price = new Price($produkt, $Jos);
                $finalPrice = $price->getPrice();
            }
        } else {
            if(isset($_POST['product'])){
                $Jos = $_SESSION['currentUser'];
                $produkt = $database->fetchProductById(intval($_POST['product']));
                $groupJos = new CustomerGroup($Jos, $pdo);
                $groupJos->groupLoader($Jos, $pdo);
                $familyArray = $groupJos->getFamily();
                $price = new Price($produkt, $Jos);
                $finalPrice = $price->getPrice();
            }
        }

        require 'View/index.php';
    }


}