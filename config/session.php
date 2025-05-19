<?php


$timeout = 900; // 15 minutes in seconds

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    session_unset();
    session_destroy();
    header("Location: /login.php?timeout=1");
    exit;
}

$_SESSION['last_activity'] = time();

?>