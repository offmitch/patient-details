<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<div class="header">
    <div class="inner_header">
        <div class="logo_container">
            <img src="../images/bcit_logo.jpg" alt="Site Logo" class="logo_image">
            <h1 style="padding-top:15px"><span>My</span><span>Site</span></h1>
        </div>
        <div class="user_controls">
            <span class="user_name">
                <?= isset($_SESSION['first_name'], $_SESSION['last_name'])
                    ? htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name'])
                    : 'Guest' ?>
            </span>
            <a href="/.php"><button class="logout_btn">Logout</button></a>
        </div>
    </div>
</div>