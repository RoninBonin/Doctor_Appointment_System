<?php require_once 'patient_header.php'; ?>

<html>
<head>
  <title>Book Appointment</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
    }
  </style>
</head>
<body>
  <h2>Available Appointments</h2>
  <table>
    <tr>
      <th>Appointment ID</th>
      <th>Doctor ID</th>
      <th>Doctor Name</th>
      <th>Date</th>
      <th>Time</th>
      <th>Action</th>
    </tr>
    <?php
$conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");
$sql = "SELECT appointmentId, doctorId, doctorName, date, time FROM appointments";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['appointmentId'] . "</td>";
        echo "<td>" . $row['doctorId'] . "</td>";
        echo "<td>" . $row['doctorName'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td><a href='submitApp.php?id=" . $row['appointmentId'] . "'>Book</a></td>";
        echo "</tr>";
      }
    ?>
  </table>
</body>
</html>
