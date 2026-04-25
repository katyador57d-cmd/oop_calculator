<?php
declare(strict_types=1);
require_once __DIR__ . '/src/Product.php';
require_once __DIR__ . '/src/Cart.php';
require_once __DIR__ . '/src/Display.php';
require_once __DIR__ . '/src/MenuHandler.php';


try {
    $milk = new Product('Milk', 89.9, 1);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "\n";
}

echo $milk->name;

