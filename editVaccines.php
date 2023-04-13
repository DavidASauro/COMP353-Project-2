<?php


// Check if facilityID is set
if (!isset($_GET['medicarenum'])) {
    echo "Error: medicarenum is not set.";
    exit();
}
if (!isset($_GET['type'])) {
    echo "Error: Type is not set.";
    exit();
}

// Connect to the database
include "Connect.php";



$medicarenum = $_GET['medicarenum'];
$type = $_GET['type'];
$sql = "SELECT * FROM Vaccines WHERE medicarenum = '$medicarenum' AND type = '$type'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) == 0) {
    echo "Error: Vaccine not found.";
    exit();
}


$row = mysqli_fetch_assoc($result);



?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vaccine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h1>Edit Vaccine</h1><br>
    <form method="POST">
    <input type="hidden" name="medicarenum" value="<?php echo $row['medicarenum']; ?>">
    <input type="hidden" name="type" value="<?php echo $row['type']; ?>">

    <label for="dosenum">Dose Number:</label>
    <input type="number" name="dosenum" value="<?php echo $row['dosenum']; ?>"><br><br>

    <label for="date">Date of Vaccine:</label>
    <input type="date" name="date" value="<?php echo $row['date']; ?>"><br><br>
    
    <label for="fID">Facility ID:</label>
    <input type="number" name="fID" value="<?php echo $row['facilityID']; ?>"><br><br>

    <button class = "btn btn-outline-success" type="submit" name="submit" value="Submit">Submit</button>
    </form>

    <?php
    if(isset($_POST['submit'])) {

        $medicarenum = $_POST["medicarenum"];
        $type = $_POST["type"];

        $dosenum = $_POST["dosenum"];
        $date = $_POST["date"];
        $fID = $_POST["fID"];
    
        
        $sql = "UPDATE Vaccines SET dosenum ='$dosenum', date ='$date', 
        facilityID ='$fID' WHERE medicarenum ='$medicarenum' AND type = '$type'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $conn->error;
          }
    }
    ?>
</form>

<button onclick= "window.location.href = 'Vaccines.php';"  class="btn btn-outline-danger" value="Back">Back</button>



</body>
</html>
