<?php
session_start();
require_once '../config/db.php';
include("../Include/header_auth.php");

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
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/patients.css">
    <!-- <link rel="stylesheet" href="/Style/landing.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #000;
        }

        .container {
            max-width: 900px;
            margin: 100px auto;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.75);
            border-radius: 12px;
        }

        .container h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            color: white;
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 18px;
            color: white;
            margin-bottom: 6px;
            display: block;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            height: 120px;
        }

        .btn {
            grid-column: 1 / -1;
            padding: 16px;
            font-size: 18px;
            margin-top: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Patient</h2>
    <form method="POST">
        <div>
            <label>First Name</label>
            <input type="text" name="first_name" required>
        </div>

        <div>
            <label>Last Name</label>
            <input type="text" name="last_name" required>
        </div>

        <div>
            <label>MRN</label>
            <input type="text" name="mrn" required>
        </div>

        <div>
            <label>Date of Birth</label>
            <input type="date" name="dob" required>
        </div>

        <div>
            <label>Gender</label>
            <select name="gender" required>
                <option value="">-- Select --</option>
                <option>Male</option>
                <option>Female</option>
                <option>Rather Not Say</option>
                <option>Other</option>
            </select>
        </div>

        <div>
            <label>MRP</label>
            <input type="text" name="mrp">
        </div>

        <div>
            <label>QC Level</label>
            <input type="text" name="qc_level">
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

        <button type="submit" class="btn">Submit</button>
        <button type="button" class="btn" onclick="window.location.href='admin_patients.php'">Back</button>
    </form>
</div>

</body>
</html>
