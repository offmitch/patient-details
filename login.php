<?php
require_once '../config/db.php';
require_once '../config/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE first_name = ? AND last_name = ?");
    $stmt->execute([$fname, $lname]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['is_admin'] = $user['is_admin'];
        header("Location: " . ($user['is_admin'] ? '../admin/dashboard.php' : '../student/search.php'));
    } else {
        echo "Login failed.";
    }
}
?>

<form method="POST">
    <input name="first_name" placeholder="First Name" required>
    <input name="last_name" placeholder="Last Name" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
