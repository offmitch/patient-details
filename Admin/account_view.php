<?php include("../Include/header_auth.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Information System</title>
    <link rel="stylesheet" href="/Style/styles.css">
    <link rel="stylesheet" href="/Style/header.css">
    <link rel="stylesheet" href="/Style/footer.css">
    <link rel="stylesheet" href="/Style/patients.css">
    <link rel="stylesheet" href="/Style/landing.css">
    <link rel="stylesheet" href="/Style/accounts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style>
    .patient-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 450px;
}

.readonly-field {
    display: flex;
    flex-direction: column;
}

.readonly-field label {
    font-size: 3em;
    color: white;
    margin-bottom: 5px;
}

.field-value {
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    padding: 20px;
    font-size: 3em;
    border-radius: 8px;
    color: #666;
    cursor: default;
    user-select: none;
}
.password-field {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.toggle-password {
    margin-left: 10px;
    color: #999;
    cursor: pointer;
    transition: color 0.3s ease;
}

.toggle-password:hover {
    color: #333;
}

</style>

<body>
   
<section class="patient-details">
    <div class="readonly-field">
        <label>Name:</label>
        <div class="field-value">*NAME GOES HERE*</div>
    </div>
    <div class="readonly-field">
        <label>Password:</label>
        <div class="field-value password-field">
        *******
        <i class="fas fa-eye toggle-password"></i>
    </div>
    </div>
</section>


   
</body>
</html>


<?php include("../Include/admin_footer.php"); ?>