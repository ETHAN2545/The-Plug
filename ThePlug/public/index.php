<?php
require_once '../includes/header.php';
require_once '../common.php';
require_once '../src/db_connect.php';

try {
    // Get all products from the database
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();

    // save all products in a list
    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // make a reverse copy of the list to show newest first
    $newestProducts = array_reverse($allProducts);
} catch (PDOException $e) {
    // shows error if something goes wrong
    echo "<p style='color:red; text-align:center;'>Error fetching products: " . escape($e->getMessage()) . "</p>";
    exit;
}
?>

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/index.css">

<div class="slideshow-container">
    <div class="slides fade">
        <img src="../images/banner1.jpg" alt="Banner 1">
    </div>
    <div class="slides fade">
        <img src="../images/banner2.jpg" alt="Banner 2">
    </div>
    <div class="slides fade">
        <img src="../images/banner3.jpg" alt="Banner 3">
    </div>

    <div class="dot-container">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</div>

<div class="homepage-container">
    <div class="recommended-section">
        <h2 class="section-title">Recommended For You</h2>
        <div class="product-grid">
            <?php
            $count = 0;
            foreach ($allProducts as $product):
                if ($count >= 4) break;
            ?>
                <div class="product-card">
                    <a href="product_detail.php?id=<?= escape($product['id']) ?>">
                        <img src="../<?= escape($product['image_url']) ?>" alt="<?= escape($product['name']) ?>">
                        <h3><?= escape($product['name']) ?></h3>
                    </a>
                    <p class="price">€<?= number_format($product['price'], 2) ?></p>
                </div>
            <?php
            $count++;
            endforeach;
            ?>
        </div>
        <div class="view-more-container">
            <a href="products.php"><button class="view-more-btn">View Other Products</button></a>
        </div>
    </div>

    <div class="recommended-section">
        <h2 class="section-title">Latest Products</h2>
        <div class="product-grid">
            <?php
            $count = 0;
            foreach ($newestProducts as $product):
                if ($count >= 4) break;
            ?>
                <div class="product-card">
                    <a href="product_detail.php?id=<?= escape($product['id']) ?>">
                        <img src="../<?= escape($product['image_url']) ?>" alt="<?= escape($product['name']) ?>">
                        <h3><?= escape($product['name']) ?></h3>
                    </a>
                    <p class="price">€<?= number_format($product['price'], 2) ?></p>
                </div>
            <?php
            $count++;
            endforeach;
            ?>
        </div>
    </div>
</div>

<script src="../js/homepage.js"></script>
<script src="../js/nav.js"></script>
<?php require_once '../includes/footer.php'; ?>
