<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    <link rel="stylesheet" href="/Style/styles.css">
    <link rel="stylesheet" href="Style/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    </style>
</head>
<body>

    <!-- Include the header -->
    <?php include 'Include/header.php'; ?>

    <!-- Landing page content -->
    <div class="main-content">
        <div class="container">
            <h1>Welcome!</h1>
            <div class="container-buttons">
               <a href="login.php" class="btn">Login</a>
               <a href="signup.php" class="btn">Register</a>
                              <a href="Student/patient_details.php" class="btn">Go to Student Page (for testing)</a>
               <a href="Admin/admin_page.php" class="btn">Go to Admin Page (for testing)</a><br>
            </div>
        </div>
    </div>

</body>
</html>
