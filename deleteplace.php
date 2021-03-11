<?php

include 'includes/dbhandler.php';

$P_id = $_GET['id'];
echo "hello".$P_id;
$sql = " DELETE FROM picture WHERE P_id = $P_id ";
if (mysqli_query($conn, $sql)) {
  echo "Record deleted successfully1";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

$sql2 = " DELETE FROM post WHERE P_id = $P_id ";

if (mysqli_query($conn, $sql2)) {
  echo "Record deleted successfully2";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}


mysqli_close($conn);

header('location:review_places.php');
?>