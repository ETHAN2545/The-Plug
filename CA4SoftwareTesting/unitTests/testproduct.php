<?php
require_once '../../ThePlug/classes/Product.php';

$product = new Product(1, "Air Jordan 1 Retro", 199.99, "High-top sneakers", "images/airjordan1.png", "Sneakers");

if ($product->getId() === 1) {
    echo "✅ Test Passed: Product ID is correct.<br>";
} else {
    echo "❌ Test Failed: Product ID is incorrect.<br>";
}

if ($product->getName() === "Air Jordan 1 Retro") {
    echo "✅ Test Passed: Product Name is correct.<br>";
} else {
    echo "❌ Test Failed: Product Name is incorrect.<br>";
}

if ($product->getPrice() === 199.99) {
    echo "✅ Test Passed: Product Price is correct.<br>";
} else {
    echo "❌ Test Failed: Product Price is incorrect.<br>";
}

if ($product->getDescription() === "High-top sneakers") {
    echo "✅ Test Passed: Product Description is correct.<br>";
} else {
    echo "❌ Test Failed: Product Description is incorrect.<br>";
}

if ($product->getImageUrl() === "images/airjordan1.png") {
    echo "✅ Test Passed: Product Image URL is correct.<br>";
} else {
    echo "❌ Test Failed: Product Image URL is incorrect.<br>";
}

if ($product->getCategory() === "Sneakers") {
    echo "✅ Test Passed: Product Category is correct.<br>";
} else {
    echo "❌ Test Failed: Product Category is incorrect.<br>";
}
?>
