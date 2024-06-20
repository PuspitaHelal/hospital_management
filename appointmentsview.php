<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include '../config/db.php';

$result = $conn->query("SELECT appointments.id, patients.name as patient_name, doctors.name as doctor_name, appointment_date 
                        FROM appointments 
                        JOIN patients ON appointments.patient_id = patients.id 
                        JOIN doctors ON appointments.doctor_id = doctors.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Appointments</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Appointments</h2>
    <a href="schedule.php">Schedule New Appointment</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Appointment Date</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['doctor_name']; ?></td>
            <td><?php echo $row['appointment_date']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
