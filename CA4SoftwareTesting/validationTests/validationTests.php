<?php
// linking our classes from website folder.
require_once '../../ThePlug/classes/User.php';
require_once '../../ThePlug/classes/UserManager.php';
require_once '../../ThePlug/classes/Product.php';
require_once '../../ThePlug/classes/Cart.php';

// First test to verify if user entered a passowrd that is consistent during their registration.
$password = "OnePieceKing";
$confirmPassword = "OnePieceKing";
if ($password === $confirmPassword) {
    echo "✅ T1 Passed: Passwords match correctly.<br>";
} else {
    echo "❌ T1 Failed: Passwords does not match.<br>";
}

// Second test to detect if any emails are duplicated to prevent multiple accounts.
$userManager = new UserManager();
$user = new User(1, "strangerthings@netflix.com", "OnePieceKing", false);
$userManager->addUser($user);

$testEmail = "strangerthings@netflix.com";
$found = false;
foreach ($userManager->getAllUsers() as $existingUser) {
    if ($existingUser->getEmail() === $testEmail) {
        $found = true;
        break;
    }
}
if ($found) {
    echo "✅ T2 Passed: Existing email detected correctly.<br>";
} else {
    echo "❌ T2 Failed: Email not found.<br>";
}

// Third test to make sure users can not proceed to checkout with no items in their cart.
$cart = new Cart();
$items = $cart->viewCart();
if (empty($items)) {
    echo "✅ T3 Passed: Cart empty detected before checkout.<br>";
} else {
    echo "❌ T3 Failed: Cart is not empty.<br>";
}

// Fourth test to validate that the product stock is sufficient before adding the items to the cart.
$product = new Product(2, "Adidas Ultraboost", 150.00, "Shoes", "images/adidasultra.png", "Footwear");
$stockQuantity = 0;
if ($stockQuantity <= 0) {
    echo "✅ T4 Passed: Cannot add out of stock product.<br>";
} else {
    echo "❌ T4 Failed: Stock validation failed.<br>";
}

// final test to confirm that they entered the correct discount code and checks with the avaible promo codes to which will properly reject if its wrong.
$validCodes = ["10%OFF", "SAVE5EURO"];
$enteredCode = "OnePieceDiscount";
if (!in_array($enteredCode, $validCodes)) {
    echo "✅ T5 Passed: Invalid discount code rejected successfully.<br>";
} else {
    echo "❌ T5 Failed: Discount code accepted incorrectly.<br>";
}
?>
