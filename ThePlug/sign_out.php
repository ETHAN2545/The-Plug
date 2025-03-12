<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Plug - Sign Out</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/signout.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-logo"><a href="index.php">The Plug</a></div>
    <div class="nav-search">
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="Search products">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="nav-auth">
        <a href="sign_in.php">Sign In</a>
        <a href="sign_out.php">Sign Out</a>
    </div>
</nav>
<main>
    <section class="signout-section">
        <h2>Are you sure you want to sign out?</h2>
        <div class="signout-buttons">
            <form action="process_signout.php" method="post">
                <button type="submit" class="btn confirm-btn">Yes, Sign Out</button>
            </form>
            <a href="index.php" class="btn cancel-btn">No, Return Home</a>
        </div>
    </section>
</main>
</body>
</html>
