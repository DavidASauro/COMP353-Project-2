<?php
include 'Connect.php'
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Our Database [PLACEHOLDER]</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>

<h1>[PLACE HOLDER] </h1>


<?php 

$tablename = 'Employees';
$query = 'SHOW COLUMNS FROM '. $tablename; 
$column_names = mysqli_query($conn, $query);
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

	echo "<td> <button type ='submit' class= \"btn btn-outline-danger\" name ='delete' value =''> Delete </button> </td>";
    echo "</tr>";
}
echo "</table>";






?>










</table>
   
</body>
</html>