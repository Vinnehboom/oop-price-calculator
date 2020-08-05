<?php


class CustomerGroup
{
    public array $groupId;
    private int $parentId;
    private int $fixedDiscount;
    private int $variableDiscount;

    public function __construct(Customer $customer)
    {
        $customerId = $customer->getGroupId();
        $database = new DatabaseHandler();
        $database->openConnection();
        $pdo = $database->getPdo();
        $statement = $pdo->prepare('SELECT parent_id, fixed_discount, variable_discount from customer_group where id =:id');
        $statement->bindValue('id', $customerId);
        $statement->execute();
        $groupArray = $statement->fetchAll();
        $this->groupId = $groupArray;
    }

}
