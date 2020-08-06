<?php
declare(strict_types = 1);
class IndexController
{
    public function render(array $GET, array $POST)
    {
        $database = new DatabaseHandler();
        $customers = $database->fetchFullCustomerList();
        $products = $database->fetchFullProductList();
        $finalPrice = '';
        if (isset($_POST['product']) && isset($_POST['customer']))
        {
           $Jos = $database->fetchCustomerById(intval($_POST['customer']));
           $produkt = $database->fetchProductById(intval($_POST['product']));
           $price = new Price($produkt, $Jos);
           $finalPrice = $price->getPrice();
        }
        require 'View/index.php';
    }
}