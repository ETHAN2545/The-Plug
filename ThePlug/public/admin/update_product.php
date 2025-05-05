<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';

// checks if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in.php");
    exit;
}

// checks if product ID is in the url
if (!isset($_GET['id'])) {
    echo '<p style="color:red; text-align:center;">Product ID missing.</p>';
    require_once '../../includes/admin_footer.php';
    exit;
}

$productId = (int) $_GET['id'];

// gets the product info
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// sends error message if product doesnt exist
if (!$product) {
    echo '<p style="color:red; text-align:center;">Product not found.</p>';
    require_once '../../includes/admin_footer.php';
    exit;
}

// gets the current variants for the current product
$variantStmt = $pdo->prepare("SELECT * FROM product_variants WHERE product_id = ?");
$variantStmt->execute([$productId]);
$variants = $variantStmt->fetchAll(PDO::FETCH_ASSOC);

// if no variant session yet, set it with current ones
if (!isset($_SESSION['variants'])) {
    $_SESSION['variants'] = $variants;
}

// when admin adds a new variant it gets stored in the session list so it can be shown or saved later
if (isset($_POST['add_variant'])) {
    $color = $_POST['variant_color'] ?? '';
    $size = $_POST['variant_size'] ?? '';
    $quantity = (int) ($_POST['variant_quantity'] ?? 0);

    if ($color && $size && $quantity > 0) {
        $_SESSION['variants'][] = [
            'color' => $color,
            'size' => $size,
            'quantity' => $quantity
        ];
    }
}
// gets new values for the product fields after admin clicks "Update Product"
if (isset($_POST['update_product'])) {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $imageUrl = $_POST['image_url'] ?? '';
    $category = $_POST['category'] ?? '';

    // updates the main product info
    $update = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ?, image_url = ?, category = ? WHERE id = ?");
    $update->execute([$name, $price, $description, $imageUrl, $category, $productId]);

    // removes old variants
    $pdo->prepare("DELETE FROM product_variants WHERE product_id = ?")->execute([$productId]);

    // inserts updated variant list
    foreach ($_SESSION['variants'] as $variant) {
        $pdo->prepare("INSERT INTO product_variants (product_id, color, size, quantity) VALUES (?, ?, ?, ?)")
            ->execute([$productId, $variant['color'], $variant['size'], $variant['quantity']]);
    }

    // clears variant session and redirects back to read products
    unset($_SESSION['variants']);
    header("Location: read_products.php?message=Product updated successfully.");
    exit;
}
?>

<link rel="stylesheet" href="../../css/admin.css">
<link rel="stylesheet" href="../../css/form_product.css">

<div class="form-container">
    <h2>Update Product</h2>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= escape($product['name']) ?>" required>

        <label>Price (€):</label>
        <input type="number" step="0.01" name="price" value="<?= escape($product['price']) ?>" required>

        <label>Description:</label>
        <textarea name="description" rows="4" required><?= escape($product['description']) ?></textarea>

        <label>Image URL:</label>
        <input type="text" name="image_url" value="<?= escape($product['image_url']) ?>" required>

        <label>Category:</label>
        <select name="category" required>
            <?php
            $categories = ['Sneakers', 'Hoodie', 'Jacket', 'T-Shirt', 'Sweatshirt', 'Shoes', 'Jersey'];
            foreach ($categories as $cat):
                $selected = ($product['category'] === $cat) ? 'selected' : '';
            ?>
                <option value="<?= escape($cat) ?>" <?= $selected ?>><?= escape($cat) ?></option>
            <?php endforeach; ?>
        </select>

        <hr>

        <h3>Add Variant</h3>

        <label>Color:</label>
        <select name="variant_color">
            <option value="">Select Color</option>
            <?php
            $colors = ['Black', 'White', 'Red', 'Blue', 'Grey'];
            foreach ($colors as $color):
            ?>
                <option value="<?= escape($color) ?>"><?= escape($color) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Size:</label>
        <select name="variant_size">
            <option value="">Select Size</option>
            <?php
            $sizes = ['8', '9', '10', '11', 'S', 'M', 'L', 'XL'];
            foreach ($sizes as $size):
            ?>
                <option value="<?= escape($size) ?>"><?= escape($size) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Quantity:</label>
        <input type="number" name="variant_quantity" min="1" placeholder="Stock quantity">

        <button type="submit" name="add_variant" class="add-variant-btn">Add Variant</button>

        <h3>Current Variants</h3>
        <ul class="variant-list">
            <?php if (!empty($_SESSION['variants'])): ?>
                <?php foreach ($_SESSION['variants'] as $variant): ?>
                    <li><?= escape($variant['color']) ?> | <?= escape($variant['size']) ?> | Stock: <?= escape($variant['quantity']) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No variants added yet.</li>
            <?php endif; ?>
        </ul>

        <button type="submit" name="update_product" class="submit-product-btn">Update Product</button>
    </form>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
