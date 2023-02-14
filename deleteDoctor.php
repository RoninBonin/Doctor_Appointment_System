<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the doctor id from the URL
$doctor_id = $_GET['id'];

// Delete the doctor from the database
$sql = "DELETE FROM doctors WHERE doctorId = $doctor_id";

if (mysqli_query($conn, $sql)) {
    // Redirect to the manage doctors page
    header("Location: manage_doctors.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
