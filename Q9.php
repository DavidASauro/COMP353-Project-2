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
  <h1>Doctor Details</h1>

  <form method="POST">
    <label for="startdate">Start Date:</label><br>
    <input type="date"  id="startdate" name="startdate" ><br>
    <button type="submit" name="submit" class="btn btn-outline-success btn-lg">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $startdate = $_POST['startdate'];


    $query = "SELECT e.firstname, e.lastname, i.dateofinfection, f.name FROM Employees e, Infections i, Facilities f, WorksAt w
    WHERE e.medicarenum = i.medicarenum AND e.medicarenum = w.medicarenum AND w.facilityID = f.facilityID
      AND i.dateofinfection BETWEEN DATE_SUB('$startdate', INTERVAL 14 DAY) AND '$startdate' AND e.role = 'Doctor' AND f.name IS NOT NULL ORDER BY f.name ASC, e.firstname ASC;";

    //echo $query;
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result) {

      // Display the results in a table
      echo "<table class =\"table\">";
      echo "<tr><th>First Name</th><th>Last Name</th><th>Date Of Infection</th><th>Facility Name</th>";
       echo "<br>";
       
      while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['dateofinfection']."</td>";
        echo "<td>".$row['name']."</td>";
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