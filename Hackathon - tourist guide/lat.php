

 <?php
 session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
/*// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
*/
$lati=$_POST['lati'];
$longi=$_POST['longi'];
$_SESSION['ty']=$_POST['ty'];
$sql = "insert into coord(latitude,longitude) values('$lati','$longi')";
    mysqli_query($conn,$sql) or mysqli_error($conn);;
    echo "success";
    mysqli_close($conn);
    
?>
