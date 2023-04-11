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
        <a class="nav-link active" href="LandingPage.html">Home</a>
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
  <h1>Doctors of Quebec</h1>

<?php

   

    $query = "SELECT W.medicarenum, E.firstname, E.lastname, EA.city, COUNT(W.facilityID) as 'nb_of_facilities'
    FROM Employees as E, EmployeeAddress as EA, WorksAt as W
    WHERE EA.postalcode = E.postalcode AND EA.province = 'QC' AND W.medicarenum = E.medicarenum AND W.enddate IS NULL
    GROUP BY W.medicarenum
    ORDER BY EA.city, nb_of_facilities DESC";
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result) {
    //   echo "<pre>";
    //   print_r(mysqli_fetch_assoc($result));
    //   echo "</pre>";
      // Display the results in a table
      echo "<table class =\"table\">";
      echo "<tr><th>First Name</th><th>Last Name</th><th>City</th><th>Number of Facilities</th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['city']."</td>";
        echo "<td>".$row['nb_of_facilities']."</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "Error: " . mysqli_error($conn);
  }

?>
</body>
</html>