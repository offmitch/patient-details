<?php
session_start();
require_once '../config/db.php';
include("../Include/header_auth.php");
require_once '../Include/admin_auth.php';
require_once '../config/session.php';

function getPatientColumns($pdo)
{
    $stmt = $pdo->query("DESCRIBE patient_information");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = getPatientColumns($pdo);
    $skip = ['patient_id'];
    $fields = [];
    $values = [];
    $params = [];

    foreach ($columns as $col) {
        if (in_array($col, $skip))
            continue;
        $fields[] = "`$col`";
        $values[] = ":$col";
        $params[":$col"] = $_POST[$col] ?? null;
    }

    $sql = "INSERT INTO patient_information (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $values) . ")";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

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
            color: white;
            margin-bottom: 5px;
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
            <div style="text-align: right; margin-bottom: 20px;">
                <a href="add_column.php" class="btn">+ Add New Column</a>
            </div>

            <h2>Add New Patient</h2>
            <form method="POST">
                <div class="info-section">
                    <?php
                    $textareaFields = ['medication', 'clinical_presentation', 'tests_ordered'];
                    $columns = getPatientColumns($pdo);
                    $skip = ['patient_id'];

                    foreach ($columns as $col) {
                        if (in_array($col, $skip) || in_array($col, $textareaFields))
                            continue;

                        // Handle Gender as dropdown
                        if ($col === 'gender') {
                            echo "<div class='info-group'>
                                <label>Gender</label>
                                <select name='gender' required>
                                    <option value=''>-- Select --</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Rather Not Say</option>
                                    <option>Other</option>
                                </select>
                              </div>";
                        } else {
                            $uppercaseLabels = ['mrn', 'dob', 'mrp', 'qc_level'];
                            $label = in_array($col, $uppercaseLabels)
                                ? strtoupper(str_replace('_', ' ', $col))
                                : ucwords(str_replace('_', ' ', $col));
                            $type = ($col === 'dob') ? 'date' : 'text';
                            echo "<div class='info-group'>
                                <label>$label</label>
                                <input type='$type' name='$col' required>
                              </div>";
                        }
                    }
                    ?>
                </div>

                <?php foreach ($textareaFields as $field): ?>
                    <div class="full-width">
                        <label><?= ucwords(str_replace('_', ' ', $field)) ?></label>
                        <textarea name="<?= $field ?>" <?= $field !== 'tests_ordered' ? 'required' : '' ?>></textarea>
                    </div>
                <?php endforeach; ?>

                <div class="btn-row">
                    <button type="submit" class="btn">Submit</button>
                    <a href="admin_patients.php" class="btn">Back</a>
                </div>
            </form>
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