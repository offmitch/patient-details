<?php
session_start();
require_once '../config/db.php';
include("../Include/header_auth.php");
require_once '../Include/admin_auth.php';
require_once '../config/session.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Patient Information System</title>
    <link rel="stylesheet" href="../Style/styles.css">
    <link rel="stylesheet" href="../Style/patients.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../Style/admin.css">
</head>

<body>
    <h1>Patient List</h1>

    <div class="search-container">
        <form method="GET" action="admin_patients.php">
            <input type="text" name="first_name" placeholder="First Name"
                value="<?php echo isset($_GET['first_name']) ? htmlspecialchars($_GET['first_name']) : ''; ?>">
            <input type="text" name="last_name" placeholder="Last Name"
                value="<?php echo isset($_GET['last_name']) ? htmlspecialchars($_GET['last_name']) : ''; ?>">
            <input type="text" name="mrn" placeholder="MRN"
                value="<?php echo isset($_GET['mrn']) ? htmlspecialchars($_GET['mrn']) : ''; ?>">

            <div style="margin-left:auto">
                <input type="submit" value="Search" class="search-button">
            </div>
            <div style="margin-right:0">
                <a href="admin_patients.php" class="all-button">All</a>
            </div>
            <div style="margin-right: auto; color: green">
                <a href="new_patient.php" class="add-btn">Add New Patient</a>
            </div>
        </form>
    </div>

    <div class="results-container">
        <?php
        // Build SQL query with search filters
        $sql = "SELECT * FROM patient_information";
        $conditions = [];
        $params = [];

        if (!empty($_GET['first_name'])) {
            $first_name = trim($_GET['first_name']);
            $conditions[] = "first_name LIKE :first_name";
            $params[':first_name'] = "%" . $first_name . "%";
        }
        if (!empty($_GET['last_name'])) {
            $last_name = trim($_GET['last_name']);
            $conditions[] = "last_name LIKE :last_name";
            $params[':last_name'] = "%" . $last_name . "%";
        }
        if (!empty($_GET['mrn'])) {
            $mrn = trim($_GET['mrn']);
            $conditions[] = "mrn LIKE :mrn";
            $params[':mrn'] = "%" . $mrn . "%";
        }

        if ($conditions) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $patients = $stmt->fetchAll();
        ?>

        <p style="color: white"><?php echo count($patients); ?><span> Results Found: </p>

        <div style="max-height: 400px; overflow-y: auto; border-radius: 6px;">
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
                                <button class="view-button"
                                    onclick="window.location.href='admin_patient_details.php?mrn=<?= $row['mrn'] ?>'">View</button>
                                <button class="edit-button"
                                    onclick="window.location.href='admin_edit_patient.php?mrn=<?= $row['mrn'] ?>'">Edit</button>
                                <button class="delete-button"
                                    onclick="confirmDelete('<?= $row['mrn'] ?>')"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(mrn) {
            if (confirm("Are you sure you want to delete patient MRN " + mrn + "?")) {
                window.location.href = "delete_patient.php?mrn=" + mrn;
            }
        }
    </script>
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

<?php include("../Include/admin_footer.php"); ?>
