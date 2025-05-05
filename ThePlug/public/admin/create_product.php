<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';

// checks if a variant is being added, then grabs color, size, and quantity from form
if (!isset($_SESSION['variants'])) {
    $_SESSION['variants'] = [];
}

// when admin adds a variant before submitting the product
if (isset($_POST['add_variant'])) {
    $color = $_POST['variant_color'] ?? '';
    $size = $_POST['variant_size'] ?? '';
    $quantity = isset($_POST['variant_quantity']) ? (int) $_POST['variant_quantity'] : 0;

    // only lets admin add if all fields are filled and quantity is more than 0
    if ($color && $size && $quantity > 0) {
        $_SESSION['variants'][] = [
            'color' => escape($color),
            'size' => escape($size),
            'quantity' => $quantity
        ];
    }
}

// if the main product form is submitted, collect the product details from input fields
if (isset($_POST['submit_product'])) {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $image_url = $_POST['image_url'] ?? '';
    $category = $_POST['category'] ?? '';

    // check required product fields
    if ($name && $price && $description && $image_url && $category) {
        // creates main product in database
        $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image_url, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $price, $description, $image_url, $category]);

        $product_id = $pdo->lastInsertId(); // get the new product's ID

        // creates each variant for that product
        foreach ($_SESSION['variants'] as $variant) {
            $stmt = $pdo->prepare("INSERT INTO product_variants (product_id, color, size, quantity) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $product_id,
                $variant['color'],
                $variant['size'],
                $variant['quantity']
            ]);
        }

        // clears the variant list after submission
        unset($_SESSION['variants']);

        $success = escape($name) . " successfully added.";
    }
}
?>


<link rel="stylesheet" href="../../css/form_product.css">
<link rel="stylesheet" href="../../css/admin.css">

<div class="form-container">
    <h2>Add New Product</h2>

    <?php if (isset($success)): ?>
        <p class="success-message"><?= $success ?></p>
    <?php endif; ?>

    <form method="POST">
        <h3>Main Product Info</h3>

        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Price (€):</label>
        <input type="number" step="0.01" name="price" required>

        <label>Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Image URL:</label>
        <input type="text" name="image_url" required>

        <label>Category:</label>
        <select name="category" required>
            <?php
            $categories = ['Sneakers', 'Hoodie', 'Jacket', 'T-Shirt', 'Sweatshirt', 'Shoes', 'Jersey'];
            foreach ($categories as $cat): ?>
                <option value="<?= escape($cat) ?>"><?= escape($cat) ?></option>
            <?php endforeach; ?>
        </select>

        <hr>

        <h3>Add Variant</h3>

        <label>Color:</label>
        <select name="variant_color">
            <option value="">Select Color</option>
            <?php foreach (['Black', 'White', 'Red', 'Blue', 'Grey'] as $color): ?>
                <option value="<?= escape($color) ?>"><?= escape($color) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Size:</label>
        <select name="variant_size">
            <option value="">Select Size</option>
            <?php foreach (['8', '9', '10', '11', 'S', 'M', 'L', 'XL'] as $size): ?>
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

        <button type="submit" name="submit_product" class="submit-product-btn">Add Product</button>
    </form>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
