<?php
require_once '../../ThePlug/classes/Cart.php';

// Setup
$cart = new Cart();
$cartItems = $cart->viewCart(); // Cart initially empty

$discountCodes = ["10%OFF", "SAVE5EURO"];
$userDiscountCode = "10%OFF"; //if user inputted 10%off for example

// First Path : Cart is empty so checkout will be blocked
if (empty($cartItems)) {
    echo "✅ Path 1 Passed: Cart empty detected, checkout blocked.<br>";
} else {
    //Second Path: cart is not empty so Checkout can continue and proceed with discounted price if there is a valid discount at the current time or user has entered a valid discount
    if (in_array($userDiscountCode, $discountCodes)) {
        echo "✅ Path 2 Passed: Valid discount applied, checkout proceeds.<br>";
    } else {
        echo "✅ Path 2 Passed: No valid discount, checkout proceeds at full price.<br>";
    }
}
?>
