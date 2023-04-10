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
   
    $fid = $_POST["fid"];
    $query = "SELECT F.name, FA.address, FC.city, FA.province, FC.postalcode, F.phonenum, F.webaddress, F.facilitytype, F.capacity, E.firstname AS 'general_manager', COUNT(W.facilityID) AS 'nb_of_current_employees' 
    FROM Facilities as F, FacilityAddress as FA, FacilityCity as FC, WorksAt as W, Employees as E
    WHERE $fid = F.facilityID AND F.facilityID = FA.facilityID AND F.facilityID = FC.facilityID AND W.enddate IS NULL AND F.facilityID = W.facilityID AND E.medicarenum = F.managerID
    GROUP BY W.facilityID
    ORDER BY FA.province, FC.city, F.facilitytype, nb_of_current_employees";
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result) {
      // Display the results in a table
      echo "<table>";
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
        echo "<td>".$row['general_manager']."</td>";
        echo "<td>".$row['nb_of_current_employees']."</td>";
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