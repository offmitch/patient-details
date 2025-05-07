<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Account</title>
  <link rel="stylesheet" href="Style/header.css">
  <link rel="stylesheet" href="Style/register.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

  <?php include 'Include/header.php'; ?>

  <div class="content-split">
    <div class="left-side">
      <div class="form-container">
        <h2>Create an Account</h2>
        <form action="register_process.php" method="POST">
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>
          </div>

          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
          </div>

          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
          </div>

          <button type="submit" class="btn">Create Account</button>
        </form>
      </div>
    </div>

    <div class="right-side">
       <img src="./images/health_science_building.jpg" alt="Health Sciences @ BCIT" class="side_img">
    </div>
  </div>

</body>
</html>
      
