<?php


class DatabaseHandler
{
    private PDO $pdo;

    public function __construct()
    {
        $pdo = self::openConnection();
        $this->pdo = $pdo;
    }

    function openConnection(): PDO
    {
        $dbhost = "localhost";
        $dbuser = "becode";
        $dbpass = "becode1993";
        $db = "Price_exercise_db";

        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        return new PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpass, $driverOptions);
    }


    public function fetchFullCustomerList() : array
    {
        $pdo = self::getPdo();
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
        return $customers;
    }

    public function fetchFullProductList() :array
    {
        $pdo = self::getPdo();
        $statement = $pdo->prepare('SELECT * from product');
        $statement->execute();
        $productArray = $statement->fetchAll();

        foreach($productArray as $product) {
            $name = $product['name'];
            $price = intval($product['price']);
            $id = intval($product['id']);
            $products[] = new Product($name, $price, $id);
        }
        return $products;
    }

    public function fetchProductById(int $productId) : Product
    {
        $pdo = self::getPdo();
        $statement = $pdo->prepare('SELECT name, price from product where id = :id');
        $statement->bindValue('id', $productId);
        $statement->execute();
        $fetchArray = $statement->fetch();
        return new Product($fetchArray['name'], $fetchArray['price'], $productId);

    }

    public function fetchCustomerById(int $customerId) : Customer
    {
        $pdo = self::getPdo();
        $statement = $pdo->prepare('SELECT firstname, lastname, group_id from customer where id = :id');
        $statement->bindValue('id', $customerId);
        $statement->execute();
        $fetchArray = $statement->fetch();
        return new Customer($fetchArray['firstname'], $fetchArray['lastname'], $customerId, $fetchArray['group_id']);

    }


    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

}