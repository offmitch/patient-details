<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO user (first_name, last_name, password, is_admin) VALUES (?, ?, ?, 0)");
    $stmt->execute([$fname, $lname, $pass]);

    echo "Account created. <a href='login.php'>Login here</a>.";
}
?>

<form method="POST">
    <input name="first_name" placeholder="First Name" required>
    <input name="last_name" placeholder="Last Name" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>


