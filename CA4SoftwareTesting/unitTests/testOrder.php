<?php
require_once '../../ThePlug/classes/Product.php';
require_once '../../ThePlug/classes/Order.php';

$product1 = new Product(1, "Nike Air Max", 120.00, "Running shoes", "images/nikeairmax.png", "Shoes");
$product2 = new Product(2, "Adidas Ultraboost", 150.00, "Comfort running shoes", "images/adidasultra.png", "Shoes");

$products = [$product1, $product2];
$order = new Order(5001, 101, $products, 270.00);

if ($order->getOrderID() === 5001) {
    echo "✅ Test Passed: Order ID is correct.<br>";
} else {
    echo "❌ Test Failed: Order ID is incorrect.<br>";
}

if ($order->getUserID() === 101) {
    echo "✅ Test Passed: User ID is correct.<br>";
} else {
    echo "❌ Test Failed: User ID is incorrect.<br>";
}

if ($order->getTotalAmount() === 270.00) {
    echo "✅ Test Passed: Order total amount is correct.<br>";
} else {
    echo "❌ Test Failed: Order total amount is incorrect.<br>";
}

if ($order->placeOrder() === true && $order->trackOrder() === "Placed") {
    echo "✅ Test Passed: Order placed successfully.<br>";
} else {
    echo "❌ Test Failed: Order placing failed.<br>";
}

if ($order->shipOrder() === true && $order->trackOrder() === "Shipped") {
    echo "✅ Test Passed: Order shipped successfully.<br>";
} else {
    echo "❌ Test Failed: Order shipping failed.<br>";
}

if ($order->deliverOrder() === true && $order->trackOrder() === "Delivered") {
    echo "✅ Test Passed: Order delivered successfully.<br>";
} else {
    echo "❌ Test Failed: Order delivery failed.<br>";
}
?>
