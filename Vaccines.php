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
        <a class="nav-link active" href="Vaccines.php">Vaccines</a>
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
  <label for="medicare">Medicare Number:</label><br>
  <input type="text" class="form-control" id="medicare" name="medicare" minlength="12" maxlength="12"><br>
</div>
<div class="form-group col-md-2">
  <label for="vdate">Date:</label><br>
  <input type="date" class="form-control" id="vdate" name="vdate"><br>
</div>
<div class="form-group col-md-2">
  <label for="type">Type:</label><br>
  <input type="text" class="form-control" id="type" name="type"><br>
</div>
<div class="form-group col-md-2">
  <label for="doseno">Dose Number:</label><br>
  <input type="number" class="form-control" id="doseno" name="doseno"><br>
</div>
<div class="form-group col-md-2">
  <br>
<button type="submit" class="btn btn-outline-success">Submit</button>
</div>
</div>


</form>

<?php 

$tablename = 'Vaccines';
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

    echo "<td>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='value1' value='" . $row['medicarenum'] . "'>";
    echo "<input type='hidden' name='value2' value='" . $row['type'] . "'>";
    echo "<input type='hidden' name='value3' value='" . $row['date'] . "'>";
    echo "<button type='submit' class='btn btn-outline-danger' name='delete'>Delete</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

if(isset($_POST['delete'])) {
   
  $value1 = $_POST['value1'];
  $value2 = $_POST['value2'];
  $value3 = $_POST['value3'];

  $query = "DELETE FROM $tablename WHERE value1='$value1' AND value2='$value2' AND value3='$value3";
  $result = mysqli_query($conn, $query);

  if($result) {
      echo "Row deleted successfully.";
  } else {
      echo "Error deleting row: " . mysqli_error($conn);
  }
}

















?>

</body>
</html>