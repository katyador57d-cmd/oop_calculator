<?php
declare(strict_types=1);
class Display {

    const MAINMENU = [
        "Добавить продукт в корзину" ,
        "Удалить товар из корзины" ,
        "Показать корзину" ,
        "Показать чек",
        "Выход"
    ];
    public function printMenu(): void
    {
        foreach(self::MAINMENU as $key => $menuOption) {
            echo $key+1 . "." . $menuOption . "\n";
        }

    }

    public function printCart(Cart $cart): void
    {
        echo "Ваша корзина" . "\n";
        echo "----------------" . "\n";
        foreach($cart->getProducts() as $product) {
            echo $product->name . ".    "  . $product->price  . "\n";
            echo "---------------". "\n";
            echo $product->getQuantity() . "шт. " . "\n";
            echo "----------------" . "\n";
            echo "ИТОГО: " . $product->getTotal()  . "\n";
            echo "_____________________" . "\n";
        } 
        echo "Всего товар на сумму: " . $cart->getSubtotal() . "\n";
    }

    public function printReceipt(Cart $cart): void
    {
        echo "________________________" . "\n";
        echo "ЧЕК" . "\n ";
        echo "________________________" . "\n" ;
        
        foreach($cart->getProducts() as $product) {
            echo $product->name . ":" . $product->getQuantity() . "шт- "  . $product->getTotal() . "руб" . "\n";
        }
        
        echo "Цена: " . $cart->getSubtotal() . "\n";
        echo "Скидка составила: " . $cart->getDiscountAmount() . "\n";
        echo  "Итог со скидкой: " . $cart->getTotal() . "\n";
        echo "_________________________" . "\n";
    }

    public function printDiscointProgress(Cart $cart)
    {
        $discountinprogress = 0;
        if($cart->getSubtotal() < Cart::DISCOUNT_THRESHOLD) {
            $discountinprogress = Cart::DISCOUNT_THRESHOLD - $cart->getSubtotal();
        } echo "До скидки не хватает: " . $discountinprogress . "\n";
    }

    public function printSuccess(string $message): void
    {
        echo "Успешно!" . $message . "\n";
    }

    public function printError(string $message): void
    {
        echo "Ошибка: " . $message . "\n";
    }

}