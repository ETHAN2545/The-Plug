<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../common.php';
require_once '../../src/db_connect.php';
require_once '../../classes/User.php';

if (!isset($_GET['id'])) {
    echo '<p style="color:red; text-align:center;">User ID not provided.</p>';
    require_once '../../includes/admin_footer.php';
    exit;
}

$userId = (int) $_GET['id'];
$userObj = new User($pdo);
$user = $userObj->getUserById($userId);

if (!$user) {
    echo '<p style="color:red; text-align:center;">User not found.</p>';
    require_once '../../includes/admin_footer.php';
    exit;
}

// update user on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

    $userObj->update($userId, $fullName, $isAdmin);

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
                <input type="checkbox" name="is_admin" <?= $user['is_admin'] ? 'checked' : '' ?>> Admin Access
            </label>
        </div>

        <button type="submit">Update User</button>
    </form>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
