<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../common.php';
require_once '../../src/db_connect.php';
require_once '../../classes/Product.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo '<p style="color:red; text-align:center;">Product ID missing.</p>';
    require_once '../../includes/admin_footer.php';
    exit;
}

$productId = (int) $_GET['id'];
$productObj = new Product($pdo);
$product = $productObj->getProductById($productId);

if (!$product) {
    echo '<p style="color:red; text-align:center;">Product not found.</p>';
    require_once '../../includes/admin_footer.php';
    exit;
}

$variants = $productObj->getVariants($productId);

// add variant form
if (isset($_POST['add_variant'])) {
    $color = $_POST['variant_color'] ?? '';
    $size = $_POST['variant_size'] ?? '';
    $quantity = (int) ($_POST['variant_quantity'] ?? 0);

    if ($color && $size && $quantity > 0) {
        // prevent duplicate
        $exists = false;
        foreach ($variants as $v) {
            if ($v['color'] === $color && $v['size'] === $size) {
                $exists = true;
                break;
            }
        }
        if (!$exists) {
            $productObj->addVariant($productId, $color, $size, $quantity);
            header("Location: update_product.php?id=" . $productId);
            exit;
        }
    }
}

// update product form
if (isset($_POST['update_product'])) {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $imageUrl = $_POST['image_url'] ?? '';
    $category = $_POST['category'] ?? '';

    $productObj->updateProduct($productId, $name, $price, $description, $imageUrl, $category);
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
            <?php if (!empty($variants)): ?>
                <?php foreach ($variants as $variant): ?>
                    <li><?= escape($variant['color']) ?> | <?= escape($variant['size']) ?> | Stock: <?= escape($variant['quantity']) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No variants found.</li>
            <?php endif; ?>
        </ul>

        <button type="submit" name="update_product" class="submit-product-btn">Update Product</button>
    </form>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
