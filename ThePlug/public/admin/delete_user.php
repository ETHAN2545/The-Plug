<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';

// check if user ID is in the URL
if (isset($_GET['id'])) {
    $user_id = (int) $_GET['id'];

    // prevents admin from deleting themselves
    if ($_SESSION['user_id'] == $user_id) {
        $error = "You cannot delete your own account.";
    } else {
        // deletes the user from the database
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);

        // goes back to user list with message (using referenced code urlencode)
        header("Location: admin_users.php?message=" . urlencode("User deleted."));
        exit;
    }
} else {
    // no ID provided gives error message
    $error = "User ID not provided.";
}

?>
<link rel="stylesheet" href="../../css/admin.css">
<link rel="stylesheet" href="../../css/form_user.css">

<div class="admin-main">
    <div class="form-container">
        <h2>Delete User</h2>
        <?php if (!empty($error)): ?>
            <p style="color:red; text-align:center;"><?= escape($error) ?></p>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
