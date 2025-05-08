<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = $_POST['first_name'] ?? '';
    $last = $_POST['last_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
        $signup_error = "Passwords do not match.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, password, is_admin) VALUES (?, ?, ?, 0)");
        $stmt->execute([$first, $last, $hash]);
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Account</title>
  <link rel="stylesheet" href="Style/header.css">
  <link rel="stylesheet" href="Style/register.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

  <?php include 'Include/header.php'; ?>

  <div class="content-split">
    <div class="left-side">
      <div class="form-container">
        <h2>Create an Account</h2>
        <?php if (!empty($signup_error)) echo "<p style='color:red;'>$signup_error</p>"; ?>
        <form method="POST">
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>
          </div>

          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
          </div>

          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
          </div>

          <button type="submit" class="btn">Create Account</button>
        </form>
      </div>
    </div>

    <div class="right-side">
       <img src="./images/health_science_building.jpg" alt="Health Sciences @ BCIT" class="side_img">
    </div>
  </div>

</body>
</html>
