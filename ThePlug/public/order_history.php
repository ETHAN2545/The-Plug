<?php
require_once '../includes/header.php';
require_once '../config.php';
require_once '../src/db_connect.php';
require_once '../common.php';

// make sure user is signed in
if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php");
    exit;
}

// get the user ID from session
$userId = $_SESSION['user_id'];

// get all orders from current users session newest order first
$orderStmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$orderStmt->execute([$userId]);
$orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="../css/order_history.css">

<div class="order-history-container">
    <h1>Your Order History</h1>

    <?php if (empty($orders)): ?>
        <p class="no-orders">You have no past orders.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="order-box">
                <h2>Order #<?= escape($order['id']) ?> - <?= escape($order['created_at']) ?></h2>

                <?php if (!empty($order['discount_code']) && $order['discount_total'] < $order['total']): ?>
                    <p><strong>Original Total:</strong> <s>€<?= number_format($order['total'], 2) ?></s></p>
                    <p><strong>Discounted Total:</strong> €<?= number_format($order['discount_total'], 2) ?></p>
                    <p><strong>Promo Code Used:</strong> <?= escape($order['discount_code']) ?></p>
                <?php else: ?>
                    <p><strong>Total:</strong> €<?= number_format($order['total'], 2) ?></p>
                <?php endif; ?>

                <p><strong>Status:</strong> <?= escape($order['status']) ?></p>

                <?php
                $itemQuery = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
                $itemQuery->execute([$order['id']]);
                $items = $itemQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php foreach ($items as $item): ?>
                    <div class="order-item">
                        <div class="order-item-image">
                            <img src="../<?= escape($item['image_url']) ?>" alt="<?= escape($item['product_name']) ?>">
                        </div>
                        <div class="order-item-info">
                            <strong><?= escape($item['product_name']) ?></strong><br>
                            Size: <?= escape($item['size']) ?> |
                            Color: <?= escape($item['color']) ?><br>
                            Quantity: <?= intval($item['quantity']) ?> |
                            Price: €<?= number_format($item['price'], 2) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php require_once '../includes/footer.php'; ?>
