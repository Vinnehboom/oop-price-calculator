<?php


class CustomerGroup
{
    private int $parentId;
    private array $discounts;
    private array $family;

    public function __construct(Customer $customer, PDO $pdo)
    {
        $customerGroupId = $customer->getGroupId();
        // start statement
        $statement = $pdo->prepare('SELECT parent_id, fixed_discount, variable_discount from customer_group where id =:id');
        $statement->bindValue('id', $customerGroupId);
        $statement->execute();
        $totalArray = $statement->fetch();
        $this->parentId = intval($totalArray['parent_id']);
        $this->discounts['variable'] =  intval($totalArray['variable_discount']);
        $this->discounts['fixed'] = intval($totalArray['fixed_discount']);
        $this->setDiscounts($pdo);
    }
    private function setDiscounts($pdo) : void
    {
    /*    $database = new DatabaseHandler();
        $database->openConnection();
        $pdo = $database->getPdo();*/

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
            $this->setDiscounts($pdo);
        }
    }

    public function groupLoader(Customer $customer, PDO $pdo) : void
    {
        $groupId = $customer->getGroupId();
        $statement = $pdo->prepare('SELECT * from customer_group where id = :id');
        $statement->bindValue('id', $groupId);
        $statement->execute();
        $fetch = $statement->fetch();
        $this->family[] = [$fetch['name'] => ['variable' => (int)$fetch['variable_discount']]];
        $this->family[] = [$fetch['name'] => ['fixed' => (int)$fetch['fixed_discount']]];
        if ($fetch['parent_id'] !== null) {
            $customer->setGroupId((int)$fetch['parent_id']);
            $this->groupLoader($customer, $pdo);
        }
    }
    /**
     * @return array
     */
    public function getFamily(): array
    {
        return $this->family;
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
