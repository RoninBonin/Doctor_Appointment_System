<?php
include("db_connect.php");
$conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");

if (isset($_POST['submit'])) {
    $appointmentId = $_POST['appointmentId'];
    $doctorId = $_POST['doctorId'];
    $patientId = $_SESSION['id'];
    $doctorName = $_POST['doctorName'];
    $patientName = $_SESSION['username'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $appointmentPlace = $_POST['appointmentPlace'];
    $status = "scheduled";

    $sql = "INSERT INTO appointments (appointmentId, doctorId, patientId, doctorName, patientName, date, time, appointmentPlace, status)
    VALUES ('$appointmentId', '$doctorId', '$patientId', '$doctorName', '$patientName', '$date', '$time', '$appointmentPlace', '$status')";

    if ($conn->query($sql) === true) {
        header("Location: bookApp.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
