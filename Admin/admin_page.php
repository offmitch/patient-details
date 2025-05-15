<?php include("../Include/header_auth.php"); 
require_once '../config/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Information System</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/footer.css">
    <link rel="stylesheet" href="../Style/patients.css">
    <link rel="stylesheet" href="../Style/admin.css">
    <!-- <link rel="stylesheet" href="../Style/landing.css"> -->

</head>
<body>
    <div class="welcome_msg">
    <h1>Welcome <span class="user_name">
                <?= isset($_SESSION['first_name'], $_SESSION['last_name'])
                    ? htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name'])
                    : 'Guest' ?>
            </span>
            
            !</h1>
</div>


</body>
</html>


<?php include("../Include/admin_footer.php"); ?>