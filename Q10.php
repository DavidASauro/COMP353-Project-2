<?php
include 'Connect.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="LandingPage.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Employees.php">Employees</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Facilities.php">Facilities</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Vaccines.php">Vaccines</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Infections.php">Infections</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Email.php">Email</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Schedule.php">Schedule</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="WorksAt.php">WorksAt</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Arranges.php">Arranges</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Sends.php">Sends</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="EmployeeAddress.php">EmployeeAddress</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="FacilityAddress.php">FacilityAddress</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="FacilityCity.php">FacilityCity</a>
      </li>
  </ul>

  <form method="POST">
    <label for="fid">Facility ID:</label><br>
    <input type="number"  id="fid" name="fid" ><br>
    <button type="submit" name="submit" class="btn btn-outline-success btn-lg">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {

    $fid = $_POST['fid'];


    $query = "SELECT *
    FROM Email
    WHERE sender = '$fid'
    ORDER BY dateofemail ASC;";

    //echo $query;
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result) {
        // echo "<pre>";
        // print_r(mysqli_fetch_assoc($result));
        // echo "</pre>";
      // Display the results in a table
      echo "<table class =\"table\">";
      echo "<tr><th>EmailID</th><th>Email Body</th><th>Date Of Email</th><th>Receiver</th>
      <th>Subject</th>
      <th>Sender</th>";
       echo "<br>";
       
      while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr>";
        echo "<td>".$row['emailID']."</td>";
        echo "<td>".$row['emailbody']."</td>";
        echo "<td>".$row['dateofemail']."</td>";
        echo "<td>".$row['receiver']."</td>";
        echo "<td>".$row['subject']."</td>";
        echo "<td>".$row['sender']."</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "Error: " . mysqli_error($conn);
  }
}
?>

</body>
</html>