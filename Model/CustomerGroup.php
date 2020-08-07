<?php


class CustomerGroup
{
    private int $parentId;
    private array $discounts;
    private array $fixedDiscounts;
    private array $variableDiscounts;
    private array $groupNames;

    public function __construct(Customer $customer, PDO $pdo)
    {
        $customerGroupId = $customer->getGroupId();
        // start statement
        $statement = $pdo->prepare('SELECT name, parent_id, fixed_discount, variable_discount from customer_group where id =:id');
        $statement->bindValue('id', $customerGroupId);
        $statement->execute();
        $totalArray = $statement->fetch();
        $this->parentId = intval($totalArray['parent_id']);
        $this->discounts['variable'] = (int)$totalArray['variable_discount'];
        $this->discounts['fixed'] = (int)$totalArray['fixed_discount'];
        $this->variableDiscounts[] = (int)$totalArray['variable_discount'];
        $this->fixedDiscounts[] = (int)$totalArray['fixed_discount'];
        $this->groupNames[] = $totalArray['name'];
        $this->setDiscounts($pdo);
    }
    private function setDiscounts($pdo) : void
    {
    /*    $database = new DatabaseHandler();
        $database->openConnection();
        $pdo = $database->getPdo();*/

        $parentId = $this->getParentId();
        $statement = $pdo->prepare('SELECT name, parent_id, fixed_discount, variable_discount from customer_group where id = :parent_id');
        $statement->bindValue('parent_id', $parentId);
        $statement->execute();
        $parent = $statement->fetch();
        $this->groupNames[] = $parent['name'];
        // $parent is array with info in it
        // reassigning or summation of discounts
        if ($parent['fixed_discount']) {
            $this->discounts['fixed'] += (int)$parent['fixed_discount'];
            $this->fixedDiscounts[] = (int)$parent['fixed_discount'];
            $this->variableDiscounts[] = 0;
        } elseif ($parent['variable_discount'])
        {
            $this->variableDiscounts[] = $parent['variable_discount'];
            $this->fixedDiscounts[] = 0;
            if($parent['variable_discount'] > $this->discounts['variable'])
            $this->discounts['variable'] = (int)$parent['variable_discount'];
            $this->variableDiscounts[] = 0;
        }
        if ($parent['parent_id'])
        {
            $this->parentId = $parent['parent_id'];
            $this->setDiscounts($pdo);
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

    /**
     * @return array
     */
    public function getFixedDiscounts(): array
    {
        return $this->fixedDiscounts;
    }

    /**
     * @return array
     */
    public function getVariableDiscounts(): array
    {
        return $this->variableDiscounts;
    }

    /**
     * @return array
     */
    public function getGroupNames(): array
    {
        return $this->groupNames;
    }

}
