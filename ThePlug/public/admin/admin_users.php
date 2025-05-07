<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';
require_once '../../classes/User.php';

// redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in.php");
    exit;
}

// create user object
$userObj = new User($pdo);
$users = $userObj->getAllUsers();
?>

<link rel="stylesheet" href="../../css/admin.css">
<link rel="stylesheet" href="../../css/view_users.css">

<div class="admin-main">
    <div class="admin-header">
        <h1>Manage Users</h1>
    </div>

    <div class="user-table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>Date Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= escape($user['id']) ?></td>
                        <td><?= escape($user['email']) ?></td>
                        <td><?= escape($user['full_name'] ?? 'N/A') ?></td>
                        <td><?= $user['is_admin'] ? 'Admin' : 'User' ?></td>
                        <td><?= escape($user['created_at']) ?></td>
                        <td class="user-actions">
                            <a href="update_user.php?id=<?= escape($user['id']) ?>" class="edit-btn">Edit</a>
                            <a href="delete_user.php?id=<?= escape($user['id']) ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
