<?php
//set session
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM place";
$result = $conn->query($sql);
echo "<table>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	
  echo "<tr>";
  echo "<td>".$row['id']."</td>";
  echo "<td>".$row['name']."</td>";
  echo "<td>".$row['address']."</td>";
  echo "<td>".$row['latitude']."</td>";
  echo "<td>".$row['longitude']."</td>";
  echo "</tr>";

    }
} 
else {
    echo "0 results";
}
echo "</table>";





$conn->close();


?>