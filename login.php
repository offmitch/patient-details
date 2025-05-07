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
        <h2>Login</h2>
        <form action="login_process.php" method="POST">
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

          <button type="submit" class="btn">Login</button>

          <div class="additional-links">
                <p>Don't have an account? 
                    <a href="signup.php" style="color:yellow; text-decoration:underline">Click here to create an account</a>
                </p>
                <p>Forgot your password?
                    <span style="color:yellow"><i>Please contact your instructor</i></span>
                </p>
    </div>

        </form>
      </div>
    </div>

    <div class="right-side">
       <img src="./images/health_science_building.jpg" alt="Health Sciences @ BCIT" class="side_img">
    </div>
  </div>

</body>
</html>
      
