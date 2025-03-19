<?php
session_start();
require_once 'db_connect.php';
$errorMsg = '';
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name  = $_POST['name']     ?? '';
        $email = $_POST['email']    ?? '';
        $pass  = $_POST['password'] ?? '';
        if (!$name || !$email || !$pass) {
            throw new Exception("All fields are required.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        if (strlen($pass) < 12) {
            throw new Exception("Password must be at least 12 characters.");
        }
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $db->query(
            "INSERT INTO users (name, email, password_hash, role) VALUES (?,?,?,'Customer')",
            "sss",
            [$name, $email, $hash]
        );
        $stmt->close();
        header("Location: sign_in.php");
        exit;
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
    <title>The Plug - Sign Up</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<?php include "header.php";?>
<main>

    <section class="signup-section">
        <h2>Sign Up</h2>
        <?php if ($errorMsg): ?>
            <p style="color:red;"><?php echo $errorMsg; ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Min 12 chars" required>
            <div class="signup-link">
                <p>Already have an account? <a href="sign_in.php">Sign In</a></p>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </section>
</main>
</body>
</html>