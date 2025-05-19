<?php
require_once '../config/db.php';
include("../Include/header_auth.php");
require_once '../config/session.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $columnName = trim($_POST['column_name']);
    $columnType = $_POST['column_type'];

    if (!empty($columnName)) {
        $columnName = preg_replace('/[^a-zA-Z0-9_]/', '', $columnName);
        $allowedTypes = ['VARCHAR(255)', 'TEXT', 'INT', 'DATE'];
        if (in_array($columnType, $allowedTypes)) {
            try {
                $pdo->exec("ALTER TABLE patient_information ADD `$columnName` $columnType");
                $message = "Column '$columnName' added successfully!";
            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }
        } else {
            $message = "Invalid column type.";
        }
    } else {
        $message = "Column name cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Column</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/admin.css">
    <link rel="stylesheet" href="../Style/header.css">
    <link rel="stylesheet" href="../Style/footer.css">
    <style>
        body {
            background-color: #000;
            margin: 0;
            padding: 0;
        }

        .page-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 50px;
            border-radius: 12px;
            max-width: 700px;
            width: 100%;
        }

        h2 {
            text-align: center;
            font-size: 40px;
            color: white;
            margin-bottom: 40px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 30px;
            align-items: stretch;
        }

        label {
            color: white;
            font-size: 28px;
        }

        input[type="text"],
        select {
            padding: 16px;
            font-size: 24px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            padding: 16px 32px;
            font-size: 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 30px;
            font-size: 22px;
            text-align: center;
            color: lightgreen;
        }
    </style>
</head>

<body>
    <div class="page-center">
        <div class="container">
            <h2>Add New Column to Patient Table</h2>
            <form method="POST">
                <div>
                    <label for="column_name">Column Title (Name):</label><br>
                    <input type="text" name="column_name" id="column_name" required>
                </div>

                <div>
                    <label for="column_type">Data Type:</label><br>
                    <select name="column_type" id="column_type">
                        <option value="VARCHAR(255)">Text (Short)</option>
                        <option value="TEXT">Text (Long)</option>
                        <option value="INT">Number</option>
                        <option value="DATE">Date</option>
                    </select>
                </div>

                <button type="submit" class="btn">Add Column</button>
            </form>

            <?php if (!empty($message)): ?>
                <p class="message"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>
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
