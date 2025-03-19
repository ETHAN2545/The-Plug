<?php
// admin_dashboard.php
session_start();
require_once '../db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../admin_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>The Plug - Admin Dashboard</title>
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<nav class="navbar">
  <div class="nav-logo">
    <a href="../index.php">The Plug</a>
  </div>
  <div class="nav-search">
    <form action="../search.php" method="get">
      <input type="text" name="query" placeholder="Search products">
      <button type="submit">Search</button>
    </form>
  </div>
</nav>

<main>
  <section class="admin-section">
    <h2>Admin Dashboard</h2>
    <p>Welcome, Admin!</p>
    <ul>
      <li><a href="admin_users.php">Manage Users</a></li>
      <li><a href="admin_products.php">Manage Products</a></li>
    </ul>
  </section>
</main>

</body>
</html>
