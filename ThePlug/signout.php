<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Plug - Sign Out</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/signout.css">
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
