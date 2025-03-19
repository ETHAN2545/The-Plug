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
<?php include "header.php";?>
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
<?php include "footer.php";?>
</body>
</html>