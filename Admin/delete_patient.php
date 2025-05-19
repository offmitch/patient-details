<?php
session_start();
require_once '../config/db.php';
require_once '../Include/admin_auth.php';


$mrn = $_GET['mrn'] ?? '';
if (!$mrn) {
    echo "Invalid MRN.";
    exit;
}

$stmt = $pdo->prepare("DELETE FROM patient_information WHERE mrn = ?");
$stmt->execute([$mrn]);

header("Location: admin_patients.php");
exit;
?>