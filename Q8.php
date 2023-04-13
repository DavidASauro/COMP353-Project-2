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
        <a class="nav-link active" href="index.html">Home</a>
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
    <label for="startdate">Start Date:</label><br>
    <input type="date"  id="startdate" name="startdate" ><br>
    <label for="enddate">End Date:</label><br>
    <input type="date"  id="enddate" name="enddate" ><br>
    <label for="mnum">Medicare Number:</label><br>
    <input type="text"  id="mnum" name="mnum" ><br>
    <button type="submit" name="submit" class="btn btn-outline-success btn-lg">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {

    $startdate = $_POST["startdate"];
    $mnum = $_POST["mnum"];
    $enddate = $_POST["enddate"];


    $query = "SELECT f.name, s.scheduledate, s.starttime, s.endtime 
    FROM Schedule s, Facilities f, Employees e 
    WHERE s.facilityID = f.facilityID 
    AND s.medicarenum = e.medicarenum
    AND e.medicarenum = '$mnum' 
    AND s.scheduledate BETWEEN '$startdate' AND '$enddate'
    AND f.name IS NOT NULL
    ORDER BY f.name ASC, s.scheduledate ASC, s.starttime ASC; ";

    //echo $query;
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result) {
    //     echo "<pre>";
    // print_r(mysqli_fetch_assoc($result));
    // echo "</pre>";
        
      // Display the results in a table
      echo "<table class =\"table\">";
      echo "<tr><th>Facility Name</th><th>Scheduled Date</th><th>Start Time</th><th>End Time</th>";

      while ($row = mysqli_fetch_array($result)) {

        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['scheduledate']."</td>";
        echo "<td>".$row['starttime']."</td>";
        echo "<td>".$row['endtime']."</td>";
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