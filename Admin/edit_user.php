<?php
session_start();
require_once '../config/db.php';
include("../Include/header_auth.php");
require_once '../Include/admin_auth.php';

$user_id = $_GET['user_id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["first_name"];
    $lastname = $_POST["last_name"];
    $password = $_POST["password"];
    $type = $_POST["type"];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, password = ?, is_admin = ? WHERE user_id = ?");
        $stmt->execute([$firstname, $lastname, $hashedPassword, $type, $user_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, is_admin = ? WHERE user_id = ?");
        $stmt->execute([$firstname, $lastname, $type, $user_id]);
    }

    header("Location: account_list.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "<h2 style='padding: 100px;'>User not found.</h2>";
    exit;
}
?>
<link rel="stylesheet" href="../css/admin.css">
<link rel="stylesheet" href="../css/register.css">
<link rel="stylesheet" href="../css/styles.css">

<style>
    .edit-card {
        max-width: 700px;
        margin: 120px auto;
        padding: 40px;
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .edit-card h2 {
        font-size: 36px;
        margin-bottom: 30px;
        color: #222;
    }

    .edit-form {
        background-color: #f7f7f7;
        border-radius: 12px;
        padding: 30px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .edit-form label {
        font-weight: bold;
        margin-bottom: 6px;
        display: block;
        color: #333;
        text-align: left;
    }

    .edit-form input,
    .edit-form select {
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        width: 100%;
        font-size: 16px;
    }

    .edit-form .full-width {
        grid-column: 1 / -1;
    }

    .edit-buttons {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .edit-buttons button {
        padding: 14px 24px;
        font-size: 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        width: 180px;
        background-color: #007BFF;
        color: white;
        transition: background-color 0.3s ease;
    }

    .edit-buttons button:hover {
        background-color: #0056b3;
    }
</style>

<div class="edit-card">
    <h2>Account Details</h2>
    <form method="post" class="edit-form">
        <div>
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
        </div>
        <div>
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
        </div>
        <div class="full-width">
            <label>Role</label>
            <select name="type" required>
                <option value="0" <?= $user['is_admin'] == 0 ? 'selected' : '' ?>>Student</option>
                <option value="1" <?= $user['is_admin'] == 1 ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <div class="edit-buttons full-width">
            <button type="submit">✏️ Update</button>
        </div>
    </form>
</div>
