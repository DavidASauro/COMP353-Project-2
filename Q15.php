
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
   

    $query = "SELECT E.firstname, E.lastname, E.dateofbirth, E.emailaddress, 
    MIN(W.startdate) AS first_day, 
    SUM(TIMESTAMPDIFF(HOUR, S.starttime, S.endtime)) AS total_hours_scheduled
FROM Employees E, WorksAt W, Schedule S,
(SELECT SUM(TIMESTAMPDIFF(HOUR, S1.starttime, S1.endtime)) AS total_hours_scheduled, S1.medicarenum
FROM Schedule S1
GROUP BY S1.medicarenum) AS T
WHERE E.role = 'Nurse' 
AND W.enddate IS NULL
AND E.medicarenum = W.medicarenum
AND E.medicarenum = S.medicarenum
AND E.medicarenum = T.medicarenum
AND T.total_hours_scheduled = (
   SELECT MAX(total_hours_scheduled) 
   FROM 
     (SELECT SUM(TIMESTAMPDIFF(HOUR, S2.starttime, S2.endtime)) AS total_hours_scheduled, S2.medicarenum
      FROM Schedule S2
      GROUP BY S2.medicarenum) AS T2
   WHERE T2.medicarenum = T.medicarenum)
GROUP BY E.medicarenum";

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
      echo "<tr><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Email Address</th><th>First Day</th><th>Total Hours Scheduled</th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['dateofbirth']."</td>";
        echo "<td>".$row['emailaddress']."</td>";
        echo "<td>".$row['first_day']."</td>";
        echo "<td>".$row['total_hours_scheduled']."</td>";
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