<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';
require_once '../../classes/Product.php';

if (isset($_GET['id'])) {
    $productId = (int) $_GET['id'];

    $productObj = new Product($pdo);
    $product = $productObj->getProductById($productId);

    if ($product) {
        $productObj->deleteProduct($productId);
        header("Location: admin_products.php?message=" . urlencode("Product deleted."));
        exit;
    } else {
        $error = "Product not found.";
    }
} else {
    $error = "Product ID not provided.";
}
?>

<link rel="stylesheet" href="../../css/admin.css">
<link rel="stylesheet" href="../../css/form_product.css">

<div class="admin-main">
    <div class="form-container">
        <h2>Delete Product</h2>
        <?php if (!empty($error)): ?>
            <p style="color:red; text-align:center;"><?= escape($error) ?></p>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
