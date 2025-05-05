<?php
require_once '../includes/header.php';
require_once '../config.php';
require_once '../src/db_connect.php';
require_once '../common.php';

// get cart items from session
$cartItems = $_SESSION['cart'] ?? [];
$total = 0;

// add up prices for everything in the cart
foreach ($cartItems as $item) {
    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->execute([$item['product_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $total += $product['price'] * $item['quantity'];
    }
}

// start with no discount
$discountAmount = 0;
$discountCode = '';

// check if a discount is active
$stmt = $pdo->prepare("SELECT * FROM discounts WHERE is_active = 1 LIMIT 1");
$stmt->execute();
$activeDiscount = $stmt->fetch(PDO::FETCH_ASSOC);

if ($activeDiscount) {
    $discountCode = $activeDiscount['code'];

    // work out discount
    if ($activeDiscount['type'] === 'percent') {
        $discountAmount = ($total * $activeDiscount['amount']) / 100;
    } elseif ($activeDiscount['type'] === 'fixed') {
        $discountAmount = $activeDiscount['amount'];
    }

    // save discount info to session
    $_SESSION['discount_code'] = $discountCode;
    $_SESSION['discount_type'] = $activeDiscount['type'];
    $_SESSION['discount_amount_value'] = $activeDiscount['amount'];
}

// take discount off the total
$finalTotal = max(0, $total - $discountAmount);
?>


<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/checkout.css">

<div class="checkout-container">
    <h1>Checkout</h1>

    <form action="checkout_handler.php" method="post" class="checkout-form">

        <h2>Delivery Details</h2>
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="contact" placeholder="Contact Number" required>

        <h2>Payment</h2>
        <select name="payment_method" required>
            <option value="">Select Payment Method</option>
            <option value="Visa">Visa</option>
            <option value="MasterCard">MasterCard</option>
            <option value="Revolut">Revolut</option>
            <option value="PayPal">PayPal</option>
        </select>
        <input type="text" name="card_name" placeholder="Cardholder Name" required>
        <input type="text" name="card_number" placeholder="Card Number" maxlength="16" pattern="\d{13,16}" required>
        <input type="text" name="expiry" placeholder="MM/YY" required>
        <input type="text" name="cvv" placeholder="CVV" maxlength="4" pattern="\d{3,4}" required>

        <h2>Review Order</h2>
        <div class="order-summary">
            <?php foreach ($cartItems as $item): 
                $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                $stmt->execute([$item['product_id']]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$product) continue;
            ?>
            <div class="review-item">
                <img src="../<?= escape($product['image_url']) ?>" width="100">
                <div>
                    <p><strong><?= escape($product['name']) ?></strong></p>
                    <p>Color: <?= escape($item['color']) ?> | Size: <?= escape($item['size']) ?> | Qty: <?= intval($item['quantity']) ?></p>
                    <p>€<?= number_format($product['price'] * $item['quantity'], 2) ?></p>
                </div>
            </div>
            <?php endforeach; ?>

            <hr>
            <p><strong>Subtotal:</strong> €<?= number_format($total, 2) ?></p>
            <?php if ($discountAmount > 0): ?>
                <p><strong>Discount:</strong> -€<?= number_format($discountAmount, 2) ?></p>
                <?php if (!empty($discountBanner)): ?>
                    <p class="success-message"><?= escape($discountBanner) ?></p>
                <?php endif; ?>
            <?php endif; ?>
            <p><strong>Total:</strong> €<?= number_format($finalTotal, 2) ?></p>
        </div>

        <input type="hidden" name="finalize_order" value="1">
        <button type="submit" class="confirm-btn">Confirm Checkout</button>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>
