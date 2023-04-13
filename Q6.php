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
  <h1>Facility Details</h1>

<?php

   

    $query = "SELECT F.name, FA.address, FC.city, FA.province, FC.postalcode, F.phonenum, F.webaddress, F.facilitytype, F.capacity, F.managerID, COUNT(W.facilityID) AS 'nb_of_current_employees' 
    FROM Facilities as F, FacilityAddress as FA, FacilityCity as FC, WorksAt as W
    WHERE F.address = FA.address AND F.postalcode = FC.postalcode AND W.enddate IS NULL AND F.facilityID = W.facilityID
    GROUP BY W.facilityID
    ORDER BY FA.province, FC.city, F.facilitytype, nb_of_current_employees";
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result) {
      // echo "<pre>";
      // print_r(mysqli_fetch_assoc($result));
      // echo "</pre>";
      // Display the results in a table
      echo "<table class =\"table\">";
      echo "<tr><th>Name</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th><th>Phone Number</th><th>Web Address</th><th>Type</th><th>Capacity</th><th>General Manager</th><th>Number of Employees</th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['city']."</td>";
        echo "<td>".$row['province']."</td>";
        echo "<td>".$row['postalcode']."</td>";
        echo "<td>".$row['phonenum']."</td>";
        echo "<td>".$row['webaddress']."</td>";
        echo "<td>".$row['facilitytype']."</td>";
        echo "<td>".$row['capacity']."</td>";
        echo "<td>".$row['managerID']."</td>";
        echo "<td>".$row['nb_of_current_employees']."</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "Error: " . mysqli_error($conn);
  }

?>











</body>
</html>