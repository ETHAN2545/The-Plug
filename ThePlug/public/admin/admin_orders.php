<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';
require_once '../../classes/Order.php';

// check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in.php");
    exit;
}

$orderObj = new Order($pdo);

// update status if admin posts change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['action'])) {
    $orderId = (int) $_POST['order_id'];
    $action = $_POST['action'];

    if ($action === 'ship') {
        $orderObj->updateStatus($orderId, 'Shipped');
    } elseif ($action === 'cancel') {
        $orderObj->updateStatus($orderId, 'Cancelled');
    }
}

// get all orders
$orders = $orderObj->getAllOrders();
?>

<link rel="stylesheet" href="../../css/admin.css">
<link rel="stylesheet" href="../../css/view_order.css">

<div class="order-management">
    <h1>Manage Orders</h1>

    <div class="order-grid">
        <?php foreach ($orders as $order): ?>
            <div class="order-card">
                <h3>Order #<?= escape($order['id']) ?></h3>
                <p><strong>Customer:</strong> <?= escape($order['user_email']) ?></p>
                <p><strong>Payment:</strong> <?= escape($order['payment_method']) ?></p>
                <p><strong>Total:</strong> €<?= number_format($order['discount_total'] ?? $order['total'], 2) ?></p>
                <p><strong>Status:</strong> <?= escape($order['status']) ?></p>

                <form method="POST" class="order-actions">
                    <input type="hidden" name="order_id" value="<?= escape($order['id']) ?>">

                    <?php if ($order['status'] === 'Pending'): ?>
                        <button type="submit" name="action" value="ship" class="edit-btn">Mark as Shipped</button>
                        <button type="submit" name="action" value="cancel" class="delete-btn">Cancel Order</button>
                    <?php endif; ?>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
