<?php require_once 'admin_header.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<div style="width:70%; background-color:white;">
  <canvas id="myChart"></canvas>
</div>

<?php
      $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");

$query = "SELECT doctorName, COUNT(appointmentId) as total FROM appointments GROUP BY doctorName";
$result = mysqli_query($conn, $query);

$doctors = array();
$total = array();

while($row = mysqli_fetch_assoc($result)) {
  array_push($doctors, $row['doctorName']);
  array_push($total, $row['total']);
}
?>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($doctors); ?>,
        datasets: [{
            label: 'Number of Appointments',
            data: <?php echo json_encode($total); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<br><br>
<div style="background-color:white;">
<canvas id="appointmentsStatusChart"></canvas>
</div>
  <script>
    var ctx = document.getElementById("appointmentsStatusChart").getContext('2d');
    var appointmentsStatusChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["completed", "scheduled", "cancelled"],
        datasets: [{
          label: 'Appointments Status',
          data: [
            <?php
            $conn = mysqli_connect("localhost", "root", "", "doctor_appointment_system");
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
            
            $query = "SELECT status, COUNT(status) as count FROM appointments GROUP BY status";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
              echo $row['count'] . ',';
            }
            mysqli_close($conn);
            ?>
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  </script>