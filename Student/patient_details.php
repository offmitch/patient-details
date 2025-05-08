<?php include("../Include/header_auth.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Patient Details</title>
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/patient_details.css">

</head>

<body>

    <div class="container">
        <h2>Patient Details</h2>

        <?php
        $mrn = $_GET['mrn'] ?? '';

        $patient = [
            'first_name' => 'Hugo',
            'last_name' => 'Amuan',
            'mrn' => htmlspecialchars($mrn),
            'dob' => '1995-06-25',
            'age' => 30,
            'gender' => 'Male',
            'medication' => 'Metformin',
            'presentation' => 'Frequent urination, excessive thirst'
        ];
        ?>

        <div class="info-section">
            <div class="info-group">
                <label>First Name:</label>
                <span><?= $patient['first_name'] ?></span>
            </div>
            <div class="info-group">
                <label>Last Name:</label>
                <span><?= $patient['last_name'] ?></span>
            </div>
        </div>

        <div class="info-section">
            <div class="info-group">
                <label>MRN:</label>
                <span><?= $patient['mrn'] ?></span>
            </div>
            <div class="info-group">
                <label>Gender:</label>
                <span><?= $patient['gender'] ?></span>
            </div>
            <div class="info-group">
                <label>Date of Birth:</label>
                <span><?= $patient['dob'] ?></span>
            </div>
            <div class="info-group">
                <label>Age:</label>
                <span><?= $patient['age'] ?></span>
            </div>
        </div>

        <div class="full-width">
            <label for="medication">Current Medication:</label>
            <textarea id="medication" readonly disabled><?= $patient['medication'] ?></textarea>
        </div>

        <div class="full-width">
            <label for="presentation">Clinical Presentation:</label>
            <textarea id="presentation" readonly disabled><?= $patient['presentation'] ?></textarea>
        </div>

        <a href="student_patients.php" class="btn">Back to Patient List</a>
    </div>

</body>

</html>
