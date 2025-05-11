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
<div class="container">
    <h2>Admin - Patient Details</h2>
    <div class="info-section">
        <?php foreach ($patient as $key => $value): ?>
            <?php if (in_array($key, ['medication', 'clinical_presentation'])): ?>
                <div class="info-group full-width">
                    <label><?= ucfirst(str_replace('_', ' ', $key)) ?>:</label>
                    <span><?= nl2br(htmlspecialchars($value)) ?></span>
                </div>
            <?php else: ?>
                <div class="info-group">
                    <label><?= ucfirst(str_replace('_', ' ', $key)) ?>:</label>
                    <span><?= nl2br(htmlspecialchars($value)) ?></span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <a href="admin_patients.php" class="btn">← Back</a>
</div>

<?php include("../Include/admin_footer.php"); ?>


</body>
</html>



