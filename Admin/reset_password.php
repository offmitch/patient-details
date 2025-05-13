<?php
session_start();
require_once '../config/db.php';

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "Invalid user ID.";
    exit;
}

$userId = $_GET['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newPassword = $_POST['new_password'];
    $hashed = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = ?, raw_password = ? WHERE user_id = ?");
    $stmt->execute([$hashed, $newPassword, $userId]);

    header("Location: account_view.php?user_id=" . $userId);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="/Style/styles.css">
    <link rel="stylesheet" href="/Style/header.css">
    <link rel="stylesheet" href="/Style/footer.css">
    <link rel="stylesheet" href="/Style/patient_details.css">
</head>
<body>
<?php include("../Include/header.php"); ?>
<div class="container" style="margin: auto">
    <h2>Reset Password</h2>
    <form method="POST">
        <div class="info-group">
            <label>New Password</label>
            <input type="text" name="new_password" required>
        </div>
        <button type="submit" class="btn">Update Password</button>
    </form>
    <br>
    <a href="account_view.php?user_id=<?= $userId ?>" class="btn">← Back</a>
</div>
<?php include("../Include/admin_footer.php"); ?>
</body>
</html>
