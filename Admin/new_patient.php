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
    html, body {
        margin: 0;
        padding: 0;
        /* background-color: #ffffff; */
        font-family: Arial, sans-serif;
        min-height: 100vh;
    }

    body {
        padding-bottom: 100px; /* space for fixed footer */
            background-color: #ffffff;

    }

    .form-wrapper {
        max-width: 900px;
        margin: 40px auto;
        /* background-color: #ffffff; */
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    h2 {
        text-align: center;
        font-size: 32px;
        margin-bottom: 30px;
        color: #ffffff;
    }

    .top-action {
        text-align: right;
        margin-bottom: 20px;
    }

    .top-action .btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .top-action .btn:hover {
        background-color: #218838;
    }

    .info-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .info-group {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: bold;
        margin-bottom: 6px;
        color: #ffffff;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea {
        padding: 12px;
        font-size: 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background-color: #fff;
        width: 100%;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    .full-width {
        grid-column: 1 / -1;
        display: flex;
        flex-direction: column;
    }

    .btn-row {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .btn {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    form{
        padding-bottom: 100px;
        
    }
</style>


</head>

<body>
    <div class="form-wrapper">
        <div class="top-action">
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
