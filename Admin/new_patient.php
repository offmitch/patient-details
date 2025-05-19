<?php
session_start();
require_once '../config/db.php';
include("../Include/header_auth.php");
require_once '../Include/admin_auth.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO patient_information 
        (first_name, last_name, mrn, dob, gender, mrp, medication, clinical_presentation, qc_level, tests_ordered)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['mrn'],
        $_POST['dob'],
        $_POST['gender'],
        $_POST['mrp'],
        $_POST['medication'],
        $_POST['clinical_presentation'],
        $_POST['qc_level'],
        $_POST['tests_ordered']
    ]);

    header("Location: admin_patients.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Patient</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #000;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 40px;
            border-radius: 12px;
            max-width: 800px;
            width: 100%;
        }

        .page-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }


        h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: white;
        }

        .info-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .info-group {
            display: flex;
            flex-direction: column;
        }

        
        label {
            font-size: 16px;
            font: white;
            margin-bottom: 5px;
        }

        select {
            font-size: 16px !important;
        }

        .dropdown {
    font-size: 16px !important;
}


        input[type="text"],
        input[type="date"],
        select,
        textarea {
            padding: 10px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        .full-width {
            margin-top: 15px;
            display: flex;
            flex-direction: column;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #007BFF;
            color: white;
            text-align: center;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-row {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        form {
            margin-top: 20px;
        }

        
    </style>
</head>

<body>
    <div class="page-center">
        <div class="container">
            <h2>Add New Patient</h2>
            <form method="POST">
                <div class="info-section">
                    <div class="info-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" required>
                    </div>

                    <div class="info-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" required>
                    </div>

                    <div class="info-group">
                        <label>MRN</label>
                        <input type="text" name="mrn" required>
                    </div>

                    <div class="info-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" required>
                    </div>

                 <div class="info-group">
    <label>Gender</label>
    <select name="gender" class="dropdown" required>
        <option value="">-- Select --</option>
        <option>Male</option>
        <option>Female</option>
        <option>Rather Not Say</option>
        <option>Other</option>
    </select>
</div>


                    <div class="info-group">
                        <label>MRP</label>
                        <input type="text" name="mrp">
                    </div>

                    <div class="info-group">
                        <label>QC Level</label>
                        <input type="text" name="qc_level">
                    </div>
                </div>

                <div class="full-width">
                    <label>Current Medication</label>
                    <textarea name="medication" required></textarea>
                </div>

                <div class="full-width">
                    <label>Clinical Presentation</label>
                    <textarea name="clinical_presentation" required></textarea>
                </div>

                <div class="full-width">
                    <label>Tests Ordered</label>
                    <textarea name="tests_ordered"></textarea>
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn">Submit</button>
                    <a href="admin_patients.php" class="btn">Back</a>
                </div>
            </form>
        </div>
        </div>

    <?php include("../Include/admin_footer.php"); ?>
</body>
</html>
