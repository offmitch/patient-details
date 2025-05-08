<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $first = $_POST['first_name'] ?? '';
  $last = $_POST['last_name'] ?? '';
  $password = $_POST['password'] ?? '';

  $stmt = $pdo->prepare("SELECT * FROM users WHERE first_name = ? AND last_name = ?");
  $stmt->execute([$first, $last]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['is_admin'] = $user['is_admin'];
    header("Location: index.php");
    exit;
  } else {
    $login_error = "Invalid name or password.";
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
        <h2>Login</h2>
        <?php if (!empty($login_error))
          echo "<p style='color:red;'>$login_error</p>"; ?>
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

          <button type="submit" class="btn">Login</button>

          <div class="additional-links">
            <p>Don't have an account?
              <a href="signup.php" style="color:yellow; text-decoration:underline">Click here to create an account</a>
            </p>
            <p>Forgot your password?
              <span style="color:yellow"><i>Please contact your instructor</i></span>
            </p>
          </div>
        </form>
      </div>
    </div>

    <div class="right-side">
      <img src="./images/health_science_building.jpg" alt="Health Sciences @ BCIT" class="side_img">
    </div>
  </div>

</body>

</html>