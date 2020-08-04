<?php


class Product
{

    private string $productName;
    private int $productPrice;
    private int $productId;

    /**
     * Product constructor.
     * @param string $productName
     * @param int $productPrice
     */
    public function __construct(string $productName, int $productPrice, int $productId)
    {
        $this->productName = $productName;
        $this->productPrice = ($productPrice /100);
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return int
     */
    public function getProductPrice(): int
    {
        return $this->productPrice;
    }

    /**
     * @param int $productPrice
     */
    public function setProductPrice(int $productPrice): void
    {
        $this->productPrice = $productPrice;
    }


}