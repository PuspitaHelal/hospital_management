<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM patients WHERE id='$id'");
    $patient = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql = "UPDATE patients SET name='$name', age='$age', gender='$gender', contact='$contact', address='$address' WHERE id='$id'";
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
    <title>Edit Patient</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Edit Patient</h2>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
        <input type="hidden" name="id" value="<?php echo $patient['id']; ?>" required>
        <input type="text" name="name" value="<?php echo $patient['name']; ?>" placeholder="Name" required>
        <input type="number" name="age" value="<?php echo $patient['age']; ?>" placeholder="Age" required>
        <input type="text" name="gender" value="<?php echo $patient['gender']; ?>" placeholder="Gender" required>
        <input type="text" name="contact" value="<?php echo $patient['contact']; ?>" placeholder="Contact" required>
        <textarea name="address" placeholder="Address" required><?php echo $patient['address']; ?></textarea>
        <button type="submit">Update Patient</button>
    </form>
</body>
</html>
