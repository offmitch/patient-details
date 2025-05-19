<?php
// session_start();

if (empty($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: /'); 
    exit;
}
?>
