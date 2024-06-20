<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql = "INSERT INTO doctors (name, specialty, contact, address) VALUES ('$name', '$specialty', '$contact', '$address')";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Add Doctor</h2>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="specialty" placeholder="Specialty" required>
        <input type="text" name="contact" placeholder="Contact" required>
        <textarea name="address" placeholder="Address" required></textarea>
        <button type="submit">Add Doctor</button>
    </form>
</body>
</html>
