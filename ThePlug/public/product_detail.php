<?php
require_once '../includes/header.php';
require_once '../config.php';
require_once '../src/db_connect.php';
require_once '../common.php';

// get product id from url
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// stop if no id or invalid
if (!$product_id) {
    echo "<p>Product not found.</p>";
    require_once '../includes/footer.php';
    exit;
}

// get product info
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// stop if product doesn't exist
if (!$product) {
    echo "<p>Product not found.</p>";
    require_once '../includes/footer.php';
    exit;
}

// get available variants for the product
$stmt = $pdo->prepare("SELECT color, size, quantity FROM product_variants WHERE product_id = ?");
$stmt->execute([$product_id]);
$variants = $stmt->fetchAll(PDO::FETCH_ASSOC);

// only keep colors and sizes that are in stock
$colors = [];
$sizes = [];

foreach ($variants as $variant) {
    if ($variant['quantity'] > 0) {
        $colors[$variant['color']] = true;
        $sizes[$variant['size']] = true;
    }
}

// handle add to cart form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $quantity = 1;
    $color = $_POST['color'] ?? '';
    $size = $_POST['size'] ?? '';

    // if user picked both then add to cart will work
    if ($color && $size) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'color' => $color,
            'size' => $size
        ];

        header("Location: cart.php");
        exit;
    } else {
        // show error if missing color or size
        echo "<p style='color:red;'>Please select color and size.</p>";
    }
}

// get 4 other products to show as related
$stmt = $pdo->prepare("SELECT * FROM products WHERE id != ? LIMIT 4");
$stmt->execute([$product_id]);
$relatedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<link rel="stylesheet" href="../css/product_detail.css">
<link rel="stylesheet" href="../css/style.css">

<div class="product-detail-page">
    <div class="product-container">
        <div class="product-image-container">
            <img src="../<?= escape($product['image_url']) ?>" alt="<?= escape($product['name']) ?>" class="product-image">
        </div>

        <div class="product-info">
            <h1><?= escape($product['name']) ?></h1>
            <p class="product-price">€<?= number_format($product['price'], 2) ?></p>
            <p class="product-description"><?= nl2br(escape($product['description'])) ?></p>

            <form method="post" class="variant-form">
                <label for="color">Color</label>
                <select name="color" required>
                    <option value="">Select Color</option>
                    <?php foreach ($colors as $color => $_): ?>
                        <option value="<?= escape($color) ?>"><?= escape($color) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="size">Size</label>
                <select name="size" required>
                    <option value="">Select Size</option>
                    <?php foreach ($sizes as $size => $_): ?>
                        <option value="<?= escape($size) ?>"><?= escape($size) ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>
            </form>
        </div>
    </div>

    <div class="related-section">
        <h2>Related Products</h2>
        <div class="related-grid">
            <?php foreach ($relatedProducts as $related): ?>
                <div class="related-card">
                    <a href="product_detail.php?id=<?= escape($related['id']) ?>">
                        <img src="../<?= escape($related['image_url']) ?>" alt="<?= escape($related['name']) ?>">
                        <h4><?= escape($related['name']) ?></h4>
                        <p class="price">€<?= number_format($related['price'], 2) ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>
