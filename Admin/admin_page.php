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

</head>
<body>
    <h1>Welcome <NAME>!</h1>

    <div class="center_container">
        <div class="admin_selections">
            <button class="admin_button" onclick="location.href='admin_patients.php'">View Patients</button>
            <button class="admin_button" onclick="location.href='account_list.php'">View Accounts</button>
        </div>
    </div>

</body>
</html>


<?php include("../Include/admin_footer.php"); ?>