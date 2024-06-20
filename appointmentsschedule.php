<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];

    $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date) VALUES ('$patient_id', '$doctor_id', '$appointment_date')";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$patients = $conn->query("SELECT * FROM patients");
$doctors = $conn->query("SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Schedule Appointment</h2>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
        <label for="patient_id">Patient</label>
        <select name="patient_id" required>
            <?php while($row = $patients->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="doctor_id">Doctor</label>
        <select name="doctor_id" required>
            <?php while($row = $doctors->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="appointment_date">Appointment Date</label>
        <input type="date" name="appointment_date" required>
        <button type="submit">Schedule Appointment</button>
    </form>
</body>
</html>
