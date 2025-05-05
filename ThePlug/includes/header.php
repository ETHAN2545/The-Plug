<?php
session_start();
require_once '../common.php';
?>
<link rel="stylesheet" href="../css/style.css">
<script src="../js/nav.js" defer></script>

<nav class="navbar">
    <div class="nav-logo">
        <a href="index.php">The Plug</a>
    </div>

    <div class="nav-search">
        <form action="products.php" method="get">
            <input type="text" name="query" placeholder="Search products..." value="<?= escape($_GET['query'] ?? '') ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="nav-profile">
        <img src="../images/profile.png" alt="Profile" onclick="toggleDropdown()">
        <div class="dropdown-content" id="dropdown">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="cart.php">Cart</a>
                <a href="order_history.php">My Orders</a>
                <?php if (!empty($_SESSION['is_admin'])): ?>
                    <a href="../public/admin/admin_dashboard.php">Admin Dashboard</a>
                <?php endif; ?>
                <a href="sign_out.php">Sign Out</a>
            <?php else: ?>
                <a href="sign_in.php">Sign In</a>
                <a href="sign_up.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

