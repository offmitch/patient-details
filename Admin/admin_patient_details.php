<?php
session_start();
require_once '../config/db.php';
include("../Include/header_auth.php");
require_once '../Include/admin_auth.php';
require_once '../config/session.php';

$mrn = $_GET['mrn'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM patient_information WHERE mrn = ?");
$stmt->execute([$mrn]);
$patient = $stmt->fetch();

if (!$patient) {
    echo "<h2 style='padding: 100px;'>Patient not found.</h2>";
    exit;
}

// get all columns from table
function getPatientColumns($pdo) {
    $stmt = $pdo->query("DESCRIBE patient_information");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// formatting for labels
function formatLabel($col) {
    $uppercaseLabels = ['mrn', 'dob', 'mrp'];
    $label = str_replace('_', ' ', $col);
    return in_array($col, $uppercaseLabels) ? strtoupper($label) : ucwords($label);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Patient Details</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/patient_details.css">
    <link rel="stylesheet" href="../Style/admin.css">
    <style>
        .info-group label {
            font-size: 18px;
            color: #333;
            font-weight: bold;
            margin-bottom: 6px;
        }
    </style>
</head>

<body>
    <div style="padding-top: 25px; padding-bottom: 25px">
        <div class="container">
            <h2>Admin - Patient Details</h2>
            <div class="info-section">
                <?php
                $columns = getPatientColumns($pdo);
                $textareas = ['medication', 'clinical_presentation', 'tests_ordered'];
                foreach ($columns as $col) {
                    if (!array_key_exists($col, $patient)) continue;

                    if ($col === 'dob') {
                        $dob = new DateTime($patient['dob']);
                        $now = new DateTime();
                        $age = $now->diff($dob)->y;
                        echo "<div class='info-group'>
                                <label>" . formatLabel($col) . ":</label>
                                <span>" . htmlspecialchars($patient[$col]) . " (Age: $age)</span>
                              </div>";
                    } elseif (!in_array($col, $textareas)) {
                        echo "<div class='info-group'>
                                <label>" . formatLabel($col) . ":</label>
                                <span>" . ($patient[$col] !== null ? htmlspecialchars($patient[$col]) : 'null') . "</span>
                              </div>";
                    }
                }
                ?>
            </div>

            <?php foreach ($textareas as $col): ?>
                <?php if (isset($patient[$col])): ?>
                    <div class="full-width">
                        <label><?= formatLabel($col) ?>:</label>
                        <textarea readonly disabled><?= htmlspecialchars($patient[$col]) ?></textarea>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <a href="admin_patients.php" class="btn">← Back</a>
        </div>
    </div>

    <?php include("../Include/admin_footer.php"); ?>
    <script>
    let timeoutLimit = 15 * 60 * 1000; // 15 minutes
    let logoutTimer;

    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(() => {
            window.location.href = "/login.php?timeout=1";
        }, timeoutLimit);
    }

    ['click', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(evt => {
        document.addEventListener(evt, resetTimer, false);
    });

    resetTimer(); // start timer initially
</script>

</body>
</html>
