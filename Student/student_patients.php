<?php
include("../Include/header_auth.php");
require_once '../config/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Information System</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/patients.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h1 style="padding-top: 10px">Patient List</h1>

<div class="search-container">
    <form method="GET" action="student_patients.php">
        <input type="text" name="first_name" placeholder="First Name" value="<?= htmlspecialchars($_GET['first_name'] ?? '') ?>">
        <input type="text" name="last_name" placeholder="Last Name" value="<?= htmlspecialchars($_GET['last_name'] ?? '') ?>">
        <input type="text" name="mrn" placeholder="MRN" value="<?= htmlspecialchars($_GET['mrn'] ?? '') ?>">

        <input type="submit" value="Search" class="search-button">
        <a href="student_patients.php" class="all-button">All</a>
    </form>
</div>

<?php
$sql = "SELECT * FROM patient_information";
$conditions = [];
$params = [];

if (!empty($_GET['first_name'])) {
    $conditions[] = "first_name LIKE :first_name";
    $params[':first_name'] = "%" . $_GET['first_name'] . "%";
}
if (!empty($_GET['last_name'])) {
    $conditions[] = "last_name LIKE :last_name";
    $params[':last_name'] = "%" . $_GET['last_name'] . "%";
}
if (!empty($_GET['mrn'])) {
    $conditions[] = "mrn LIKE :mrn";
    $params[':mrn'] = "%" . $_GET['mrn'] . "%";
}

if ($conditions) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$patients = $stmt->fetchAll();
?>

<div class="results-container" style="margin-bottom: 100px;">
    <div style="max-height: 500px; overflow-y: auto;">
        <table class="results-table">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>MRN</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($patients as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['first_name']) ?></td>
                    <td><?= htmlspecialchars($row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['mrn']) ?></td>
                    <td>
                        <button class="view-button" onclick="window.location.href='patient_details.php?mrn=<?= $row['mrn'] ?>'">View</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
