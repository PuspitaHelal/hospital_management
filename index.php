<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
} else {
    header("Location: dashboard.php");
}
?>
