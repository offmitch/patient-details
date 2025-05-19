<?php
session_start();
require_once '../config/db.php';
require_once '../Include/admin_auth.php';

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "<h2>Invalid user ID.</h2>";
    exit;
}

$userId = $_GET['user_id'];

$stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE user_id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    echo "<h2>User not found.</h2>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$userId]);

    header("Location: account_list.php");
    exit;
}
?>
<script>
    let timeoutLimit = 15 * 60 * 1000; // 15 minutes
    let logoutTimer;

    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(() => {
            window.location.href = "/login.php?timeout=1";
        }, timeoutLimit);
    }

    ['click', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(evt => {
        document.addEventListener(evt, resetTimer, false);
    });

    resetTimer(); // start timer initially
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="/Style/styles.css">
    <link rel="stylesheet" href="/Style/header.css">
    <link rel="stylesheet" href="/Style/footer.css">
    <link rel="stylesheet" href="/Style/patient_details.css">
</head>
<body>

<?php include("../Include/header.php"); ?>

<div class="container">
    <h2>Delete Account</h2>
    <p>Are you sure you want to delete the account for <strong><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></strong>?</p>

    <form method="POST">
        <button type="submit" class="btn btn-delete">Yes, Delete</button>
        <a href="account_view.php?user_id=<?= $userId ?>" class="btn">Cancel</a>
    </form>
</div>

<?php include("../Include/admin_footer.php"); ?>

<style>
    .btn-delete {
        background-color: #FF5733;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        margin-right: 10px;
    }

    .btn-delete:hover {
        background-color: #cc3e1f;
    }
</style>

</body>
</html>