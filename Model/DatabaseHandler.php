<?php


class DatabaseHandler
{
    private PDO $pdo;

    public function __construct()
    {
        $pdo = $this->openConnection();
        $this->pdo = $pdo;
    }

    function openConnection(): PDO
    {
        // No bugs in this function, just use the right credentials.
        $dbhost = "localhost";
        $dbuser = "becode";
        $dbpass = "becode";
        $db = "price_calculator";

        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        return new PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpass, $driverOptions);
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

}