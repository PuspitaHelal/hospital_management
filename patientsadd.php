<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql = "INSERT INTO patients (name, age, gender, contact, address) VALUES ('$name', '$age', '$gender', '$contact', '$address')";
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
    <title>Add Patient</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Add Patient</h2>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="gender" placeholder="Gender" required>
        <input type="text" name="contact" placeholder="Contact" required>
        <textarea name="address" placeholder="Address" required></textarea>
        <button type="submit">Add Patient</button>
    </form>
</body>
</html>
