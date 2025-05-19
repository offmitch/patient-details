<?php
require_once 'config/db.php';

$signup_error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

    if ($password !== $confirmPassword) {
        $signup_error = 'Passwords do not match!';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, password, raw_password, is_admin) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $hashedPassword, $password, $isAdmin]);

            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            $signup_error = "Error: " . $e->getMessage();
        }
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
          <?php if (!empty($signup_error)) echo "<p style='color:red;'>$signup_error</p>"; ?>

          <button type="submit" class="btn">Create Account</button>

          <div class="additional-links">
            <br>
            <p>Already have an account?
              <a href="index.php" style="color:yellow; text-decoration:underline">Login</a>
            </p>
            <p>
              
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