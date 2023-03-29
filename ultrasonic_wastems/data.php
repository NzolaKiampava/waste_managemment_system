<?php

$con = mysqli_connect('localhost','root','','waste_db');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
$cm =$_GET['cm'];

if($cm >= 0 && $cm <= 5)
{
  $status = "full";
}elseif($cm >= 6 && $cm <= 12){
  $status = "middle";
}else{
  $status = "empty";
}

$sql = "UPDATE trash_buckets SET cm='$cm', status='$status' WHERE id=1";

if (mysqli_query($con, $sql)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}


mysqli_close($con);
?>