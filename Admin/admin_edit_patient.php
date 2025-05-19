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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $update = $pdo->prepare("UPDATE patient_information SET
        first_name = ?, last_name = ?, dob = ?, gender = ?, mrp = ?, medication = ?, clinical_presentation = ?, qc_level = ?, tests_ordered = ?
        WHERE mrn = ?");

    $update->execute([
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['dob'],
        $_POST['gender'],
        $_POST['mrp'],
        $_POST['medication'],
        $_POST['clinical_presentation'],
        $_POST['qc_level'],
        $_POST['tests_ordered'],
        $mrn
    ]);

    header("Location: admin_patient_details.php?mrn=" . $mrn);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/patient_details.css">
    <link rel="stylesheet" href="../Style/admin.css">
    <link rel="stylesheet" href="../Style/footer.css">
</head>
<body>
<div class="container">
    <h2>Edit Patient</h2>
    <form method="POST">
        <?php foreach ($patient as $key => $value): ?>
            <?php if (in_array($key, ['first_name', 'last_name', 'dob', 'gender', 'mrp', 'qc_level'])): ?>
                <div class="info-group">
                    <label><?= ucfirst(str_replace('_', ' ', $key)) ?></label>
                    <input type="text" name="<?= $key ?>" value="<?= htmlspecialchars($value) ?>" required>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="full-width">
            <label>Medication</label>
            <textarea name="medication"><?= htmlspecialchars($patient['medication']) ?></textarea>
        </div>
        <div class="full-width">
            <label>Clinical Presentation</label>
            <textarea name="clinical_presentation"><?= htmlspecialchars($patient['clinical_presentation']) ?></textarea>
        </div>
        <div class="full-width">
            <label>Tests Ordered</label>
            <textarea name="tests_ordered"><?= htmlspecialchars($patient['tests_ordered']) ?></textarea>
        </div>
        <button type="submit" class="btn">Save</button>
        <a href="admin_patients.php" class="btn">Cancel</a>
    </form>
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
