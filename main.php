<?php
declare(strict_types=1);
require_once __DIR__ . '/src/Product.php';
require_once __DIR__ . '/src/Cart.php';
require_once __DIR__ . '/src/Display.php';
require_once __DIR__ . '/src/MenuHandler.php';

$display->printMenu();
try {
    $milk = new Product('Milk', 89.9, 1);
    $motherFucker = new Product('Mother Fucker', 589.9, 2);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "\n";
}


$cart = new Cart();
$cart->addProduct($milk);
$cart->addProduct($motherFucker);
echo $milk->getQuantity() . "\n";

$cart->addProduct($milk);
echo $milk->getQuantity() . "\n";

$display = new Display();

echo count($cart->getProducts()) . "\n";
var_dump($cart->getDiscountAmount());
var_dump($cart->getSubtotal());
var_dump($cart->isDiscountApplied());
var_dump($cart->getTotal());
var_dump($display->printCart($cart));
var_dump($display->printReceipt($cart));
var_dump($display->printDiscointProgress($cart));
//var_dump($display->printSuccess($message));
//var_dump($display->printError($message));
