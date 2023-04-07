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
        <a class="nav-link " href="Employees.php">Employees</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="Facilities.php">Facilities</a>
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
<br>
<form>
  <div class="row">
  <div class="form-group col-md-2">
  <label for="fid">Facility ID:</label><br>
  <input type="number" class="form-control" id="fid" name="fid"><br>
</div>
<div class="form-group col-md-2">
  <label for="ftype">Facility Type:</label><br>
  <input type="text" class="form-control" id="ftype" name="ftype"><br>
</div>
<div class="form-group col-md-2">
  <label for="city">City:</label><br>
  <input type="text" class="form-control" id="city" name="city"><br>
</div>
<div class="form-group col-md-2">
  <label for="pnum">Phone Number:</label><br>
  <input type="number" class="form-control" id="pnum" name="pnum" minlength="10" maxlength="10"><br>
</div>
<div class="form-group col-md-2">
  <label for="address">Address:</label><br>
  <input type="text" class="form-control" id="address" name="address"><br>
</div>
<div class="form-group col-md-2">
  <label for="province">Province:</label><br>
  <input type="text" class="form-control" id="province" name="province"><br>
</div>
<div class="form-group col-md-2">
  <label for="web">Web Address:</label><br>
  <input type="text" class="form-control" id="citizen" name="citizen"><br>
</div>
<div class="form-group col-md-2">
  <label for="mail">Email:</label><br>
  <input type="email" class="form-control" id="mail" name="mail"><br>
</div>
<div class="form-group col-md-2">
  <label for="postal">Postal Code:</label><br>
  <input type="text" class="form-control" id="postal" name="postal" minlength="6" maxlength="6"><br>
</div>
  </div>

  <div class="mx-auto" style="width: 200px;">
<button type="submit" class="btn btn-outline-success btn-lg">Submit</button>
</div>

</form>

<?php 

$tablename = 'Facilities';
$query = 'SHOW COLUMNS FROM '. $tablename; 
$column_names = mysqli_query($conn, $query);
echo "<br><br>";
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
?>

</body>
</html>