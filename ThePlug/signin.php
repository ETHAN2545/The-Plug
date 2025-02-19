<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Plug - Sign In</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/signin.css">
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
    <section class="signin-section">
        <h2>Sign In</h2>
        <form action="process_signin.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Your Password" required>

            <div class="signup-link">
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </div>

            <button type="submit" class="btn">Sign In</button>
        </form>
    </section>
</main>
</body>
</html>