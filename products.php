<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Plug - Products</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/products.css">
</head>
<body>
<!-- Navigation Bar (same for all pages) -->
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

<!-- Main Content -->
<main>
    <section class="product-gallery">
        <!-- Wrap each product item in a link -->
        <div class="products">
            <a href="product-details.php?id=1" class="product-item">
                <img src="images/jordan4fear.png" alt="Air Jordan 4 'Fear' Sneakers">
                <h3>Air Jordan 4 "Fear" Sneakers</h3>
                <p class="price">€289</p>
                <div class="product-description">
                    <p>An iconic design with innovative cushioning and style that stands out on the court.</p>
                </div>
            </a>
            <a href="product-details.php?id=2" class="product-item">
                <img src="images/hamilton.png" alt="Nike Air Max">
                <h3>DIOR AND LEWIS HAMILTON Dior Snow Derby Shoe</h3>
                <p class="price">€1300</p>
                <div class="product-description">
                    <p>The Dior Snow derby shoe is part of the exclusive DIOR AND LEWIS HAMILTON capsule.</p>
                </div>
            </a>
            <a href="product-details.php?id=3" class="product-item">
                <img src="images/" alt="">
                <h3></h3>
                <p class="price"></p>
                <div class="product-description">
                    <p></p>
                </div>
            </a>
            <a href="product-details.php?id=4" class="product-item">
                <img src="images/" alt="">
                <h3></h3>
                <p class="price"></p>
                <div class="product-description">
                    <p></p>
                </div>
            </a>
            <a href="product-details.php?id=5" class="product-item">
                <img src="images/" alt="">
                <h3></h3>
                <p class="price"></p>
                <div class="product-description">
                    <p></p>
                </div>
            </a>
        </div>
    </section>
</main>
</body>
</html>
