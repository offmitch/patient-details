<?php
session_start();
require_once '../config/db.php';
include("../Include/header_auth.php");
require_once '../Include/admin_auth.php';


if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "<div class='container'><h2>Invalid user ID.</h2></div>";
    include("../Include/admin_footer.php");
    exit;
}

$userId = $_GET['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['confirm_delete'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$userId]);
    header("Location: account_list.php");
    exit;
}

$stmt = $pdo->prepare("SELECT user_id, first_name, last_name, password, raw_password, is_admin FROM users WHERE user_id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    echo "<div class='container'><h2>User not found.</h2></div>";
    include("../Include/admin_footer.php");
    exit;
}

$role = $user['is_admin'] ? 'Admin' : 'Student';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Account</title>
  <link rel="stylesheet" href="../Style/styles.css">
  <link rel="stylesheet" href="../Style/header.css">
  <link rel="stylesheet" href="../Style/footer.css">
  <link rel="stylesheet" href="../Style/patient_details.css">
  <link rel="stylesheet" href="../Style/admin.css">
  <style>
    .container h2 {
      font-size: 32px;
    }

    .info-group label {
      font-size: 18px;
    }

    .info-group span {
      background-color: #fff;
      border: 1px solid #ccc;
      /* padding: 16px; */
      min-height: 48px;
      border-radius: 8px;
      font-size: 18px;
      display: block;
      overflow-wrap: break-word;
      width: 100%;
    }

    .btn {
      font-size: 18px;
      padding: 12px 24px;
    }

    .btn-delete {
      background-color: #FF5733;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 18px;
      padding: 12px 24px;
      cursor: pointer;
    }

    .btn-delete:hover {
      background-color: #cc3e1f;
    }

    .action-buttons {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 30px;
    }

    .delete-confirm-box {
      margin-top: 40px;
      text-align: center;
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      padding: 30px;
      border-radius: 10px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .delete-confirm-box h3 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .delete-confirm-box form {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }
  </style>
</head>
<body>

<div style="padding-top: 100px; padding-bottom: 100px">
<div class="container" style="margin:auto">
  <h2 >Account Details</h2>

  <div class="info-section">
    <div class="info-group">
      <label>First Name</label>
      <span><?= htmlspecialchars($user['first_name']) ?></span>
    </div>
    <div class="info-group">
      <label>Last Name</label>
      <span><?= htmlspecialchars($user['last_name']) ?></span>
    </div>
    <div class="info-group">
      <label>Role</label>
      <span><?= $role ?></span>
    </div>
    <div class="info-group">
      <label>Password</label>
      <span><?= htmlspecialchars($user['raw_password']) ?></span>
    </div>
  </div>

  <?php if (!isset($_GET['delete'])): ?>
    <div class="action-buttons">
      <a href="reset_password.php?user_id=<?= $userId ?>" class="btn">🔐 Reset Password</a>
      <a href="edit_user.php?user_id=<?= $userId ?>" class="btn">✏️ Edit</a>
      <a href="account_view.php?user_id=<?= $userId ?>&delete=true" class="btn btn-delete">🗑️ Delete</a>
    </div>
  <?php else: ?>
    <div class="delete-confirm-box">
      <h3>Are you sure you want to delete this account?</h3>
      <form method="POST">
        <input type="hidden" name="confirm_delete" value="1">
        <button type="submit" class="btn btn-delete">Yes, Delete</button>
        <a href="account_view.php?user_id=<?= $userId ?>" class="btn">Cancel</a>
      </form>
    </div>
  <?php endif; ?>

  <div style="text-align: center;">
    <a href="account_list.php" class="btn" style="height:80px; width: 150px">← Back to Account List</a>
  </div>
</div>
  </div>

<?php include("../Include/admin_footer.php"); ?>
</body>
</html>
