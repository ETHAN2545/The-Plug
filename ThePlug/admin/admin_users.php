<?php
session_start();
require_once '../db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../admin_users.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>The Plug - Manage Users</title>
  <link rel="stylesheet" href="/css/index.css">
  <link rel="stylesheet" href="/css/admin.css">
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

<div class="admin-container">
  <aside class="admin-sidebar">
    <h3>Admin Panel</h3>
    <ul>
      <li><a href="admin_dashboard.php">Dashboard</a></li>
      <li><a href="admin_users.php" class="active">Manage Users</a></li>
      <li><a href="admin_products.php">Manage Products</a></li>
    </ul>
  </aside>
  <main class="admin-main">
    <h2>Manage Users</h2>
    <p>Below is the user list. You can create, update, or delete users here.</p>

  </main>
</div>

</body>
</html>
