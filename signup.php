<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Plug - Sign Up</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/signup.css">
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
<main>
    <section class="signup-section">
        <h2>Sign Up</h2>
        <form action="process_signup.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Your Name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Create a Password" required>

            <div class="signin-link">
                <p>Already have an account? <a href="signin.php">Sign In</a></p>
            </div>

            <button type="submit" class="btn">Sign Up</button>
        </form>
    </section>
</main>
</body>
</html>
