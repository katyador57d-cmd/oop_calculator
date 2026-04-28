<?php

declare(strict_types=1);

class Cart
{   
    const DISCOUNT_THRESHOLD = 1000 ;
    const DISCOUNT_PERCENT = 10;

    private array $products;

    public function __construct()
    {
        $this->products = [];
    }

    public function addProduct(Product $newProduct): void
    {
        foreach ($this->products as $product) {
            if ($product->name === $newProduct->name) {
                $product->increaseQuantity();
                return;
            }
        }
        $this->products[] = $newProduct;
    }

    public function removeProduct(Product $product): bool
    {
        $index = $this->findProductIndexByName($product);

        if ($index === -1) {
            return false;
        }
        
        unset($this->products[$index]);
        return true;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function isEmpty(): bool
    {
        return empty($this->products);
        
    }

    public function clear(): void
    {
        $this->products = [];
    }

    private function findProductIndexByName(Product $product): int  
    {
        foreach ($this->products as $key => $product_number){
            if ($product_number->name === $product->name) {
                return $key;
            }
        }
        return -1;
    }

    public function getSubtotal(): float
    {
        $subtotal = 0;
        foreach ($this->getProducts() as $product) {
            $subtotal += $product->getTotal();
        }
        return $subtotal;
    }

    public function getDiscountAmount(): float
    {
        $discountSubtotal = 0;

        if ($this->getSubtotal() >= self::DISCOUNT_THRESHOLD) {
            $discountSubtotal = self::DISCOUNT_PERCENT * ($this->getSubtotal() / 100);
        }

        return $discountSubtotal;
    }


    public function isDiscountApplied(): bool
    {
        $isDiscountApplied = false;

        if ($this->getSubtotal() > self::DISCOUNT_THRESHOLD){
            $isDiscountApplied = true;
        }
        
        return $isDiscountApplied;
    }

    public function getTotal(): float
    {   
        $getTotal = $this->getSubtotal() - $this->getDiscountAmount();
        return $getTotal;
    }  
}   