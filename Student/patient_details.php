<?php
include("../Include/header_auth.php");
require_once '../config/db.php';

$mrn = $_GET['mrn'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM patient_information WHERE mrn = ?");
$stmt->execute([$mrn]);
$patient = $stmt->fetch();

if (!$patient) {
    echo "<h2 style='padding: 100px;'>Patient not found.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/patient_details.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .info-group span {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 16px;
            min-height: 48px;
            font-size: 18px;
            border-radius: 8px;
            display: block;
            overflow-wrap: break-word;
        }

        .full-width textarea {
            width: 100%;
            height: 180px;
            padding: 16px;
            font-size: 16px;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: vertical;
            background-color: #fff;
        }

        .btn {
            font-size: 18px;
            padding: 12px 24px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div style="padding-top: 50px; padding-bottom: 50px">
<div class="container" style="margin: auto;">
    <h1 style="color: Black">Patient Details</h1>

    <div class="info-section">
        <div class="info-group">
            <label>First Name:</label>
            <span><?= htmlspecialchars($patient['first_name']) ?></span>
        </div>
        <div class="info-group">
            <label>Last Name:</label>
            <span><?= htmlspecialchars($patient['last_name']) ?></span>
        </div>
        <div class="info-group">
            <label>MRN:</label>
            <span><?= htmlspecialchars($patient['mrn']) ?></span>
        </div>
        <div class="info-group">
            <label>Gender:</label>
            <span><?= htmlspecialchars($patient['gender']) ?></span>
        </div>
        <div class="info-group">
            <label>Date of Birth:</label>
            <span>
             <?php
                $dob = new DateTime($patient['dob']);
                $now = new DateTime();
                 $age = $now->diff($dob)->y;
                echo htmlspecialchars($patient['dob']) . " (Age: $age)";
             ?>
            </span>
        </div>
        <div class="info-group">
            <label>MRP:</label>
            <span><?= htmlspecialchars($patient['mrp']) ?></span>
        </div>
    </div>

    <div class="full-width">
        <label>Current Medication:</label>
        <textarea readonly disabled><?= htmlspecialchars($patient['medication']) ?></textarea>
    </div>

    <div class="full-width">
        <label>Clinical Presentation:</label>
        <textarea readonly disabled><?= htmlspecialchars($patient['clinical_presentation']) ?></textarea>
    </div>

    <a href="student_patients.php" class="btn">← Back to Patient List</a>
</div>

</body>
</html>
