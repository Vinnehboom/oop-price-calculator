<?php
declare(strict_types=1);
class Customer
{
    private string $firstName;
    private string $lastName;
    private int $id;
    private int $groupId;
    private int $fixedDisc;
    private int $variableDisc;


    /**
     * Customer constructor.
     * @param string $firstName
     * @param string $lastName
     * @param int $id
     * @param int $groupId
     */
    public function __construct(string $firstName, string $lastName, int $id, int $groupId)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->id = $id;
        $this->groupId = $groupId;
    }

    public function setDiscount()
    {
        $database = new DatabaseHandler();
        $database->openConnection();
        $pdo = $database->getPdo();
        $id = $this->getId();
        $statement = $pdo->prepare('SELECT fixed_discount, variable_discount from customer where id = :id');
        $statement->bindValue('id', $id);
        $statement->execute();
        $discount = $statement->fetch();
        if ($discount['fixed_discount']) {
            $this->fixedDisc = intval($discount['fixed_discount']);
            $this->variableDisc = 0;
        } else if ($discount['variable_discount']) {
            $this->variableDisc = intval($discount['variable_discount']);
            $this->fixedDisc = 0;
        }
    }

    /**
     * @return int
     */
    public function getFixedDisc(): int
    {
        return $this->fixedDisc;
    }

    /**
     * @return int
     */
    public function getVariableDisc(): int
    {
        return $this->variableDisc;
    }




    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @return CustomerGroup
     */





}