<?php
require_once '../../ThePlug/classes/Product.php';
require_once '../../ThePlug/classes/Cart.php';

//product we will use to test
$product = new Product(101, "Nike Air Force 1", 100.00, "Classic sneakers", "images/airforce1.png", "Sneakers");
$cart = new Cart();

function validateQuantity($quantity) {
    if (!is_numeric($quantity) || $quantity <= 0 || $quantity > 10) {
        return false;
    }
    return true;
}

//  Equivalence Class 1: Valid Quantity 1 to 10
echo validateQuantity(1) ? "✅ EC1 Passed: Quantity 1 is valid.<br>" : "❌ EC1 Failed: Quantity 1 should be valid.<br>";
echo validateQuantity(5) ? "✅ EC1 Passed: Quantity 5 is valid.<br>" : "❌ EC1 Failed: Quantity 5 should be valid.<br>";
echo validateQuantity(10) ? "✅ EC1 Passed: Quantity 10 is valid.<br>" : "❌ EC1 Failed: Quantity 10 should be valid.<br>";

//  Equivalence Class 2: Quantity 0
echo validateQuantity(0) ? "❌ EC2 Failed: Quantity 0 should be invalid.<br>" : "✅ EC2 Passed: Quantity 0 is invalid.<br>";

//  Equivalence Class 3: Negative Quantity
echo validateQuantity(-3) ? "❌ EC3 Failed: Quantity -3 should be invalid.<br>" : "✅ EC3 Passed: Quantity -3 is invalid.<br>";

//  Equivalence Class 4: Quantity greater than 10
echo validateQuantity(15) ? "❌ EC4 Failed: Quantity 15 should be invalid.<br>" : "✅ EC4 Passed: Quantity 15 is invalid.<br>";

//  Equivalence Class 5: Non-numeric Quantity
echo validateQuantity("abc") ? "❌ EC5 Failed: Non-numeric input should be invalid.<br>" : "✅ EC5 Passed: Non-numeric input correctly rejected.<br>";
?>
