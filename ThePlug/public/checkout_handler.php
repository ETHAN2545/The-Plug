<?php
require_once '../config.php';
require_once '../src/db_connect.php';
require_once '../common.php';

// make sure user is allowed to checkout
if (!isset($_POST['finalize_order']) || !isset($_SESSION['cart']) || !isset($_SESSION['user_id'])) {
    header("Location: checkout.php");
    exit;
}

// get cart and user info
$cart = $_SESSION['cart'];
$userId = $_SESSION['user_id'];
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'guest@site.com';

// get info from form
$fullName = $_POST['full_name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$paymentMethod = $_POST['payment_method'];

// work out cart total
$total = 0;
foreach ($cart as $item) {
    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->execute([$item['product_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $total += $product['price'] * $item['quantity'];
    }
}

// get discount from session
$discountCode = $_SESSION['discount_code'] ?? '';
$discountType = $_SESSION['discount_type'] ?? '';
$discountValue = $_SESSION['discount_amount_value'] ?? 0;

// work out discount amount
$discountAmount = 0;
if ($discountType === 'percent') {
    $discountAmount = $total * ($discountValue / 100);
} elseif ($discountType === 'fixed') {
    $discountAmount = $discountValue;
}

// final total can’t go below 0
$finalTotal = $total - $discountAmount;
if ($finalTotal < 0) {
    $finalTotal = 0;
}

// save order to database
$stmt = $pdo->prepare("INSERT INTO orders 
    (user_id, user_email, full_name, address, contact, payment_method, discount_code, total, discount_total, status) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->execute([
    $userId,
    $email,
    $fullName,
    $address,
    $contact,
    $paymentMethod,
    $discountCode,
    $total,
    $finalTotal,
    'Pending'
]);

// get order ID that was just made
$orderId = $pdo->lastInsertId();

// save each item from cart into order_items
foreach ($cart as $item) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$item['product_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $itemInsert = $pdo->prepare("INSERT INTO order_items 
            (order_id, product_id, product_name, price, quantity, color, size, image_url) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $itemInsert->execute([
            $orderId,
            $item['product_id'],
            $product['name'],
            $product['price'],
            $item['quantity'],
            $item['color'],
            $item['size'],
            $product['image_url']
        ]);

        // lower stock for that product variant
        $update = $pdo->prepare("UPDATE product_variants 
            SET quantity = quantity - ? 
            WHERE product_id = ? AND color = ? AND size = ?");

        $update->execute([
            $item['quantity'],
            $item['product_id'],
            $item['color'],
            $item['size']
        ]);
    }
}

// clear cart and discount from session
unset($_SESSION['cart']);
unset($_SESSION['discount_code']);
unset($_SESSION['discount_type']);
unset($_SESSION['discount_amount_value']);

// goes to order history once they cick confirma checkout
header("Location: ../public/order_history.php");
exit;
