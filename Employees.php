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
      <a class="nav-link active" href="Employees.php">Employees</a>
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
  <br>
  <form>
    <div class="row" method ="get">
      <div class="form-group col-md-2">
        <label for="medicare">Medicare Number:</label><br>
        <input type="text" class="form-control" id="medicare" name="medicare" minlength="12" maxlength="12" placeholder="Medicare Number"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="fname">First Name:</label><br>
        <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="lname">Last Name:</label><br>
        <input type="text" placeholder="Last Name" class="form-control" id="lname" name="lname"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="dob">Birthday:</label><br>
        <input type="date" class="form-control" id="dob" name="dob"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="city">City:</label><br>
        <input class="form-control" placeholder="City" type="text" id="city" name="city"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="pnum">Phone Number:</label><br>
        <input type="number" class="form-control" placeholder="Phone Number" id="pnum" name="pnum" minlength="10" maxlength="10"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="address">Address:</label><br>
        <input type="text" class="form-control" placeholder="Street Address" id="address" name="address"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="province">Province:</label><br>
        <input type="text" class="form-control" placeholder="Province" id="province" name="province" maxlength="2"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="citizen">Citizenship:</label><br>
        <input type="text" class="form-control" placeholder="Citizenship" id="citizen" name="citizen" maxlength="2"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="mail">Email:</label><br>
        <input type="email" class="form-control" placeholder="Email" id="mail" name="mail"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="postal">Postal Code:</label><br>
        <input type="text" class="form-control" placeholder="Postal Code" id="postal" name="postal" minlength="6" maxlength="6"><br>
      </div>
      <div class="form-group col-md-2">
        <label for="role">Role:</label><br>
        <select class="form-control" name="role" id="role">
          <option value="nurse">Nurse</option>
          <option value="cashier">Cashier</option>
          <option value="pharmacist">Pharmacist</option>
          <option value="receptionist">Receptionist</option>
          <option value="administrative personnel">Administrative Personnel</option>
          <option value="security personnel">Security Personnel</option>
          <option value="regular employee">Regular Employee</option>
        </select>
      </div>

    </div>

    <div class="mx-auto" style="width: 200px;">
      <button type="submit" name="submit" class="btn btn-outline-success btn-lg">Submit</button>
    </div>

  </form>


  <?php

  $tablename = 'Employees';
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
    echo "<form action='editEmployees.php' method='get'>";
    echo "<input type='hidden' name='medicarenum' value='" . $row['medicarenum'] . "'>";
    echo "<input type='hidden' name='postalcode' value='" . $row['postalcode'] . "'>";
    echo "<button class='btn btn-outline-success' type='submit'>Edit</button>";
    echo "</form>";
    echo "</td>";

    echo "<td>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='medicarenum' value='" . $row['medicarenum'] . "'>";
    echo "<input type='hidden' name='postal' value='" . $row['postalcode'] . "'>";
    echo "<button type='submit' class='btn btn-outline-danger' name='delete'>Delete</button>";
    echo "</form>";
    echo "</td>";

    echo "</tr>";
  }
  echo "</table>";

  if (isset($_POST['delete'])) {

    $medicarenum = $_POST['medicarenum'];
    $postal = $_POST['postal'];

    $query = "DELETE FROM $tablename WHERE medicarenum = '$medicarenum'";
    $result = mysqli_query($conn, $query);

    $query1 = "DELETE FROM EmployeeAddress WHERE postalcode = '$postal'";
    $result1 = mysqli_query($conn, $query1);

    $query2 = "DELETE FROM Infections WHERE medicarenum = '$medicarenum'";
    $result2 = mysqli_query($conn, $query2);

    $query3 = "DELETE FROM Schedule WHERE medicarenum = '$medicarenum'";
    $result3 = mysqli_query($conn, $query3);

    $query4 = "DELETE FROM Vaccines WHERE medicarenum = '$medicarenum'";
    $result4 = mysqli_query($conn, $query4);

    $query5 = "DELETE FROM WorksAt WHERE medicarenum = '$medicarenum'";
    $result5 = mysqli_query($conn, $query5);


    if ($result && $result1 && $result3 && $result4 && $result5 && $result2) {
      echo "Row deleted successfully.";
    } else {
      echo "Error deleting row: " . mysqli_error($conn);
    }
  }

  if (isset($_GET['submit'])) {

    $medicare = $_GET['medicare'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $dob = $_GET['dob'];
    $city = $_GET['city'];
    $pnum = $_GET['pnum'];
    $address = $_GET['address'];
    $province = $_GET['province'];
    $citizen = $_GET['citizen'];
    $mail = $_GET['mail'];
    $postal = $_GET['postal'];
    $role = $_GET['role'];

    $query1 = "INSERT INTO Employees (address, citizenship, dateofbirth, emailaddress, firstname, lastname, medicarenum, postalcode, role, telephonenum) 
    VALUES ('$address', '$citizen', '$dob', '$mail', '$fname', '$lname', '$medicare', '$postal', '$role', '$pnum')";
    $result1 = mysqli_query($conn, $query1);

    $query2 = "INSERT INTO EmployeeAddress (city, postalcode, province) VALUES
    ('$city', '$postal', '$province')";
    $result2 = mysqli_query($conn, $query2);


    if ($result1 && $result2) {
      echo "Row added successfully.";
    } else {
     
    }
  }

  ?>

</body>

</html>