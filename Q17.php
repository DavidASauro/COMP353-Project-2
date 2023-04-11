<?php
include 'Connect.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="LandingPage.html">Home</a>
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
    <h1>Doctors and Nurses Covid and Working</h1>

    <?php



    $query = "SELECT e.firstname, e.lastname, s.scheduledate, e.role, e.dateofbirth, e.emailaddress, SUM(TIMESTAMPDIFF(HOUR, s.starttime, s.endtime)) as total_hours_worked
    FROM Employees e
    JOIN Infections i ON e.medicarenum = i.medicarenum
    JOIN Schedule s ON e.medicarenum = s.medicarenum
    WHERE e.role IN ('Nurse', 'Doctor') AND i.medicarenum IS NULL
    GROUP BY e.medicarenum, e.firstname, e.lastname, s.scheduledate, e.role, e.dateofbirth, e.emailaddress
    ORDER BY e.role ASC, e.firstname ASC, e.lastname ASC;";


    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if query was successful
    if ($result) {
        //   echo "<pre>";
        //   print_r(mysqli_fetch_assoc($result));
        //   echo "</pre>";
        echo "<table class =\"table\">";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Schedule Date</th><th>Role</th><th>Date Of Birth</th><th>Email Address</th><th>Total Hours Worked</th><th>Number Of Infections</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['scheduledate'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<td>" . $row['dateofbirth'] . "</td>";
            echo "<td>" . $row['emailaddress'] . "</td>";
            echo "<td>" . $row['total_hours_worked'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    ?>
</body>

</html>