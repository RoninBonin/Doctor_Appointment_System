<?php require_once 'header.php'; ?>

<?php

  // Check if the form has been submitted
  if (isset($_POST['submit'])) {
    // Get the form data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    require_once 'db_connect.php';
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");
    
    // Insert the new user into the database
    $query = "INSERT INTO users (fullname, username, password, email, phoneNumber, gender, address)
              VALUES ('$fullname', '$username', '$password', '$email', '$phone', '$gender', '$address')";
    mysqli_query($conn, $query);
    
    echo "<script>
    alert('Registration Successfully!');
    window.location.href='index.php';
    </script>"; 
    
    mysqli_close($conn);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Doctor Appointment System - Registration</title>
  </head>
  <body>
    <div style="padding-left:500px;">
    <h1>Doctor Appointment System - Registration</h1>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <label for="fullname">Full Name:</label>
      <input type="text" id="fullname" name="fullname" required><br><br>
    
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required><br><br>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br><br>
      
      <label for="phone">Phone Number:</label>
      <input type="text" id="phone" name="phone" required><br><br>

      <label for="gender">Gender:</label>
      <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select><br><br>
      
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" size="35%" style="height:100px;" required><br><br>

      <input type="submit" name="submit" value="Submit">
    </form>
<br><br>
<a>Already signed up ?<a>    
<a href="index.php"><b>Back to Login Page</b></a>
</div>
  </body>
</html>
