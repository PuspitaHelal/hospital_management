<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM doctors WHERE id='$id'");
    $doctor = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql = "UPDATE doctors SET name='$name', specialty='$specialty', contact='$contact', address='$address' WHERE id='$id'";
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
    <title>Edit Doctor</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Edit Doctor</h2>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
        <input type="hidden" name="id" value="<?php echo $doctor['id']; ?>" required>
        <input type="text" name="name" value="<?php echo $doctor['name']; ?>" placeholder="Name" required>
        <input type="text" name="specialty" value="<?php echo $doctor['specialty']; ?>" placeholder="Specialty" required>
        <input type="text" name="contact" value="<?php echo $doctor['contact']; ?>" placeholder="Contact" required>
        <textarea name="address" placeholder="Address" required><?php echo $doctor['address']; ?></textarea>
        <button type="submit">Update Doctor</button>
    </form>
</body>
</html>
