<?php


// Check if facilityID is set
if (!isset($_GET['medicarenum'])) {
    echo "Error: medicarenum is not set.";
    exit();
}
if (!isset($_GET['postalcode'])) {
    echo "Error: Postal Code is not set.";
    exit();
}

// Connect to the database
include "Connect.php";



$medicarenum = $_GET['medicarenum'];
$sql1 = "SELECT * FROM Employees WHERE medicarenum = '$medicarenum'";
$result = mysqli_query($conn, $sql1);

$postal = $_GET['postalcode'];
$sql2 = "SELECT * FROM EmployeeAddress WHERE postalcode = '$postal'";
$result2 = mysqli_query($conn, $sql2);



if (mysqli_num_rows($result) == 0) {
    echo "Error: Employee not found.";
    exit();
}

if (mysqli_num_rows($result2) == 0) {
    echo "Error: Employee not found.";
    exit();
}


$row = mysqli_fetch_assoc($result);
$rowaddress = mysqli_fetch_assoc($result2);



?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <h1>Edit Employee</h1><br>
    <form method="POST">
        <input type="hidden" name="medicarenum" value="<?php echo $row['medicarenum']; ?>">
        <input type="hidden" name="oldpostal" value="<?php echo $rowaddress['postalcode']; ?>">

        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>"><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>"><br><br>

        <label for="dateofbirth">DOB:</label>
        <input type="date" name="dateofbirth" value="<?php echo $row['dateofbirth']; ?>"><br><br>

        <label for="telephonenum">Phone Number:</label>
        <input type="tel" name="telephonenum" value="<?php echo $row['telephonenum']; ?>"><br><br>

        <label for="citizenship">Citizenship:</label>
        <input type="text" name="citizenship" value="<?php echo $row['citizenship']; ?>"><br><br>

        <label for="emailaddress">Email Address:</label>
        <input type="text" name="emailaddress" value="<?php echo $row['emailaddress']; ?>"><br><br>

        <label for="role">Role:</label>
        <select name="role">
            <option value="Nurse" <?php if ($row['role'] == 'Nurse') echo ' selected'; ?>>Nurse</option>
            <option value="Cashier" <?php if ($row['role'] == 'Cashier') echo ' selected'; ?>>Cashier</option>
            <option value="Pharmacist" <?php if ($row['role'] == 'Pharmacist') echo ' selected'; ?>>Pharmacist</option>
            <option value="Receptionist" <?php if ($row['role'] == 'Receptionist') echo ' selected'; ?>>Receptionist</option>
            <option value="Administrative Personnel" <?php if ($row['role'] == 'Administrative Personnel') echo ' selected'; ?>>Administrative Personnel</option>
            <option value="Security Personnel" <?php if ($row['role'] == 'Security Personnel') echo ' selected'; ?>>Security Personnel</option>
            <option value="Regular Employee" <?php if ($row['role'] == 'Regular Employee') echo ' selected'; ?>>Regular Employee</option>
        </select><br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $row['address']; ?>"><br><br>

        <label for="postal">Postal Code:</label>
        <input type="text" name="postal" value="<?php echo $row['postalcode']; ?>"><br><br>

        <label for="province">Province:</label>
        <input type="text" name="province" value="<?php echo $rowaddress['province']; ?>"><br><br>

        <label for="city">City:</label>
        <input type="text" name="city" value="<?php echo $rowaddress['city']; ?>"><br><br>

        <button class="btn btn-outline-success" type="submit" name="submit" value="Submit">Submit</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {

        $medicarenum = $_POST["medicarenum"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $dateofbirth = $_POST["dateofbirth"];
        $telephonenum = $_POST["telephonenum"];
        $citizenship = $_POST["citizenship"];
        $emailaddress = $_POST["emailaddress"];
        $role = $_POST["role"];
        $address = $_POST["address"];
        $postal = $_POST["postal"];
        $province = $_POST["province"];
        $city = $_POST["city"];
        $oldpostal = $_POST['oldpostal'];

        // Prepare update statement

        $sql4 = "DELETE FROM EmployeeAddress WHERE postalcode = '$oldpostal'";

        $sql3 = "UPDATE Employees SET firstname ='$firstname', lastname ='$lastname', 
        dateofbirth ='$dateofbirth', telephonenum ='$telephonenum', 
        citizenship='$citizenship', emailaddress ='$emailaddress', role ='$role', address= '$address', postalcode = '$postal' WHERE medicarenum ='$medicarenum'";

        $sql5 = "INSERT INTO EmployeeAddress (postalcode, province, city) VALUES ('$postal', '$province', '$city')";



        if ($conn->query($sql4) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql5) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    ?>
    </form>

    <button onclick="window.location.href = 'Employees.php';" class="btn btn-outline-danger" value="Back">Back</button>



</body>

</html>