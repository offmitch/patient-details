<?php
include("../Include/header_auth.php"); 
require_once '../config/db.php';
require_once '../Include/admin_auth.php';

?>
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

<!DOCTYPE html>
<html>
<head>
    <title>Patient Information System</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/footer.css">
    <link rel="stylesheet" href="../Style/admin.css">

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