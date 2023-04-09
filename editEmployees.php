<?php


// Check if facilityID is set
if (!isset($_GET['medicarenum'])) {
    echo "Error: medicarenum is not set.";
    exit();
}

// Connect to the database
include "Connect.php";



$medicarenum = $_GET['medicarenum'];
$sql = "SELECT * FROM Employees WHERE medicarenum = '$medicarenum'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) == 0) {
    echo "Error: Employee not found.";
    exit();
}


$row = mysqli_fetch_assoc($result);



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
    <input type="text" name="role" value="<?php echo $row['role']; ?>"><br><br>

    <label for="address">Address:</label>
    <input type="text" name="address" value="<?php echo $row['address']; ?>"><br><br>

    <button class = "btn btn-outline-success" type="submit" name="submit" value="Submit">Submit</button>
    </form>

    <?php
    if(isset($_POST['submit'])) {

        $medicarenum = $_POST["medicarenum"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $dateofbirth = $_POST["dateofbirth"];
        $telephonenum = $_POST["telephonenum"];
        $citizenship = $_POST["citizenship"];
        $emailaddress = $_POST["emailaddress"];
        $role = $_POST["role"];
        $address = $_POST["address"];
    
        // Prepare update statement
        $sql = "UPDATE Employees SET firstname ='$firstname', lastname ='$lastname', 
        dateofbirth ='$dateofbirth', telephonenum ='$telephonenum', 
        citizenship='$citizenship', emailaddress ='$emailaddress', role ='$role', address= '$address' WHERE medicarenum ='$medicarenum'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $conn->error;
          }
    }
    ?>
</form>

<button onclick= "window.location.href = 'Employees.php';"  class="btn btn-outline-danger" value="Back">Back</button>



</body>
</html>
