<?php
require_once '../config.php';
require_once '../src/db_connect.php'; 
require_once '../common.php';
require_once '../includes/header.php';

// stop if database connection doesnt work as a satefy feature
if (!isset($pdo)) {
    exit('Database connection not established.');
}

// if user clicks remove, delete item from cart
if (isset($_GET['remove'])) {
    $key = $_GET['remove'];
    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]);
    }
    header("Location: cart.php");
    exit;
}

// gets items from session cart
$cartItems = $_SESSION['cart'] ?? [];
$cartDetails = [];
$total = 0;

// loops through each cart item
foreach ($cartItems as $key => $item) {
    // gets product info from database
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$item['product_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // works out item total
        $subtotal = $product['price'] * $item['quantity'];
        $total += $subtotal;

        // adds to cart list along with details
        $cartDetails[] = [
            'key' => $key,
            'product' => $product,
            'quantity' => $item['quantity'],
            'color' => $item['color'],
            'size' => $item['size'],
            'subtotal' => $subtotal
        ];
    }
}

//checks if discount is active
$discountAmount = 0;

$stmt = $pdo->prepare("SELECT * FROM discounts WHERE is_active = 1 LIMIT 1");
$stmt->execute();
$activeDiscount = $stmt->fetch(PDO::FETCH_ASSOC);

if ($activeDiscount) {
    if ($activeDiscount['type'] === 'percent') {
        $discountAmount = ($total * $activeDiscount['amount']) / 100;
    } elseif ($activeDiscount['type'] === 'fixed') {
        $discountAmount = $activeDiscount['amount'];
    }
}


// take discount off total
$finalTotal = max(0, $total - $discountAmount);

// gets 4 random products for the recommendations ection
$stmt = $pdo->prepare("SELECT * FROM products LIMIT 4");
$stmt->execute();
$recommendedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../css/cart.css">
<link rel="stylesheet" href="../css/style.css">

<div class="cart-container">
    <h2 class="cart-title">Your Shopping Cart</h2>

    <?php if (empty($cartDetails)): ?>
        <p class="empty-cart">Your cart is empty.</p>
    <?php else: ?>
        <div class="cart-content">
            <div class="cart-items">
                <?php foreach ($cartDetails as $item): ?>
                    <div class="cart-item-box">
                        <img src="../<?= escape($item['product']['image_url']) ?>" alt="<?= escape($item['product']['name']) ?>">
                        <div class="item-details">
                            <h4><?= escape($item['product']['name']) ?></h4>
                            <p>Color: <?= escape($item['color']) ?></p>
                            <p>Size: <?= escape($item['size']) ?></p>
                            <p>Price: €<?= number_format($item['product']['price'], 2) ?></p>
                            <p>Quantity: <?= intval($item['quantity']) ?></p>
                            <a class="remove-btn" href="?remove=<?= escape($item['key']) ?>">Remove</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h3>Order Summary</h3>

                <div class="total-section">
                    <p>Subtotal: €<?= number_format($total, 2) ?></p>
                    <?php if ($discountAmount > 0): ?>
                        <p>Discount: -€<?= number_format($discountAmount, 2) ?></p>
                    <?php endif; ?>
                    <strong>Total: €<?= number_format($finalTotal, 2) ?></strong>
                </div>

                <div class="checkout-buttons">
                    <a href="checkout.php"><button class="checkout-btn">Proceed to Checkout</button></a>
                    <a href="products.php"><button class="continue-btn">Continue Shopping</button></a>
                </div>
            </div>
        </div>

        <div class="recommendation-section">
            <h3>You Might Also Like</h3>
            <div class="recommendation-grid">
                <?php foreach ($recommendedProducts as $rec): ?>
                    <div class="recommendation-card">
                        <a href="product_detail.php?id=<?= escape($rec['id']) ?>">
                            <img src="../<?= escape($rec['image_url']) ?>" alt="<?= escape($rec['name']) ?>">
                            <h4><?= escape($rec['name']) ?></h4>
                            <p class="price">€<?= number_format($rec['price'], 2) ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php require_once '../includes/footer.php'; ?>
