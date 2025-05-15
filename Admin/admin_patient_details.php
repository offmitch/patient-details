<?php
session_start();
require_once '../config/db.php';
include("../Include/header_auth.php");

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
    <title>Admin - Patient Details</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/patient_details.css">
    <link rel="stylesheet" href="../Style/admin.css">
    <link rel="stylesheet" href="../Style/footer.css">
</head>

<body>
    <div style="padding-top: 25px; padding-bottom: 25px">
        <div class="container">
            <h2>Admin - Patient Details</h2>
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

            <div class="info-group">
                <label>QC Level</label>
                <span><?= htmlspecialchars($patient['qc_level']) ?></span>
            </div>
            <div class="info-group">
                <label>Tests Ordered:</label>
                <span><?= htmlspecialchars($patient['tests_ordered']) ?></span>
            </div>

            <a href="admin_patients.php" class="btn">← Back</a>
        </div>
    </div>

    <?php include("../Include/admin_footer.php"); ?>



</body>

</html>