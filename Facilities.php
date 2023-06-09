<?php
include 'Connect.php';
$toggleManagerID = isset($_GET['toggleManagerID']);
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
    <div class="row" method="get">
      <div class="form-group col-md-2">
        <label for="fid">Facility ID:</label><br>
        <input type="number" class="form-control" id="fid" name="fid"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="ftype">Facility Type:</label><br>
        <input type="text" class="form-control" id="ftype" name="ftype"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="ftype">Capacity:</label><br>
        <input type="number" class="form-control" id="capacity" name="capacity"><br>
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
        <label for="manager">Manager ID:</label><br>
        <input type="text" class="form-control" id="manager" name="manager"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="web">Web Address:</label><br>
        <input type="text" class="form-control" id="web" name="web"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="name">Name:</label><br>
        <input type="text" class="form-control" id="name" name="name"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="postal">Postal Code:</label><br>
        <input type="text" class="form-control" id="postal" name="postal" minlength="6" maxlength="6"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="province">Province:</label><br>
        <input type="text" class="form-control" id="province" name="province" minlength="2" ><br>
      </div>
      <div class="form-group">
        <label class="form-check-label" for="manager_toggle">Enable Manager ID</label>
        <input type="checkbox" class="form-check-input" id="manager_toggle" name="manager_toggle" <?php if($toggleManagerID) echo "checked"; ?>>
      </div>
    </div>

    <div class="mx-auto" style="width: 200px;">
      <button type="submit" name="submit" class="btn btn-outline-success btn-lg">Submit</button>
    </div>

  </form>

  <?php
  $togglemanagerID = isset($_GET['togglemanagerID']) ? $_GET['togglemanagerID'] : false;
  $tablename = 'Facilities';
  $query = 'SHOW COLUMNS FROM ' . $tablename;
  $column_names = mysqli_query($conn, $query);
  echo "<br><br>";
  echo "<table class =\"table\">";
  echo "<tr>";
  while ($row = mysqli_fetch_assoc($column_names)) {
    echo '<th>' . $row['Field'] . '</th>';
  }
  echo '<th> Edit </th>';
  echo '<th> Delete </th>';


  $query = 'SELECT * FROM ' . $tablename;
  $table_data = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($table_data)) {
    echo "<tr>";
    foreach ($row as $value) {
      echo "<td>" . $value . "</td>";
    }
    echo "<td>";
    echo "<form action='editFacilities.php' method='get'>";
    echo "<input type='hidden' name='facilityID' value='" . $row['facilityID'] . "'>";
    echo "<input type='hidden' name='postalcode' value='" . $row['postalcode'] . "'>";
    echo "<input type='hidden' name='address' value='" . $row['address'] . "'>";
    echo "<button class='btn btn-outline-success' type='submit'>Edit</button>";
    echo "</form>";
    echo "</td>";


    echo "<td>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='facilityID' value='" . $row['facilityID'] . "'>";
    echo "<input type='hidden' name='address' value='" . $row['address'] . "'>";
    echo "<input type='hidden' name='postalcode' value='" . $row['postalcode'] . "'>";
    echo "<button type='submit' class='btn btn-outline-danger' name='delete'>Delete</button>";
    echo "</form>";
    echo "</td>";
  }
  echo "</table>";

  if (isset($_POST['delete'])) {

    $facilityID = $_POST['facilityID'];
    $address = $_POST['address'];
    $postalcode = $_POST['postalcode'];

    $querycity = "SELECT city FROM FacilityAddress WHERE '$address' = address";
    $resultcity = mysqli_query($conn, $querycity);
    $rowcity = mysqli_fetch_assoc($resultcity);

    $city = $rowcity['city'];


    $query = "DELETE FROM $tablename WHERE FacilityID = '$facilityID'";
    $result = mysqli_query($conn, $query);

    $query1 = "DELETE FROM FacilityAddress WHERE address = '$address'";
    $result1 = mysqli_query($conn, $query1);

    $query2 = "DELETE FROM FacilityCity WHERE city = '$city' AND postalcode = '$postalcode'";
    $result2 = mysqli_query($conn, $query2);

    $query3 = "DELETE FROM Schedule WHERE FacilityID = '$facilityID'";
    $result3 = mysqli_query($conn, $query3);

    $query4 = "DELETE FROM Sends WHERE FacilityID = '$facilityID'";
    $result4 = mysqli_query($conn, $query4);

    $query5 = "DELETE FROM WorksAt WHERE FacilityID = '$facilityID'";
    $result5 = mysqli_query($conn, $query5);

    $query6 = "DELETE FROM Arranges WHERE FacilityID = '$facilityID'";
    $result6 = mysqli_query($conn, $query6);


    if ($result && $result1 && $result2 && $result3 && $result4 && $result5  && $result6) {
      echo "Row deleted successfully.";
    } else {
      echo "Error deleting row: " . mysqli_error($conn);
    }
  }
  if (isset($_GET['submit'])) {

    $address = $_GET['address'];
    $capacity = $_GET['capacity'];
    $facilityID = $_GET['fid'];
    $facilityType = $_GET['ftype'];
    $name = $_GET['name'];
    $phonenum = $_GET['pnum'];
    $postalcode = $_GET['postal'];
    $webaddress = $_GET['web'];
    $city = $_GET['city'];
    $province = $_GET['province'];

    if (isset($_GET['manager_toggle']) && $_GET['manager_toggle'] == "on") {
      echo "HERE";
        $managerID = $_GET['manager'];
        $query1 = "INSERT INTO Facilities (address, capacity, facilityID, facilitytype, managerID, name, phonenum, postalcode, webaddress) 
        VALUES ('$address', '$capacity', '$facilityID', '$facilityType', '$managerID', '$name', '$phonenum', '$postalcode', '$webaddress')";
          $result1 = mysqli_query($conn, $query1);
    }else{
      echo "null";
      $query1 = "INSERT INTO Facilities (address, capacity, facilityID, facilitytype, name, phonenum, postalcode, webaddress) 
      VALUES ('$address', '$capacity', '$facilityID', '$facilityType', '$name', '$phonenum', '$postalcode', '$webaddress')";
      $result1 = mysqli_query($conn, $query1);
    }

    $query2 = "INSERT INTO FacilityAddress (address, city, province) 
  VALUES ('$address', '$city', '$province')";
    $result2 = mysqli_query($conn, $query2);

    $query3 = "INSERT INTO FacilityCity (city, postalcode) 
  VALUES ('$city', '$postalcode')";
    $result3 = mysqli_query($conn, $query3);


    if ($result1 && $result2 && $result3) {
      echo "Row added successfully.";
    } else {
    }
  }




  ?>

</body>

</html>