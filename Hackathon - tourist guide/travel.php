<?php 
 
$db=mysql_connect("localhost","root","") 
or die("not connected to server"); 
 
mysql_select_db("sample",$db); 
 
$run=$db->query("select * from place;") or die($db->error);
 
$num=mysqli_num_rows($run);
$row=mysqli_fetch_array($run, MYSQLI_ASSOC);


  while($row = mysqli_fetch_array($run, MYSQLI_ASSOC))
  {
  echo "<tr>";
  echo "<td>".$row['id']."</td>";
  echo "<td>".$row['name']."</td>";
  echo "<td>".$row['address']."</td>";
  echo "<td>".$row['latitude']."</td>";
  echo "<td>".$row['longitude']."</td>";
  echo "</tr>";
  echo "</table>";
}

 
?>