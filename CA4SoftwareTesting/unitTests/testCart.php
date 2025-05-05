<?php
require_once '../../ThePlug/classes/Product.php';
require_once '../../ThePlug/classes/Cart.php';

$product1 = new Product(1, "Nike Air Max", 120.00, "Running shoes", "images/nikeairmax.png", "Shoes");
$product2 = new Product(2, "Adidas Ultraboost", 150.00, "Comfort running shoes", "images/adidasultra.png", "Shoes");

$cart = new Cart();

$cart->addToCart($product1, "Red", "9");

$cart->addToCart($product2, "Blue", "10");

$cart->addToCart($product1, "Red", "9");

$items = $cart->viewCart();
$total = $cart->calculateTotal();

if (count($items) === 2) {
    echo "✅ Test Passed: 2 unique items in cart.<br>";
} else {
    echo "❌ Test Failed: Incorrect number of unique items in cart.<br>";
}

$key = "1-red-9";
if (isset($items[$key]) && $items[$key]['quantity'] === 2) {
    echo "✅ Test Passed: Product quantity correctly incremented.<br>";
} else {
    echo "❌ Test Failed: Product quantity increment error.<br>";
}

if ($total === (120.00 * 2 + 150.00)) {
    echo "✅ Test Passed: Cart total calculated correctly.<br>";
} else {
    echo "❌ Test Failed: Cart total calculation error.<br>";
}

$cart->removeFromCart($product2, "Blue", "10");

$itemsAfterRemove = $cart->viewCart();
if (count($itemsAfterRemove) === 1) {
    echo "✅ Test Passed: Item removed successfully from cart.<br>";
} else {
    echo "❌ Test Failed: Item removal from cart failed.<br>";
}
?>
