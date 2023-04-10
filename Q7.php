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
    $query = "SELECT E.firstname, E.lastname, W.startdate, E.dateofbirth, E.medicarenum, E.telephonenum, E.address, EA.city, EA.province, EA.postalcode, E.citizenship, E.emailaddress, W.facilityID
    FROM Employees as E, WorksAt as W, EmployeeAddress as EA
    WHERE E.medicarenum = W.medicarenum AND EA.medicarenum = E.medicarenum AND W.enddate IS NULL
    GROUP BY W.facilityID
    ORDER BY E.role, E.firstname, E.lastname";
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result) {
      // Display the results in a table
      echo "<table>";
      echo "<tr><th>First Name</th><th>Last Name</th><th>Start Date</th><th>Date Of Birth</th><th>Medicare Numeber</th><th>Phone Number</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th><th>citizenship</th></tr><th>Email</th></tr><th>FacilityID</th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['starttime']."</td>";
        echo "<td>".$row['dateofbirth']."</td>";
        echo "<td>".$row['medicarenum']."</td>";
        echo "<td>".$row['telephonenum']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['city']."</td>";
        echo "<td>".$row['province']."</td>";
        echo "<td>".$row['postalcode']."</td>";
        echo "<td>".$row['citizenship']."</td>";
        echo "<td>".$row['emailaddress']."</td>";
        echo "<td>".$row['facilityID']."</td>";
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