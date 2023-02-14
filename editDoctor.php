<?php require_once 'admin_header.php'; ?>

<?php
  $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");

  if (isset($_GET['edit'])) {
    $doctorId = $_GET['edit'];
    
    $sql = "SELECT TABLE FROM doctors WHERE doctorId='$doctorId'";
    $result = mysqli_query($conn, $sql);
    $doctor = mysqli_fetch_assoc($result);
  }

  if (isset($_POST['update'])) {
    $doctorId = $_POST['doctorId'];
    $doctorName = $_POST['doctorName'];
    $gender = $_POST['gender'];
    $speciality = $_POST['speciality'];
    $qualifications = $_POST['qualifications'];
    
    $sql = "UPDATE doctors SET doctorName='$doctorName', gender='$gender', speciality='$speciality', qualifications='$qualifications' WHERE doctorId='$doctorId'";
    mysqli_query($conn, $sql);
    
    header("Location: manage_doctors.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edit Doctor</title>
  </head>
  <body>
    <h1>Edit Doctor</h1>
    <form action="editDoctor.php" method="post">
      <input type="hidden" name="doctorId" value="<?php echo $doctor['doctorId']; ?>">
      <label for="doctorName">Doctor Name:</label>
      <input type="text" id="doctorName" name="doctorName"><br><br>
      <label for="gender">Gender:</label>
      <select id="gender" name="gender">
        <option value="Male" >Male</option>
        <option value="Female">Female</option>
      </select><br><br>
      <label for="speciality">Speciality:</label>
      <input type="text" id="speciality" name="speciality" ><br><br>
      <label for="qualifications">Qualifications:</label>
      <input type="text" id="qualifications" name="qualifications" ><br><br>
      <input type="submit" name="update" value="Update">     <a href="manage_doctors.php"><b>Go Back</b></a>
    </form>
  </body>
</html>
