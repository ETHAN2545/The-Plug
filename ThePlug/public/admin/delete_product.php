<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';

// checks if product ID is provided in URL
if (isset($_GET['id'])) {
    $product_id = (int) $_GET['id'];

    // deletes all variants linked to this product
    $stmt = $pdo->prepare("DELETE FROM product_variants WHERE product_id = ?");
    $stmt->execute([$product_id]);

    // deletes the product from product table
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$product_id]);

    // redirect back to products page with success message (referenced in readme as 3rd party the urlencode)
    header("Location: admin_products.php?message=" . urlencode("Product deleted."));
    exit;
}

<link rel="stylesheet" href="../../css/admin.css">
<link rel="stylesheet" href="../../css/form_product.css">

<div class="admin-main">
    <div class="form-container">
        <h2>Delete Product</h2>
        <p>No product ID provided. Please return to the <a href="admin_products.php">products list</a>.</p>
    </div>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
