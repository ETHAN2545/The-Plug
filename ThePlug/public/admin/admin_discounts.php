<?php
require_once '../../includes/admin_header.php';
require_once '../../includes/admin_sidebar.php';
require_once '../../config.php';
require_once '../../src/db_connect.php';
require_once '../../common.php';

// make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in.php");
    exit;
}

// if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // adding a new discount
    if (isset($_POST['add_discount'])) {
        $code = $_POST['code'] ?? '';
        $type = $_POST['type'] ?? '';
        $amount = $_POST['amount'] ?? 0;
        $start_date = $_POST['start_date'] ?? null;
        $end_date = $_POST['end_date'] ?? null;
        $banner_message = $_POST['banner_message'] ?? null;

        // make sure code, type, and amount are valid
        if (!empty($code) && !empty($type) && is_numeric($amount)) {
            $stmt = $pdo->prepare("
                INSERT INTO discounts (code, type, amount, is_active, start_date, end_date, banner_message)
                VALUES (?, ?, ?, 1, ?, ?, ?)
            ");
            $stmt->execute([$code, $type, $amount, $start_date, $end_date, $banner_message]);
            $success = "Discount added successfully.";
        }
    }

    // allows the toggle of a discount code from active or deactivated.
    if (isset($_POST['toggle_active'])) {
        $discountId = $_POST['discount_id'] ?? null;
        $newStatus = $_POST['new_status'] ?? null;

        if ($discountId !== null && $newStatus !== null) {
            $stmt = $pdo->prepare("UPDATE discounts SET is_active = ? WHERE id = ?");
            $stmt->execute([$newStatus, $discountId]);
        }
    }
}

// gets all discounts to display in table
$stmt = $pdo->query("SELECT * FROM discounts ORDER BY id DESC");
$discounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../../css/admin.css">
<link rel="stylesheet" href="../../css/admin_discounts.css">

<div class="admin-main">
    <h1>Manage Discount Codes</h1>

    <?php if (!empty($success)): ?>
        <p class="success-message"><?= escape($success) ?></p>
    <?php endif; ?>

    <div class="form-container">
        <h2>Add New Discount</h2>
        <form method="POST">
            <label>Discount Code</label>
            <input type="text" name="code" required>

            <label>Type</label>
            <select name="type" required>
                <option value="percent">Percent (%)</option>
                <option value="fixed">Fixed (€)</option>
            </select>

            <label>Amount</label>
            <input type="number" name="amount" step="0.01" required>

            <label>Start Date</label>
            <input type="date" name="start_date">

            <label>End Date</label>
            <input type="date" name="end_date">

            <label>Banner Message</label>
            <textarea name="banner_message" rows="2" placeholder="Optional message"></textarea>

            <button type="submit" name="add_discount">Add Discount</button>
        </form>
    </div>

    <h2>Current Discounts</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Start</th>
                <th>End</th>
                <th>Banner</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($discounts as $discount): ?>
                <tr>
                    <td><?= escape($discount['id']) ?></td>
                    <td><?= escape($discount['code']) ?></td>
                    <td><?= escape(ucfirst($discount['type'])) ?></td>
                    <td>
                        <?= $discount['type'] === 'percent'
                            ? escape($discount['amount']) . '%'
                            : '€' . escape($discount['amount']) ?>
                    </td>
                    <td><?= $discount['start_date'] ? escape($discount['start_date']) : '-' ?></td>
                    <td><?= $discount['end_date'] ? escape($discount['end_date']) : '-' ?></td>
                    <td><?= $discount['banner_message'] ? escape($discount['banner_message']) : '-' ?></td>
                    <td><?= $discount['is_active'] ? ' Active' : ' Inactive' ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="discount_id" value="<?= escape($discount['id']) ?>">
                            <input type="hidden" name="new_status" value="<?= $discount['is_active'] ? 0 : 1 ?>">
                            <button type="submit" name="toggle_active" class="small-btn">
                                <?= $discount['is_active'] ? 'Deactivate' : 'Activate' ?>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../../includes/admin_footer.php'; ?>
