<?php
require_once 'db_connect.php';
$db = new Database();
$stmt = $db->query("SELECT id, name, brand, category, price, description, image FROM products");
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Plug - Products</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/products.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-logo"><a href="index.php">The Plug</a></div>
    <div class="nav-search">
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="Search products">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="nav-auth">
        <a href="sign_in.php">Sign In</a>
        <a href="sign_out.php">Sign Out</a>
    </div>
</nav>
<main>
    <section class="product-gallery">
        <div class="products">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<a href="product-details.php?id=' . $row["id"] . '" class="product-item">
                        <img src="' . $row["image"] . '" alt="' . $row["name"] . '">
                        <h3>' . $row["name"] . '</h3>
                        <p class="price">€' . $row["price"] . '</p>
                        <div class="product-description">
                            <p>' . $row["description"] . '</p>
                        </div>
                    </a>';
                }
            } else {
                echo "<p>No products available.</p>";
            }
            ?>
        </div>
    </section>
</main>
</body>
</html>
<?php $db->close(); ?>
