<?php
declare(strict_types=1);
require_once __DIR__ . '/src/Product.php';
require_once __DIR__ . '/src/Cart.php';
require_once __DIR__ . '/src/Display.php';
require_once __DIR__ . '/src/MenuHandler.php';

$display = new Display();

$cart = new Cart();

$menu = new Menu($cart, $display);
$menu->run();