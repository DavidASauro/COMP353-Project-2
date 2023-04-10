<?php
include 'Connect.php'
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>HFESTS</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
</head>


<body>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="LandingPage.php">Home</a>
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
        <a class="nav-link active" href="Schedule.php">Schedule</a>
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
<br>
<form>
  <div class="row" method = "get">
<div class="form-group col-md-2">
  <label for="fid">Facility ID:</label><br>
  <input type="number" class="form-control" id="fid" name="fid"><br>
</div>
<div class="form-group col-md-2">
  <label for="medicare">Medicare Number:</label><br>
  <input type="text" class="form-control" id="medicare" name="medicare" minlength="12" maxlength="12"><br>
</div>
  <div class="form-group col-md-2">
  <label for="sdate">Scheduled Date:</label><br>
  <input type="date" class="form-control" id="sdate" name="sdate"><br>
</div>
<div class="form-group col-md-2">
  <label for="stime">Start Time:</label><br>
  <input type="time" class="form-control" id="stime" name="stime"><br>
</div>
<div class="form-group col-md-2">
  <label for="etime">End Time:</label><br>
  <input type="time" class="form-control" id="etime" name="etime"><br>
</div>
<div class="form-group col-md-2">
  <br>
<button type="submit" name = "submit" class="btn btn-outline-success">Submit</button>
</div>
  </div>

  
</form>

<?php 

$tablename = 'Schedule';
$query = 'SHOW COLUMNS FROM '. $tablename; 
$column_names = mysqli_query($conn, $query);
echo "<br>";
echo "<table class =\"table\">";
echo "<tr>";
while($row = mysqli_fetch_assoc($column_names)) {
	echo '<th>' . $row['Field'] . '</th>';
}

echo '<th> Delete </th>';


 $query = 'SELECT * FROM '. $tablename;
 $table_data = mysqli_query($conn, $query);
 while ($row = mysqli_fetch_assoc($table_data)) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>" . $value . "</td>";
    }

	echo "<td> <button type ='submit' class= \"btn btn-outline-danger\" name ='delete' value =''> Delete </button> </td>";
    echo "</tr>";
}
echo "</table>";

if (isset($_GET['submit'])) {

  $endtime = $_GET['etime'];
  $facilityID = $_GET['fid'];
  $medicarenum = $_GET['medicare'];
  $scheduledate = $_GET['sdate'];
  $starttime = $_GET['stime'];

  $query1 = "INSERT INTO Schedule (endtime,facilityID,medicarenum,scheduledate,starttime ) 
  VALUES ('$endtime', '$facilityID', '$medicarenum', '$scheduledate', '$starttime')";
  $result1 = mysqli_query($conn, $query1);


  if ($result1) {
    echo "Row added successfully.";
  } else {
   
  }
}












?>

</body>
</html>