<?php

declare(strict_types=1);

class Product
{
    public function __construct(
       public readonly string $name,
       public readonly float $price,
       private int $quantity,
    ) {
        if ($name === '') {
            throw new  InvalidArgumentException("Name is a required field and can't be empty.");
        }

        if ($price <= 0) {
            throw new InvalidArgumentException("Price must be higher than 0");
        }

        if ($quantity < 1) {
            throw new InvalidArgumentException("Quantity must be higher than 0");
        }
    }

    public function getQuantity(): int
    {
       return $this->quantity;
    }

    public function increaseQuantity(): void
    {
        $this->quantity++;
    }

    public function getTotal(): float
    {
        $total = $this->quantity * $this->price;
        return $total;
    }

}
