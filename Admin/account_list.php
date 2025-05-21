<?php
session_start();
require_once '../config/db.php';
require_once '../Include/admin_auth.php';
require_once '../config/session.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_students'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE is_admin = 0");
    $stmt->execute();
}

include("../Include/header_auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Account List</title>
  <link rel="stylesheet" href="../Style/styles.css">
  <link rel="stylesheet" href="../Style/header.css">
  <link rel="stylesheet" href="../Style/footer.css">
  <link rel="stylesheet" href="../Style/accounts.css">
  <link rel="stylesheet" href="../Style/patients.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<style>
.header {
  position: fixed;
  height: 80px;
  z-index: 9999;
}

/* body {
  padding-top: 100px;
} */

.results-container {
  max-height: 600px;
  overflow-y: auto;
  z-index: 1;
}

.results-table thead th {
  background-color: #007BFF;
  z-index: 1;
}

/* 
  .results-container {
    max-height: none !important;
    overflow-y: visible !important;
  }

  footer {
    position: relative !important;
  } */
  
</style>

<body>

<div class="account_list_countainer" style="padding-top: 100px">
<h1 >List of All Accounts</h1>
<div class="results-container" style="max-height: 600px; overflow-y: auto;">
  <table class="results-table">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>User Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stmt = $pdo->query("SELECT user_id, first_name, last_name, is_admin FROM users");
      while ($row = $stmt->fetch()) {
        $role = $row['is_admin'] ? 'Admin' : 'Student';
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
        echo "<td>" . $role . "</td>";
        echo "<td>
                <button class='view-button' onclick=\"window.location.href='account_view.php?user_id={$row['user_id']}'\">View</button>
              </td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<form method="post" onsubmit="return confirm('Are you sure you want to delete all student accounts?');" style="text-align: center; margin-top: 20px;">
  <button type="submit" name="delete_students" class="remove-students">Delete All Student Accounts</button>
</form>


</div>

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

<?php include("../Include/admin_footer.php"); ?>
</body>
</html>
