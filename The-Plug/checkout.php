<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Plug - Checkout</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/checkout.css">
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
    <section class="checkout-section">
        <h2>Checkout</h2>
        <form action="process_checkout.php" method="post">
            <label for="address">Shipping Address:</label>
            <input type="text" id="address" name="address" placeholder="123 Main Street" required>

            <label for="card-type">Card Type:</label>
            <select id="card-type" name="card_type" required>
                <option value="mastercard">MasterCard</option>
                <option value="visa">Visa</option>
                <option value="amex">American Express</option>
                <option value="discover">Discover</option>
            </select>

            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" name="card_number" placeholder="1111 2222 3333 4444" required>

            <label for="expiration-date">Expiration Date:</label>
            <input type="text" id="expiration-date" name="expiration_date" placeholder="MM/YY" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" required>

            <button type="submit" class="btn">Place Order</button>
        </form>
    </section>
</main>
</body>
</html>