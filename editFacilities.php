<?php


// Check if facilityID is set
if (!isset($_GET['facilityID'])) {
    echo "Error: facilityID is not set.";
    exit();
}
if (!isset($_GET['address'])) {
    echo "Error: Address is not set.";
    exit();
}
if (!isset($_GET['postalcode'])) {
    echo "Error: Postal Code is not set.";
    exit();
}

// Connect to the database
include "Connect.php";


// Get the facility data based on facilityID
$facilityID = $_GET['facilityID'];
$sql = "SELECT * FROM Facilities WHERE facilityID = '$facilityID'";
$result = mysqli_query($conn, $sql);

$postal = $_GET['postalcode'];
$sql2 = "SELECT * FROM FacilityCity WHERE postalcode = '$postal'";
$result2 = mysqli_query($conn, $sql2);

$address = $_GET['address'];


// Check if facility exists
if (mysqli_num_rows($result) == 0) {
    echo "Error: Facility not found.";
    exit();
}
if (mysqli_num_rows($result2) == 0) {
    echo "Error: Facility not found.";
    exit();
}

// Get the facility data as an array
$row = mysqli_fetch_assoc($result);
$row2 = mysqli_fetch_assoc($result2);

$city = $row2['city'];
$sql3 = "SELECT * FROM FacilityAddress WHERE city = '$city' AND address = '$address'";
$result3 = mysqli_query($conn, $sql3);

$row3 = mysqli_fetch_assoc($result3);
// Close the database connection

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Facility</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h1>Edit Facility</h1><br>
    <form method="POST">
    <input type="hidden" name="facilityID" value="<?php echo $row['facilityID']; ?>">
    <input type="hidden" name="oldpostal" value="<?php echo $row2['postalcode']; ?>">
    <input type="hidden" name="oldaddress" value="<?php echo $row3['address']; ?>">
    <input type="hidden" name="oldcity" value="<?php echo $row3['city']; ?>">

    <label for="name">Facility Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    <label for="address">Address:</label>
    <input type="text" name="address" value="<?php echo $row['address']; ?>"><br><br>
    
    <label for="capacity">Capacity:</label>
    <input type="number" name="capacity" value="<?php echo $row['capacity']; ?>"><br><br>

    <label for="phonenum">Phone Number:</label>
    <input type="tel" name="phonenum" value="<?php echo $row['phonenum']; ?>"><br><br>

    <label for="type">Facility Type:</label>
    <input type="text" name="facilitytype" value="<?php echo $row['facilitytype']; ?>"><br><br>

    <label for="webaddress">Web Address:</label>
    <input type="text" name="webaddress" value="<?php echo $row['webaddress']; ?>"><br><br>

    <label for="postalcode">Postal Code:</label>
    <input type="text" name="postalcode" value="<?php echo $row['postalcode']; ?>"><br><br>

    <label for="city">City:</label>
    <input type="text" name="city" value="<?php echo $row2['city']; ?>"><br><br>

    <label for="province">Province:</label>
    <input type="text" name="province" value="<?php echo $row3['province']; ?>"><br><br>

    <button class = "btn btn-outline-success" type="submit" name="submit" value="Submit">Submit</button>
    </form>

    <?php
    if(isset($_POST['submit'])) {

        $facilityID = $_POST["facilityID"];
        $facilityName = $_POST["name"];
        $facilityType = $_POST["facilitytype"];
        $facilityAddress = $_POST["address"];
        $facilityCapacity = $_POST["capacity"];
        $facilityPhonenum = $_POST["phonenum"];
        $facilityWeb = $_POST["webaddress"];
        $facilityPostalCode = $_POST["postalcode"];
        $facilitycity = $_POST["city"];
        $facilityprovince = $_POST["province"];



        $oldpostal = $_POST['oldpostal'];
        $oldaddress = $_POST['oldaddress'];
        $oldcity = $_POST['oldcity'];

        $sql4 = "DELETE FROM FacilityCity WHERE postalcode = '$oldpostal'";

        $sql5 = "DELETE FROM FacilityAddress WHERE address = '$oldaddress' AND city = '$oldcity'";
    
        // Prepare update statement
        $sql6 = "UPDATE Facilities SET name ='$facilityName', facilitytype ='$facilityType', address ='$facilityAddress', capacity ='$facilityCapacity', phonenum='$facilityPhonenum', webaddress ='$facilityWeb', postalcode ='$facilityPostalCode' WHERE facilityID ='$facilityID'";

        $sql7 = "INSERT INTO FacilityCity (postalcode,city) VALUES ('$facilityPostalCode', '$facilitycity') ";
        $sql8 = "INSERT INTO FacilityAddress (address,city,province) VALUES ('$facilityAddress', '$facilitycity', '$facilityprovince') ";



        if ($conn->query($sql4) === TRUE &&$conn->query($sql5) === TRUE &&$conn->query($sql6) === TRUE&&$conn->query($sql7) === TRUE &&$conn->query($sql8) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $conn->error;
          }
    }
    ?>
</form>

<button onclick= "window.location.href = 'Facilities.php';"  class="btn btn-outline-danger" value="Back">Back</button>



</body>
</html>
