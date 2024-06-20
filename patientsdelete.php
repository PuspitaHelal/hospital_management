<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM patients WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: view.php");
}
?>
