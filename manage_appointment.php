<?php require_once 'admin_header.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title >Make Appointment</title>
  <link rel="stylesheet" href="style.css">
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>
  <h2 style="color:white;">Make Appointment</h2>

  <table>
    <tr>
      <th>Appointment ID</th>
      <th>Doctor ID</th>
      <th>Patient ID</th>
      <th>Doctor Name</th>
      <th>Patient Name</th>
      <th>Date</th>
      <th>Time</th>
      <th>Appointment Place</th>
      <th>Status</th>
    </tr>
    <?php
      require_once 'db_connect.php';
      $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Get all appointment data from the appointments table
      $sql = "SELECT appointmentId, doctorId, patientId, doctorName, patientName, date, time, appointmentPlace, status FROM appointments";
      $result = mysqli_query($conn, $sql);

      // Loop through the data and display each row as a table row
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["appointmentId"] . "</td>";
          echo "<td>" . $row["doctorId"] . "</td>";
          echo "<td>" . $row["patientId"] . "</td>";
          echo "<td>" . $row["doctorName"] . "</td>";
          echo "<td>" . $row["patientName"] . "</td>";
          echo "<td>" . $row["date"] . "</td>";
          echo "<td>" . $row["time"] . "</td>";
          echo "<td>" . $row["appointmentPlace"] . "</td>";
          echo "<td>" . $row["status"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "0 results";
      }

      // Close the connection
      mysqli_close($conn);
    ?>
  </table>
  <br><br>
    <button id="showFormButton">Create Appointment</button>
    <div id="formContainer" style="display:none;">
    <form action="submitAppointment.php" method="post">
		<label>Doctor:</label>
		<select name="doctorId">
			<?php
      $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");
      $result = mysqli_query($conn, "SELECT doctorId, doctorName FROM doctors");
				while ($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['doctorId'] . "'>" . $row['doctorName'] . "</option>";
				}
			?>
		</select><br><br>

		<label>Date:</label>
		<input type="date" name="date"><br><br>

		<label>Time:</label>
		<input type="time" name="time"><br><br>

		<label>Appointment Place:</label>
		<input type="text" name="appointmentPlace"><br><br>

		<input type="submit" value="Submit">
	</form></div>

    <script>
  document.getElementById("showFormButton").addEventListener("click", function() {
  var formContainer = document.getElementById("formContainer");
  if (formContainer.style.display === "none") {
    formContainer.style.display = "block";
  } else {
    formContainer.style.display = "none";
  }
});
</script>

</body>
</html>


