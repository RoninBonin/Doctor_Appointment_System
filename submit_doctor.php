<?php

$conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$doctorId = mysqli_real_escape_string($conn, $_POST['doctorId']);
$doctorName = mysqli_real_escape_string($conn, $_POST['doctorName']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$speciality = mysqli_real_escape_string($conn, $_POST['speciality']);
$qualifications = mysqli_real_escape_string($conn, $_POST['qualifications']);

$sql = "INSERT INTO doctors (doctorId, doctorName, gender, speciality, qualifications)
VALUES ('$doctorId', '$doctorName', '$gender', '$speciality', '$qualifications')";

if (mysqli_query($conn, $sql)) {
    echo "Doctor added successfully";
    header("location: manage_doctors.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
