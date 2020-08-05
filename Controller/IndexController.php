<?php
declare(strict_types = 1);
class IndexController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {

        $database = new DatabaseHandler();
        $database->openConnection();

        $pdo = $database->getPdo();

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.
        $products = [];

        $statement = $pdo->prepare('SELECT * from product');
        $statement->execute();
        $productArray = $statement->fetchAll();

        foreach($productArray as $product) {
            $name = $product['name'];
            $price = intval($product['price']);
            $id = intval($product['id']);
            $products[] = new Product($name, $price, $id);
        }

        $statement = $pdo->prepare( 'SELECT id, firstname, lastname, group_id from customer');
        $statement->execute();
        $customerArray = $statement->fetchAll();
        $customers = [];

        foreach($customerArray as $customer) {
            $firstname = $customer['firstname'];
            $lastname = $customer['lastname'];
            $id = intval($customer['id']);
            $groupId = intval($customer['group_id']);
            $customers[] = new Customer($firstname, $lastname, $id, $groupId);

        }
        foreach($customers as $customer) {
            $customer->setDiscount();
            if ($customer->getFixedDisc() === 0)
            {
                echo $customer->getVariableDisc() .'% <br>';
            } else if ($customer->getVariableDisc() === 0)
            {
                echo $customer->getFixedDisc() .'<br>';
            }
        }

        $jos = $customers[3];
        $group = new CustomerGroup($jos);
        print_r($group->groupId);

        //load the view
        require 'View/index.php';
    }
}