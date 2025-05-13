<?php
session_start();
require_once '../config/db.php';

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "Invalid user ID.";
    exit;
}

$userId = $_GET['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, is_admin = ? WHERE user_id = ?");
    $stmt->execute([$first, $last, $is_admin, $userId]);

    header("Location: account_view.php?user_id=" . $userId);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="/Style/styles.css">
    <link rel="stylesheet" href="/Style/header.css">
    <link rel="stylesheet" href="/Style/footer.css">
    <link rel="stylesheet" href="/Style/patient_details.css">
</head>
<body>
<?php include("../Include/header.php"); ?>
<div class="container" style="margin:auto">
    <h2>Edit Account</h2>
    <form method="POST">
        <div class="info-group">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
        </div>
        <div class="info-group">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
        </div>
        <div class="info-group">
            <label>Is Admin?</label>
            <input type="checkbox" name="is_admin" value="1" <?= $user['is_admin'] ? 'checked' : '' ?>>
        </div>
        <button type="submit" class="btn">Save Changes</button>
    </form>
    <br>
    <a href="account_view.php?user_id=<?= $userId ?>" class="btn">← Back</a>
</div>
<?php include("../Include/admin_footer.php"); ?>
</body>
</html>