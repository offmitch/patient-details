<?php
session_start();
require_once '../config/db.php';

// Validate user_id
if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "Invalid user ID.";
    exit;
}

$userId = $_GET['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first = $_POST['first_name'] ?? '';
    $last = $_POST['last_name'] ?? '';
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, is_admin = ? WHERE user_id = ?");
    $stmt->execute([$first, $last, $is_admin, $userId]);

    header("Location: account_view.php?user_id=" . urlencode($userId));
    exit;
}

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/footer.css">
    <link rel="stylesheet" href="../Style/patient_details.css">
</head>
<body>
<?php include("../Include/header_auth.php"); ?>

<div class="main-container" style="padding-top:50px;">
<div class="container" style="max-width: 600px; margin: 40px auto;">
    <h2>Edit Account</h2>
    <form method="POST" class="form-card">
        <div class="info-group">
            <label for="first_name">First Name</label>
            <input 
                type="text" 
                id="first_name" 
                name="first_name" 
                value="<?= htmlspecialchars($user['first_name']) ?>" 
                required>
        </div>

        <div class="info-group">
            <label for="last_name">Last Name</label>
            <input 
                type="text" 
                id="last_name" 
                name="last_name" 
                value="<?= htmlspecialchars($user['last_name']) ?>" 
                required>
        </div>

        <div class="info-group checkbox-group">
            <input 
                type="checkbox" 
                id="is_admin" 
                name="is_admin" 
                value="1" 
                <?= $user['is_admin'] ? 'checked' : '' ?>>
            <label for="is_admin">Is Admin?</label>
        </div>

        <div class="button-group">
            <button type="submit" class="btn primary">Save Changes</button>
            <a href="account_view.php?user_id=<?= urlencode($userId) ?>" class="btn secondary">← Back</a>
        </div>
    </form>
</div>
</div>

<?php include("../Include/admin_footer.php"); ?>
</body>
</html>
