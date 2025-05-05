<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../common.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';

// check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    // send to login if not
    header("Location: ../../sign_in.php");
    exit;
}
?>

<link rel="stylesheet" href="../../css/admin.css">

<div class="admin-main">
    <h1>Admin Dashboard</h1>

    <div class="dashboard-grid">
        <div class="dashboard-box">
            <h3>Manage Products</h3>
            <p>Update or add products.</p>
            <a href="admin_products.php" class="dashboard-btn">Go to Products</a>
        </div>

        <div class="dashboard-box">
            <h3>Manage Users</h3>
            <p>View and manage users.</p>
            <a href="admin_users.php" class="dashboard-btn">Go to Users</a>
        </div>

        <div class="dashboard-box">
            <h3>View Orders</h3>
            <p>Track and manage orders.</p>
            <a href="admin_orders.php" class="dashboard-btn">Go to Orders</a>
        </div>

        <div class="dashboard-box">
            <h3>Manage Discounts</h3>
            <p>Edit or add promo codes.</p>
            <a href="admin_discounts.php" class="dashboard-btn">Go to Discounts</a>
        </div>
    </div>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
