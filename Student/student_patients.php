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
    <link rel="stylesheet" href="../Style/admin.css">
    <link rel="stylesheet" href="../Style/patients.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <style>
        .center-message {
            text-align: center;
            color: #666;
            margin-top: 40px;
            font-style: italic;
        }

        .top-message {
            text-align: center;
            color: white;
            font-size: 1.2rem;
            margin-top: 30px;
            margin-bottom: 0;
            font-style: italic;
        }

        .search-container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .search-container form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            
        }
        .input-row {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 10px;
}

.button-row {
    display: flex;
    justify-content: center;
    gap: 10px;
}


.input-row input[type="text"] {
    max-width: 360px;
    justify-content: center;
}


    </style>
</head>

<body>

    <?php
    $sql = "SELECT * FROM patient_information";
    $conditions = [];
    $params = [];
    $hasSearch = false;

    if (!empty($_GET['first_name'])) {
        $conditions[] = "first_name LIKE :first_name";
        $params[':first_name'] = "%" . $_GET['first_name'] . "%";
        $hasSearch = true;
    }
    if (!empty($_GET['last_name'])) {
        $conditions[] = "last_name LIKE :last_name";
        $params[':last_name'] = "%" . $_GET['last_name'] . "%";
        $hasSearch = true;
    }
    if (!empty($_GET['mrn'])) {
        $conditions[] = "mrn LIKE :mrn";
        $params[':mrn'] = "%" . $_GET['mrn'] . "%";
        $hasSearch = true;
    }

    if ($hasSearch) {
        if ($conditions) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $patients = $stmt->fetchAll();
    }
    ?>

    <div style="padding-top:100px"> 
    <?php if (!$hasSearch): ?>
        <h1>Enter patient information here</h1>
    <?php endif; ?>
<div class="search-container">
    <form method="GET" action="student_patients.php">
        <div class="input-row">
            <input type="text" name="first_name" placeholder="First Name" value="<?= htmlspecialchars($_GET['first_name'] ?? '') ?>">
            <input type="text" name="last_name" placeholder="Last Name" value="<?= htmlspecialchars($_GET['last_name'] ?? '') ?>">
            <input type="text" name="mrn" placeholder="MRN" value="<?= htmlspecialchars($_GET['mrn'] ?? '') ?>">
        </div>
        <div class="button-row" style="margin:auto">
            <input type="submit" value="Search" class="search-button">
            <a href="student_patients.php" class="all-button">Clear</a>
        </div>
    </form>
</div>

</div>

    <?php if ($hasSearch): ?>
        <div class="results-container" style="margin-bottom: 100px;">
            <p><?= count($patients) ?> Results Found:</p>
            <?php if (count($patients) > 0): ?>
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
            <?php else: ?>
                <p class="center-message">No results match your search.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>

</html>
