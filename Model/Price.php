<?php


class Price
{
    private float $price;

    public function __construct(Product $product, Customer $customer)
    {
        $product_price = $product->getProductPrice();
        $group = new CustomerGroup($customer);
        $discounts = $group->getDiscounts();
        $fixedCustomer = $customer->getFixedDisc();
        $variableCustomer = $customer->getVariableDisc();
        // calculation
        if($fixedCustomer)
        {
            // since
            $product_price -= $fixedCustomer;
            // if (20 >= 0.3 x 20 =product price) -- if (20 >= 6) vs. if (20 >= 0.3 x 100) -- (20 >= 30) = false --> go to variable discount
            if ($discounts['fixed'] >= $discounts['variable']/100 * $product_price)
            {
                $product_price -= $discounts['fixed'];
            } else
            {
               $product_price -= ($product_price * $discounts['variable']/100);
            }
        }
        if ($variableCustomer)
        {
            if($variableCustomer > $discounts['variable']) {
                if ($discounts['fixed'] >= $variableCustomer/100 * $product_price)
                {
                    $product_price -= $discounts['fixed'];
                } else
                {
                    $product_price -= ($product_price * $variableCustomer/100);
                }
            }
            else {
                if ($discounts['fixed'] >= $discounts['variable']/100 * $product_price)
                {
                    $product_price -= $discounts['fixed'];
                } else
                {
                    $product_price -= ($product_price * $discounts['variable']/100);
                }
            }
        }
        $this->price = max(0,$product_price);
    }

    /**
     * @return int|mixed
     */
    public function getPrice()
    {
        return $this->price;
    }


}