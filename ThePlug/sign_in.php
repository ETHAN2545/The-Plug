<?php
session_start();
require_once 'db_connect.php';
$errorMsg = '';
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = $_POST['email']    ?? '';
        $pass  = $_POST['password'] ?? '';
        if (!$email || !$pass) {
            throw new Exception("Enter both email & password.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        $stmt = $db->query("SELECT user_id, password_hash, role FROM users WHERE email=? LIMIT 1","s",[$email]);
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stmt->close();
            if (password_verify($pass, $row['password_hash'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role']    = $row['role'];
                header("Location: index.php");
                exit;
            } else {
                throw new Exception("Wrong password.");
            }
        } else {
            throw new Exception("No user found with that email.");
        }
    } catch (Exception $ex) {
        $errorMsg = $ex->getMessage();
    }
}
$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Plug - Sign In</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/signin.css">
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
    <section class="signin-section">
        <h2>Sign In</h2>
        <?php if ($errorMsg): ?>
            <p style="color:red;"><?php echo $errorMsg; ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div class="signup-link">
                <p>Don't have an account? <a href="sign_up.php">Sign Up</a></p>
            </div>
            <button type="submit" class="btn">Sign In</button>
        </form>
    </section>
</main>
</body>
</html>
