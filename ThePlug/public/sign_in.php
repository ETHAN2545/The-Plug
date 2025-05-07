<?php
require_once '../includes/header.php';
require_once '../config.php';
require_once '../src/db_connect.php';
require_once '../common.php';

$error = "";

// when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["email"]) && isset($_POST["password"])) {

        $email = $_POST["email"];
        $password = $_POST["password"];

        // check if user exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            // set session values 
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["is_admin"] = $user["is_admin"];
            $_SESSION["Active"] = true; 

            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }

    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<link rel="stylesheet" href="../css/sign_in.css">
<link rel="stylesheet" href="../css/style.css">

<main class="auth-main">
    <div class="auth-box">
        <h2>Sign In</h2>
        <form method="post" action="sign_in.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign In</button>
        </form>

        <?php if (!empty($error)): ?>
            <p class="error-message"><?= escape($error) ?></p>
        <?php endif; ?>

        <div class="auth-links">
            <p>Don't have an account? <a href="sign_up.php">Register here</a></p>
            <p><a href="index.php">← Return to Home</a></p>
        </div>
    </div>
</main>
<script src="../js/nav.js"></script>
