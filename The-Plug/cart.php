<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Plug - Cart</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
<!-- Navigation Bar -->
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
    <section class="cart-section">
        <h2>Your Cart</h2>
        <div class="cart-items">
            <table>
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <!-- Replace the below section with dynamic content from database or session -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="checkout-button">
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
        </div>
    </section>
</main>
</body>
</html>