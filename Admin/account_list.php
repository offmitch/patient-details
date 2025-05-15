<?php
session_start();
require_once '../config/db.php';
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
  body {
    overflow-y: auto !important;
    height: auto !important;
  }

  body {
    padding-bottom: 80px;
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
</div>


<?php include("../Include/admin_footer.php"); ?>
</body>
</html>
