<?php include("../Include/header.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Information System</title>
    <link rel="stylesheet" href="/Style/styles.css">
    <link rel="stylesheet" href="/Style/header.css">
    <link rel="stylesheet" href="/Style/footer.css">
    <link rel="stylesheet" href="/Style/patients.css">
    <link rel="stylesheet" href="/Style/landing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
    <h1>Account List</h1>
   
    <div class="search-container">
        <form method="GET" action="admin_patients.php">
             <input type="text" name="first_name" placeholder="First Name"
              value="<?php echo isset($_GET['first_name']) ? htmlspecialchars($_GET['first_name']) : ''; ?>">
    <input type="text" name="last_name" placeholder="Last Name"
      value="<?php echo isset($_GET['last_name']) ? htmlspecialchars($_GET['last_name']) : ''; ?>">
   
      <input type="submit" value="Search" class="search-button">
      <a href="admin_patients.php" class="all-button">All</a>
  </form>
</div>

<div class="results-container">
    <p>2 Results Found:</p>
    <table class="results-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>
                    <button class="view-button" onclick="window.location.href='admin_patient_details.php?mrn=789012'">View</button>
                    <button class="edit-button" onclick="window.location.href='admin_edit_patient.php?mrn=789012'">Make Admin</button>
                    <button class="delete-button" onclick="confirmDelete('789012')"><i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td>Jane</td>
                <td>Smith</td>
                <td>
                    <button class="view-button" onclick="window.location.href='admin_patient_details.php?mrn=789012'">View</button>
                    <button class="edit-button" onclick="window.location.href='admin_edit_patient.php?mrn=789012'">Make Admin</button>
                    <button class="delete-button" onclick="confirmDelete('789012')"><i class="fas fa-trash-alt"></i>
                    </button>
                </td>

            </tr>
        </tbody>
    </table>
</div>

<button class="add-button" onclick="window.location.href='new_patient.php'">Add New Patient</button>


</body>
</html>


<?php include("../Include/admin_footer.php"); ?>