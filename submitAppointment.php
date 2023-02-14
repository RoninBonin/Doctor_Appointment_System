<?php

   // Establish a connection to the database
   $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");
   // Check connection
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
   }
   
   // Retrieve the data from the form
   $doctorId = $_POST['doctorId'];
//    $patientId = $_POST['patientId'];
   $doctorName = $_POST['doctorName'];
//    $patientName = $_POST['patientName'];
   $date = $_POST['date'];
   $time = $_POST['time'];
   $appointmentPlace = $_POST['appointmentPlace'];
//    $status = $_POST['status'];
   
   // Insert the data into the database
   $sql = "INSERT INTO appointments (doctorId, doctorName, date, time, appointmentPlace)
   VALUES ('$doctorId', '$doctorName', '$date', '$time', '$appointmentPlace')";
   if (mysqli_query($conn, $sql)) {
      echo "Appointment made successfully";
   } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }
   // Close the connection
   mysqli_close($conn);
?>