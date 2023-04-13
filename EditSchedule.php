<?php


// Check if facilityID is set
if (!isset($_GET['medicarenum'])) {
    echo "Error: medicarenum is not set.";
    exit();
}
if (!isset($_GET['starttime'])) {
    echo "Error: Start time is not set.";
    exit();
}
if (!isset($_GET['scheduledate'])) {
    echo "Error: Schedule date is not set.";
    exit();
}

// Connect to the database
include "Connect.php";



$medicarenum = $_GET['medicarenum'];
$starttime = $_GET['starttime'];
$scheduledate = $_GET['scheduledate'];

$sql = "SELECT * FROM Schedule WHERE medicarenum = '$medicarenum' AND starttime = '$starttime' AND scheduledate = '$scheduledate'";
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
    <title>Edit Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h1>Edit Schedule</h1><br>
    <form method="POST">
    <input type="hidden" name="medicarenum" value="<?php echo $row['medicarenum']; ?>">
    <input type="hidden" name="starttime" value="<?php echo $row['starttime']; ?>">
    <input type="hidden" name="scheduledate" value="<?php echo $row['scheduledate']; ?>">

    <label for="endtime">End Time:</label>
    <input type="time" name="endtime" value="<?php echo $row['endtime']; ?>"><br><br>

    <label for="facilityID">facilityID:</label>
    <input type="number" name="facilityID" value="<?php echo $row['facilityID']; ?>"><br><br>


    <button class = "btn btn-outline-success" type="submit" name="submit" value="Submit">Submit</button>
    </form>

    <?php
    if(isset($_POST['submit'])) {

        $medicarenum = $_POST["medicarenum"];
        $starttime = $_POST["starttime"];
        $scheduledate = $_POST["scheduledate"];

        $endtime = $_POST["endtime"];
        $facilityID = $_POST["facilityID"];
        
        // Prepare update statement
        $sql = "UPDATE Schedule SET endtime = '$endtime', facilityID = '$facilityID' WHERE medicarenum = '$medicarenum' AND starttime = '$starttime' AND scheduledate = '$scheduledate'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $conn->error;
          }
    }
    ?>
</form>

<button onclick= "window.location.href = 'Schedule.php';"  class="btn btn-outline-danger" value="Back">Back</button>



</body>
</html>
