<?php
declare(strict_types=1);
class Menu {

    public function __construct(
        private readonly Cart $cart,
        private readonly Display $display,
    )
    {
        
    }

    public function run(): void
    {
        while (true) {
        $this->display->printMenu();
        $mainMenu = $this->readInt("Введите ваше число: ");
        switch($mainMenu){
            case 1:
                $this->handleAddProduct();
                break;
            case 2:
                $this->handleRemoveProduct();
                break;
            case 3:
                $this->handleShowCart();
                break;
            case 4:
                $this->handleCheckout();
                break;
            case 5: 
                die;
                break;
            }
        }
    }

    private function handleAddProduct(): void
    {
        $name = $this->readLine("Название: ");
        $price = $this->readFloat("Цена: ");
        $quantity = $this->readInt("Количество: ");

    try {
        $product = new Product($name, $price, $quantity);
        $this->cart->addProduct($product);
        $this->display->printSuccess("Товар добавлен!!");
    } catch (InvalidArgumentException $e){
        $this->display->printError($e->getMessage());
    }
}

    private function handleRemoveProduct(): void
    {
        $this->display->printCart($this->cart);
        $index = $this->readInt("Введите ваш номер: ");
        $products = $this->cart->getProducts();

        if(!isset($products[$index])) {
            echo "Неверный номер";
        return;
        }
        $product = $products[$index];
        $this->cart->removeProduct($product);
        echo "Товар удален";
    }

    private function readLine(string $prompt): string
    {
        return  readLine($prompt);
    }

    private function readInt(string $prompt): int
    {
        return (int)readLine($prompt);
    }

    private function readFloat(string $prompt): float
    {
        return (float) readLine($prompt);
    }

    private function handleShowCart(): void
    {
        $this->display->printCart($this->cart);
    }
    
    private function handleCheckout(): void
    {
        $this->display->printReceipt($this->cart);
    }
}
