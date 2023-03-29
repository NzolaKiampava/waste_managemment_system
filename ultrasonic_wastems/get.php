
<?php

$con = mysqli_connect('localhost','root','','waste_db');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM trash_buckets where id=1 ";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
  if($row['cm']<21)
  {
   echo $cm=$row['cm']*(4.8)."%";
  }
 
}




mysqli_close($con);
?>
