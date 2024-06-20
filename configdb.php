<?php
$host = 'localhost';
$db = 'hospital_management';
$user = 'root'; // Change to your MySQL user
$pass = '';    // Change to your MySQL password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
