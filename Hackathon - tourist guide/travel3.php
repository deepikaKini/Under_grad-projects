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


if( $_SESSION['ty']==1)
{
$sql = "SELECT * FROM coord ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "Latitude: " . $row["latitude"]. " - Longitude: " . $row["longitude"]."<br>";
    $lat=$row["latitude"];
    $lon=$row["longitude"];
    }
} else {
    echo "0 results";

 
}

/*echo "The latitude  ".$lat."<br>";
echo "The longitude".$lon;*/

$sql2="SELECT * FROM fun ";
$result = $conn->query($sql2);
 
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	$lat1=$row["lat"];
    $lon1=$row["lng"];
     
    $xs=pow($lat-$lat1,2);
   // echo "<br>xs=".$xs;

    $ys=pow($lon-$lon1,2);
    // echo "<br>ys=".$ys;
     $s=$xs+$ys;
     $sq=sqrt($s);
    // echo "sub=".$s;
   // echo "<br>square is".$sq;
  
    if($sq<=0.286)
    {
    	
    	 echo "<style>body{background-color:#DEE9FC;font-size:20px;}
    	 span{color:#1258DC;}
    	 span a {text-decoration:none;};
    	 </style><span class='place'><br>A Place near to you is: </span>";
    	echo  $row["name"]."<br>";
    	if($row['id']==1)
    	{
    	echo "<a href='pvr.html'><span>Get more information on <strong>PVR cinemas</strong></span></a>";
        }
        if($row['id']==2)
        {
        	echo "<a href='kstar.html'><span>Get more information on<strong> Kstar mall</strong></span></a>";
        }
       	 if($row['id']==3)
        {
        	echo "<a href='ster.html'><span>Get more information on <strong>Sterling cinemas</strong></span></a>";
        }

         

    	
    	/*echo '<!doctype html><html>
    	<head><style>.mapouter{overflow:hidden;height:500px;width:600px;}.gmap_canvas {background:none!important;height:500px;width:600px;}</style></head>
    	<body>
   
    	
    	<div class="mapouter">
    	<div class="gmap_canvas">
    	<iframe width="600" height="500" id="gmap_canvas" 
    	src="https://maps.google.com/maps?q=gateway of india&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
    	</iframe>
    	</div>
    	<a href="https://www.webdesign-muenchen-pb.de">webdesign-muenchen-pb.de</a></div></body></html>';*/
    }

   
}
}

else {
    echo "0 results";

 
}

}


if( $_SESSION['ty']==2)
{
$sql = "SELECT * FROM coord ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "Latitude: " . $row["latitude"]. " - Longitude: " . $row["longitude"]."<br>";
    $lat=$row["latitude"];
    $lon=$row["longitude"];
    }
} else {
    echo "0 results";

 
}

/*echo "The latitude  ".$lat."<br>";
echo "The longitude".$lon;*/

$sql2="SELECT * FROM place ";
$result = $conn->query($sql2);
 
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	$lat1=$row["latitude"];
    $lon1=$row["longitude"];
     
    $xs=pow($lat-$lat1,2);
   // echo "<br>xs=".$xs;

    $ys=pow($lon-$lon1,2);
   ///  echo "<br>ys=".$ys;
     $s=$xs+$ys;
     $sq=sqrt($s);
    // echo "sub=".$s;
   // echo "<br>square is".$sq;
  
    if($sq<=0.286)
    {
    	
    	 echo "<style>body{background-color:#DEE9FC;font-size:20px;}
    	 span{color:#1258DC;}
    	 span a {text-decoration:none;};
    	 </style><span class='place'><br>A Place near to you is: </span>";
    	echo  $row["name"]."<br>";
    	if($row['id']==3)
    	{
    	echo "<a href='gate.html'><span>Get more information on <strong>Gateway of India</strong></span></a>";
        }
        if($row['id']==4)
        {
        	echo "<a href='caves.html'><span>Get more information on<strong> Elephanta Caves</strong></span></a>";
        }
       	 if($row['id']==9)
        {
        	echo "<a href='siddhi.html'><span>Get more information on <strong>SiddhiVinayak Temple</strong></span></a>";
        }
         if($row['id']==8)
        {
        	echo "<a href='haji.html'><span>Get more information on<strong> Haji Ali</strong></span></a>";
        }

    	
    	/*echo '<!doctype html><html>
    	<head><style>.mapouter{overflow:hidden;height:500px;width:600px;}.gmap_canvas {background:none!important;height:500px;width:600px;}</style></head>
    	<body>
   
    	
    	<div class="mapouter">
    	<div class="gmap_canvas">
    	<iframe width="600" height="500" id="gmap_canvas" 
    	src="https://maps.google.com/maps?q=gateway of india&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
    	</iframe>
    	</div>
    	<a href="https://www.webdesign-muenchen-pb.de">webdesign-muenchen-pb.de</a></div></body></html>';*/
    }

   
}
}

else {
    echo "0 results";

 
}


}




if( $_SESSION['ty']==3)
{
$sql = "SELECT * FROM coord ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "Latitude: " . $row["latitude"]. " - Longitude: " . $row["longitude"]."<br>";
    $lat=$row["latitude"];
    $lon=$row["longitude"];
    }
} else {
    echo "0 results";

 
}

/*echo "The latitude  ".$lat."<br>";
echo "The longitude".$lon;*/

$sql2="SELECT * FROM eat ";
$result = $conn->query($sql2);
 
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	$lat1=$row["lat"];
    $lon1=$row["lng"];
     
    $xs=pow($lat-$lat1,2);
   // echo "<br>xs=".$xs;

    $ys=pow($lon-$lon1,2);
   //  echo "<br>ys=".$ys;
     $s=$xs+$ys;
     $sq=sqrt($s);
    // echo "sub=".$s;
   // echo "<br>square is".$sq;
  
    if($sq<=0.25)
    {
    	
    	 echo "<style>body{background-color:#DEE9FC;font-size:20px;}
    	 span{color:#1258DC;}
    	 span a {text-decoration:none;};
    	 </style><span class='place'><br>A Place near to you is: </span>";
    	echo  $row["name"]."<br>";
    	if($row['id']==1)
    	{
    	echo "<a href='monza.html'><span>Get more information on <strong>Cafe Monza</strong></span></a>";
        }
        if($row['id']==2)
        {
        	echo "<a href='chinabis.html'><span>Get more information on<strong> China Bistro</strong></span></a>";
        }
       	
         

    	
    	/*echo '<!doctype html><html>
    	<head><style>.mapouter{overflow:hidden;height:500px;width:600px
    	
    	<div class="mapouter">
    	<div class="gmap_canvas">;}.gmap_canvas {background:none!important;height:500px;width:600px;}</style></head>
    	<body>
   
    	<iframe width="600" height="500" id="gmap_canvas" 
    	src="https://maps.google.com/maps?q=gateway of india&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
    	</iframe>
    	</div>
    	<a href="https://www.webdesign-muenchen-pb.de">webdesign-muenchen-pb.de</a></div></body></html>';*/
    }

   
}
}

else {
    echo "0 results";

 
}

}


?>
