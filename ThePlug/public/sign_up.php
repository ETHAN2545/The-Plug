<?php
require_once '../includes/header.php';
require_once '../config.php';
require_once '../src/db_connect.php';
require_once '../common.php';

// when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm = $_POST["confirm"];

        // check if passwords match
        if ($password != $confirm) {
            echo "Passwords do not match!";
        } else {
            // check if email already exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "Email already registered!";
            } else {
                // hash and insert
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $insert = $pdo->prepare("INSERT INTO users (email, password, is_admin) VALUES (?, ?, 0)");
                $insert->execute([$email, $hashedPassword]);

                header("Location: sign_in.php");
                exit;
            }
        }

    } else {
        echo "Please fill in all fields.";
    }
}
?>

<link rel="stylesheet" href="../css/sign_up.css">
<link rel="stylesheet" href="../css/style.css">

<main class="auth-main">
    <div class="auth-box">
        <h2>Sign Up</h2>
        <form method="post" action="sign_up.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>

        <?php if (!empty($error)): ?>
            <p class="error-message"><?= escape($error) ?></p>
        <?php endif; ?>

        <div class="auth-links">
            <p>Already have an account? <a href="sign_in.php">Sign In</a></p>
            <p><a href="index.php">← Return to Home</a></p>
        </div>
    </div>
</main>
<script src="../js/nav.js"></script>
