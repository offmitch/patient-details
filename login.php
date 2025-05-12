<?php
session_start();
include("./Include/header.php");
require_once 'config/db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

        if ($user['is_admin'] == 1) {
            header("Location: Admin/admin_page.php");
            exit;
        } else {
            header("Location: Student/student_patients.php");
            exit;
        }
    } else {
        $error = "Invalid first name, last name, or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="./Style/styles.css">
    <link rel="stylesheet" href="./Style/header.css">
    <link rel="stylesheet" href="./Style/footer.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: 150px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            display: block;
            margin: 12px 0 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .btn {
            margin-top: 20px;
            padding: 14px;
            width: 100%;
            font-size: 18px;
            background-color: #007BFF;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: #ff4d4d;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form method="POST">
        <label>First Name</label>
        <input type="text" name="first_name" required>

        <label>Last Name</label>
        <input type="text" name="last_name" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="btn" type="submit">Login</button>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
