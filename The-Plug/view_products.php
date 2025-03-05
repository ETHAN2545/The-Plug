<?php
include 'db_connect.php';

$sql = "SELECT id, name, brand, category, price, description, image FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Plug - Products</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/products.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-logo">
        <a href="index.php">The Plug</a>
    </div>
    <div class="nav-search">
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="Search products">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="nav-auth">
        <a href="signin.php">Sign In</a>
        <a href="signout.php">Sign Out</a>
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

<?php $conn->close(); ?>
