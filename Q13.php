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
  <h1>Facility Info</h1>
<!-- <form method="POST">
  <label for="fid">Selecet Starting Date:</label><br>
  <input type="date"  id="day" name="day" ><br>

  <button type="submit" name="submit" class="btn btn-outline-success btn-lg">Submit</button>
</form> -->

<?php
  
  //if (isset($_POST['submit'])) {

    
   // $sdate = $_POST['day'];
   

    $query = "SELECT FA.province, F.name, F.capacity, COUNT(*) AS infected
    FROM Facilities F, Employees E, Infections I, WorksAt WA, FacilityAddress FA, FacilityCity FC
    WHERE F.facilityID = WA.facilityID 
      AND E.medicarenum = WA.medicarenum 
      AND E.medicarenum = I.medicarenum
      AND F.postalcode = FC.postalcode
      AND FC.city = FA.city
      AND F.address = FA.address
      AND I.dateofinfection BETWEEN DATE_SUB(CURDATE(), INTERVAL 14 DAY) AND CURDATE()
    GROUP BY FA.province, F.name, F.capacity
    ORDER BY FA.province ASC, infected ASC;";

    // echo $query;

    // SELECT Employees.role, SUM(TIMESTAMPDIFF(HOUR, starttime, endtime)) as total_hours_scheduled
    // FROM Schedule
    // JOIN Employees ON Schedule.medicarenum = Employees.medicarenum
    // WHERE Schedule.facilityID = '$fid' AND 
    //       scheduledate BETWEEN '$sdate' AND '$edate'
    // GROUP BY Employees.role
    // ORDER BY Employees.role ASC
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result) {
      // echo "<pre>";
      // print_r(mysqli_fetch_assoc($result));
      // echo "</pre>";
      
      echo "<table class =\"table\">";
      echo "<tr><th>Province</th><th>Name</th><th>Capacity</th><th>Infected</th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['province']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['capacity']."</td>";
        echo "<td>".$row['infected']."</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "Error: " . mysqli_error($conn);
  }
//}

?>
</body>
</html>