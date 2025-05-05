<?php
require_once '../includes/header.php';
require_once '../config.php';
require_once '../src/db_connect.php';
require_once '../common.php';

// gets selected filters from the form they show up in the URL because the form uses get method
$category = $_GET['category'] ?? '';
$color = $_GET['color'] ?? '';
$size = $_GET['size'] ?? '';

// get all products
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// make a new list for filtered stuff
$filteredProducts = [];

// check each product
foreach ($allProducts as $product) {
    $matches = true;

    // if category filter set and doesn't match
    if ($category !== '' && $product['category'] !== $category) {
        $matches = false;
    }

    // if color filter set and doesn't match
    if ($color !== '' && $product['color'] !== $color) {
        $matches = false;
    }

    // if size filter set and doesn't match
    if ($size !== '' && $product['size'] !== $size) {
        $matches = false;
    }

    // add product to list if it passed all the checks
    if ($matches) {
        $filteredProducts[] = $product;
    }
}

// filter for dropdown options
$categories = ['Sneakers', 'Shoes', 'Sweatshirt', 'Hoodie', 'Jersey', 'Jacket', 'T-Shirt'];
$colors = ['Red', 'Black', 'White'];
$sizes = ['8', '9', '10', 'M'];
?>


<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/product.css">

<div class="products-wrapper">
    <aside class="sidebar">
        <form method="get" class="filter-form">
            <h3>Filters</h3>

            <label for="category">Category</label>
            <select name="category" id="category">
                <option value="">All Categories</option>
                <?php foreach ($categories as $item): ?>
                    <option value="<?= escape($item) ?>" <?= ($category === $item) ? 'selected' : '' ?>>
                        <?= escape($item) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="color">Color</label>
            <select name="color" id="color">
                <option value="">All Colors</option>
                <?php foreach ($colors as $item): ?>
                    <option value="<?= escape($item) ?>" <?= ($color === $item) ? 'selected' : '' ?>>
                        <?= escape($item) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="size">Size</label>
            <select name="size" id="size">
                <option value="">All Sizes</option>
                <?php foreach ($sizes as $item): ?>
                    <option value="<?= escape($item) ?>" <?= ($size === $item) ? 'selected' : '' ?>>
                        <?= escape($item) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="filter-btn">Apply Filters</button>
        </form>
    </aside>

    <main class="product-results">
        <h2>Browse Products</h2>

        <?php if (empty($filteredProducts)): ?>
            <p class="no-results">No products found.</p>
        <?php else: ?>
            <div class="product-grid">
                <?php foreach ($filteredProducts as $product): ?>
                    <div class="product-card">
                        <a href="product_detail.php?id=<?= escape($product['id']) ?>">
                            <img src="../<?= escape($product['image_url']) ?>" alt="<?= escape($product['name']) ?>">
                            <h3><?= escape($product['name']) ?></h3>
                        </a>
                        <p class="price">€<?= number_format($product['price'], 2) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</div>
<?php require_once '../includes/footer.php'; ?>
