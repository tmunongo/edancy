<?php
session_start();

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    $_SESSION['authenticated'] = false;
    $_SESSION['user'] = null;
    header('Location: ../login.php');
    exit;
}
