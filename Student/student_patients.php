<?php include("../Include/header_auth.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Information System</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/footer.css">
    <link rel="stylesheet" href="../Style/patients.css">
    <link rel="stylesheet" href="../Style/landing.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
    <h1 style="padding:101px">Patient List</h1>
    
    <div class="search-container">
        <form method="GET" action="admin_patients.php">
             <input type="text" name="first_name" placeholder="First Name"
              value="<?php echo isset($_GET['first_name']) ? htmlspecialchars($_GET['first_name']) : ''; ?>">
    <input type="text" name="last_name" placeholder="Last Name"
      value="<?php echo isset($_GET['last_name']) ? htmlspecialchars($_GET['last_name']) : ''; ?>">
    <input type="text" name="mrn" placeholder="MRN"
      value="<?php echo isset($_GET['mrn']) ? htmlspecialchars($_GET['mrn']) : ''; ?>">

      <input type="submit" value="Search" class="search-button">
      <a href="admin_patients.php" class="all-button">All</a>
  </form>
</div>

<div class="results-container" style="margin-bottom: 100px;">
    <p>2 Results Found:</p>
    <table class="results-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>MRN</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>123456</td>
                <td>
                    <button class="view-button" onclick="window.location.href='admin_patient_details.php?mrn=789012'">View</button>
                </td>
            </tr>
            <tr>
                <td>Jane</td>
                <td>Smith</td>
                <td>789012</td>
                <td>
                    <button class="view-button" onclick="window.location.href='admin_patient_details.php?mrn=789012'">View</button>
                    </button>
                </td>

            </tr>
        </tbody>
    </table>
</div>
</body>
</html>


