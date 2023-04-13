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
      <a class="nav-link" href="index.html">Home</a>
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
      <a class="nav-link active" href="Email.php">Email</a>
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
<!--
  <form>
    <div class="row">
      <div class="form-group col-md-2">
        <label for="emid">Email ID:</label><br>
        <input type="number" class="form-control" id="emid" name="emid"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="embody">Email Body:</label><br>
        <input type="text" class="form-control" id="embody" name="embody"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="emdate">Email Date:</label><br>
        <input type="date" class="form-control" id="emdate" name="emdate"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="rec">Receiver:</label><br>
        <input type="text" class="form-control" id="rec" name="rec"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="sub">Receiver:</label><br>
        <input type="text" class="form-control" id="sub" name="sub"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="send">Receiver:</label><br>
        <input type="text" class="form-control" id="send" name="send"><br>
      </div>



    </div>
    <div class="mx-auto" style="width: 200px;">
      <button type="submit" class="btn btn-outline-success btn-lg">Submit</button>
    </div>
  </form>
-->
  <?php

  $tablename = 'Email';
  $query = 'SHOW COLUMNS FROM ' . $tablename;
  $column_names = mysqli_query($conn, $query);
  echo "<table class =\"table\">";
  echo "<tr>";
  while ($row = mysqli_fetch_assoc($column_names)) {
    echo '<th>' . $row['Field'] . '</th>';
  }

  


  $query = 'SELECT * FROM ' . $tablename;
  $table_data = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($table_data)) {
    echo "<tr>";
    foreach ($row as $value) {
      echo "<td>" . $value . "</td>";
    }


    echo "</tr>";
  }
  echo "</table>";













  ?>

</body>

</html>