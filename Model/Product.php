<?php


class Product
{

    private string $productName;
    private float $productPrice;
    private int $productId;

    /**
     * Product constructor.
     * @param string $productName
     * @param float $productPrice
     */
    public function __construct(string $productName, float $productPrice, int $productId)
    {
        $this->productName = $productName;
        $this->productPrice = ($productPrice /100);
        $this->productId = intval($productId);
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
     * @return float
     */
    public function getProductPrice(): float
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