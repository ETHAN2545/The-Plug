<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';
require_once '../../classes/Product.php';

$productObj = new Product($pdo);
$products = $productObj->getAllProducts();

// get any success message passed in the URL
$message = $_GET['message'] ?? null;
?>

<link rel="stylesheet" href="../../css/view_products.css">

<div class="admin-main">
    <h2>All Products</h2>

    <?php if (!empty($message)): ?>
        <p class="success-message"><?= escape($message) ?></p>
    <?php endif; ?>

    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?= '../../' . ltrim(escape($product['image_url']), '/') ?>" alt="<?= escape($product['name']) ?>">
                <h3><?= escape($product['name']) ?></h3>
                <p class="category"><?= escape($product['category']) ?></p>
                <p class="price">€<?= number_format($product['price'], 2) ?></p>
                <p class="description"><?= escape($product['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
