<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Plug - Home</title>
    <link rel="stylesheet" href="css/index.css">
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
            <div class="product-item">
                <img src="images/jordan4fear.png" alt="Product 1">
                <p>Air Jordan 4 "Fear" sneakers </p>
                <p>€ 289</p>
            </div>
            <div class="product-item">
                <img src="images/hamilton.png" alt="Product 2">
                <p>DIOR AND LEWIS HAMILTON</p>
                <p>€ 1300</p>
            </div>
            <div class="product-item">
                <img src="images/product3.jpg" alt="Product 3">
                <p>Product 3</p>
            </div>
            <div class="product-item">
                <img src="images/product4.jpg" alt="Product 4">
                <p>Product 4</p>
            </div>
            <div class="product-item">
                <img src="images/product5.jpg" alt="Product 5">
                <p>Product 5</p>
            </div>
        </div>
        <div class="view-all">
            <a href="products.php" class="btn">View Other Products</a>
        </div>
    </section>
</main>
</body>
</html>