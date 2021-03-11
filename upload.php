<!DOCTYPE html>
<?php 
session_start();
  include_once 'includes/dbhandler.php';
//  $p_id= $_SESSION['pid'];

?>
<html>
<head>   
  <form enctype="multipart/form-data" action="upload.php" method="POST">
    
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload"></input>
  </form>



  <?PHP
  if(!empty($_FILES['uploaded_file']))
  {
    
    $path = "assets/images/";
    $fileTmpPath = $_FILES['uploaded_file']['tmp_name'];
    $fname=$_FILES['uploaded_file']['name'];
    $path = $path . basename( $_FILES['uploaded_file']['name']);

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
     // echo "The file ".  basename($fname). " has been uploaded";
      $sql="INSERT into picture (`Pic_id`,`Pic_url`,`P_id`,`Pic_desc`,`Pic_type`) values ('','$path','2','1','top')";
      if (mysqli_query($conn, $sql)) 
	 {
		//echo "New record created successfully !";
	 }
	 else
	 {
		echo "Error: " . $sql . " " . mysqli_error($conn);
	 }
	 mysqli_close($conn);
  }
}
?>
