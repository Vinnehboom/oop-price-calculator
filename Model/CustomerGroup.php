<?php


class CustomerGroup
{
    private int $parentId;
    private array $discounts;
    private array $family;

    public function __construct(Customer $customer)
    {
        $customerGroupId = $customer->getGroupId();
        // pdo opening
        $database = new DatabaseHandler();
        $database->openConnection();
        $pdo = $database->getPdo();
        // start statement
        $statement = $pdo->prepare('SELECT parent_id, fixed_discount, variable_discount from customer_group where id =:id');
        $statement->bindValue('id', $customerGroupId);
        $statement->execute();
        $totalArray = $statement->fetch();
        $this->parentId = intval($totalArray['parent_id']);
        $this->discounts['variable'] =  intval($totalArray['variable_discount']);
        $this->discounts['fixed'] = intval($totalArray['fixed_discount']);
        $this->setDiscounts();
    }
    private function setDiscounts() : void
    {
        $database = new DatabaseHandler();
        $database->openConnection();
        $pdo = $database->getPdo();

        $parentId = $this->getParentId();
        $statement = $pdo->prepare('SELECT parent_id, fixed_discount, variable_discount from customer_group where id = :parent_id');
        $statement->bindValue('parent_id', $parentId);
        $statement->execute();
        $parent = $statement->fetch();
        // $parent is array with info in it
        // reassigning or summation of discounts
        if ($parent['fixed_discount']) {
            $this->discounts['fixed'] += intval($parent['fixed_discount']);
        } elseif ($parent['variable_discount'] > $this->discounts['variable'])
        {
            $this->discounts['variable'] = intval($parent['variable_discount']);
        }
        if ($parent['parent_id'])
        {
            $this->parentId = $parent['parent_id'];
            $this->setDiscounts();
        }
    }
    /**
     * @return array
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }

    /**
     * @return int|mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

}
