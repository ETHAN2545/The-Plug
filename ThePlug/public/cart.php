<?php
require_once '../config.php';
require_once '../src/db_connect.php';
require_once '../common.php';
require_once '../includes/header.php';
require_once '../classes/Cart.php'; 

$cart = new Cart();

// remove item
if (isset($_GET['remove'])) {
    $cart->removeFromCart($_GET['remove']);
    header("Location: cart.php");
    exit;
}

// promo code form
$enteredCode = $_POST['promo_code'] ?? '';
if (!empty($enteredCode)) {
    $_SESSION['promo_code'] = $enteredCode;
}

// gets discount code from session
$promoCode = $_SESSION['promo_code'] ?? '';

// gets cart details with promo code if used
$cartInfo = $cart->getCartDetails($pdo, $promoCode);
$cartDetails = $cartInfo['items'];
$rawTotal = $cartInfo['raw_total'];
$discount = $cartInfo['discount'];
$finalTotal = $cartInfo['final_total'];

// random recommended products
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

                <form method="post" class="promo-form">
                    <label for="promo_code">Promo Code:</label>
                    <input type="text" name="promo_code" id="promo_code" value="<?= escape($promoCode) ?>" placeholder="Enter code">
                    <button type="submit">Apply</button>
                </form>

                <div class="total-section">
                    <p>Subtotal: €<?= number_format($rawTotal, 2) ?></p>
                    <?php if ($discount > 0): ?>
                        <p>Discount: -€<?= number_format($discount, 2) ?></p>
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

