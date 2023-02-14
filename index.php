<?php require_once 'header.php'; ?>
<h1 style='text-align: center; font-size:50px; background: rgb(238,174,202);
background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);'>DOCTOR APPOINTMENT BOOKING SYSTEM</h1>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <h2>Sign In</h2>
  <input type="text" name="username" placeholder="Username"><br><br>
  <input type="password" name="password" placeholder="Password"><br><br>
  <input type="radio" id="user" name="role" value="user">
  <label for="user">User</label>
  <input type="radio" id="admin" name="role" value="admin">
  <label for="admin">Admin</label><br><br><br>
  <input type="submit" value="Login"><br><br>
  <a>Don't have any account ?</a>
  <a href="register.php"><b>Sign Up</b></a>
  </form>

</div>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  
  require_once 'db_connect.php';
  // Connect to the database
  $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");
  
  
  // If the user is an admin, redirect to the admin page
  if ($role == "admin") {
    $query = "SELECT username, password FROM admins WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if($result > 0)
    header("Location: admin.php");
  }
  // If the user is a user, redirect to the user page
  else if ($role == "user") {
    $query = "SELECT username, password FROM patients WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if($result > 0)
    header("Location: patient.php");
  }
  // If the login is unsuccessful, show an error message
  else {
    echo "<script>
    alert('Login Failed. Please try again');
    window.location.href='index.php';
    </script>"; 
  }
  
  mysqli_close($conn);
}
?>
