<?php require_once 'admin_header.php'; ?>

<h2 style="color:white;">DOCTOR MANAGEMENT PAGE</h2>

<div class="form-group col-md-4">
  <input type="text" class="form-control" id="searchInput" onkeyup="searchFunction()" placeholder="Search for doctor names">
</div>


<?php
  $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");

  $query = "SELECT * FROM doctors";

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT doctorId, doctorName, gender, speciality, qualifications FROM doctors";
  $result = mysqli_query($conn, $sql);
  $total_rows = mysqli_num_rows($result);
  $per_page = 5;
  $total_pages = ceil($total_rows / $per_page);
  $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
  if($page > $total_pages) {
    $page = $total_pages;
  }
  if($page < 1) {
    $page = 1;
  }
  $start = ($page - 1) * $per_page;
  $query = "SELECT * FROM doctors LIMIT $start, $per_page";
  $result = mysqli_query($conn, $query);
  

  echo "<table>";
  echo "<tr>";
  echo "<th>Doctor ID</th>";
  echo "<th>Doctor Name</th>";
  echo "<th>Gender</th>";
  echo "<th>Speciality</th>";
  echo "<th>Qualifications</th>";
  echo "<th>Actions</th>";
  echo "</tr>";
  
  while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row["doctorId"] . "</td>";
      echo "<td>" . $row["doctorName"] . "</td>";
      echo "<td>" . $row["gender"] . "</td>";
      echo "<td>" . $row["speciality"] . "</td>";
      echo "<td>" . $row["qualifications"] . "</td>";
      echo "<td>";
      echo "<a href='editDoctor.php?id=" . $row["doctorId"] . "'>Edit</a> | ";
      echo "<a href='deleteDoctor.php?id=" . $row["doctorId"] . "'>Delete</a>";
      echo "</td>";
      echo "</tr>";
  }
  echo "</table>";
  echo "<div class='pagination' style='text-align: center;'>";
  for($i = 1; $i <= $total_pages; $i++) {
    if($i == $page) {
      echo "<span class='current-page'>" . $i . "</span>";
    } else {
      echo "<a href='manage_doctors.php?page=" . $i . "'>" . $i . "</a>";
    }
  }
  echo "</div>";
  mysqli_close($conn);
?>
<link rel="stylesheet" href="style.css">

<br><br>
<button id="showFormButton">Add Doctor</button>
<div id="formContainer" style="display:none;">
  <form action="submit_doctor.php" method="post">
    <input type="text" name="doctorId" placeholder="Doctor ID"><br><br>
    <input type="text" name="doctorName" placeholder="Doctor Name"><br><br>
    <input type="text" name="gender" placeholder="Gender"><br><br>
    <input type="text" name="speciality" placeholder="Speciality"><br><br>
    <input type="text" name="qualifications" placeholder="Qualifications"><br><br>
    <input type="submit" value="Submit">
  </form>
</div>

<script>
  document.getElementById("showFormButton").addEventListener("click", function() {
  var formContainer = document.getElementById("formContainer");
  if (formContainer.style.display === "none") {
    formContainer.style.display = "block";
  } else {
    formContainer.style.display = "none";
  }
});

function searchFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("doctorTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>
