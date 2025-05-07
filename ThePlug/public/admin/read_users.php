<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';

// gets basic info for all users
$stmt = $pdo->prepare("SELECT id, full_name, email, is_admin, created_at FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// gets any success message passed in URL saying user deleted or user updated
$message = $_GET['message'] ?? null;
?>

<link rel="stylesheet" href="../../css/admin.css">

<div class="admin-main">
    <h2>Users in ThePlug Database</h2>

    <?php if (!empty($message)): ?>
        <p class="success-message">✅ <?= escape($message) ?></p>
    <?php endif; ?>

    <?php if (!empty($users)): ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= escape($user['id']) ?></td>
                        <td><?= escape($user['full_name']) ?></td>
                        <td><?= escape($user['email']) ?></td>
                        <td><?= $user['is_admin'] ? 'Admin' : 'User' ?></td>
                        <td><?= escape($user['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
