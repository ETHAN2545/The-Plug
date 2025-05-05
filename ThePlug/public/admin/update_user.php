<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../common.php';
require_once '../../src/db_connect.php';

// checks if user ID is in the URL
if (!isset($_GET['id'])) {
    echo '<p style="color:red; text-align:center;">User ID not provided.</p>';
    require_once '../../includes/admin_footer.php';
    exit;
}

$userId = (int) $_GET['id'];

// gets the user info from the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// if no user found gives error message for user not found
if (!$user) {
    echo '<p style="color:red; text-align:center;">User not found.</p>';
    require_once '../../includes/admin_footer.php';
    exit;
}

// if the form is submitted then it gets the updated name and admin status if checked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

    // updates the full name and role
    $updateStmt = $pdo->prepare("UPDATE users SET full_name = ?, is_admin = ? WHERE id = ?");
    $updateStmt->execute([$fullName, $isAdmin, $userId]);

    // go back to user list with success message
    header("Location: read_users.php?message=User updated successfully.");
    exit;
}
?>

<link rel="stylesheet" href="../../css/admin.css">
<link rel="stylesheet" href="../../css/form_user.css">

<div class="form-container">
    <h2>Update User</h2>

    <form method="POST">
        <label>Email:</label>
        <input type="text" value="<?= escape($user['email']) ?>" disabled>

        <label>Full Name:</label>
        <input type="text" name="full_name" value="<?= escape($user['full_name'] ?? '') ?>" required>

        <label>Role:</label>
        <div class="checkbox-group">
            <label>
                <input type="checkbox" name="is_admin" <?= ($user['is_admin'] ? 'checked' : '') ?>> Admin Access
            </label>
        </div>

        <button type="submit">Update User</button>
    </form>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
