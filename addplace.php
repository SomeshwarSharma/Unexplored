<?php 
session_start();
include "includes/dbhandler.php";

$City_id=$_SESSION['cid'];
$loggedIn = false;

if (isset($_SESSION['loggedIn']) && isset($_SESSION['name'])) {
    $loggedIn = true;
}
if(!$loggedIn){
  
  ?>
  <script type="text/javascript"> alert("LOGIN TO ADD PLACE OR EATRIES");
window.location.href = "main_homepage.php";
</script>";
<?php
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <link
      href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900"
      rel="stylesheet"/>

    <title>The unexplored</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css" />
    <link rel="stylesheet" href="assets/css/templatemo-style.css" />
    <link rel="stylesheet" href="assets/css/owl.css" />
    <link rel="stylesheet" href="assets/css/lightbox.css" />
    <link href="assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- assets/Vendor CSS-->
    <link href="assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="assets/css/main.css" rel="stylesheet" media="all">
	
  </head>

  <body>
    <div id="page-wraper">
      <!-- Sidebar Menu -->
      <div class="responsive-nav">
        <i class="fa fa-bars" id="menu-toggle"></i>
        <div id="menu" class="menu">
          <i class="fa fa-times" id="menu-close"></i>
          <div class="container">
            <div class="image">
              <img src="assets/images/logo2.png" alt="" />
            </div>
            <div class="author-content">
              <h4>Explore the unexplored</h4>
            </div>
            <nav class="main-nav" role="navigation">
              <ul class="main-menu">
              <li><a href="main_homepage.php">HOME</a></li>
                <li><a href="addplace.php">Add Place</a></li>
                <li><a href="addeatries.php">Add Eatries</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

      <section class="section about-me" data-section="section1">
      <div class="row">
        <div class="col-md-12" align="right">
            <br><br><br>
            <?php
            if (!$loggedIn)
                echo '
                        <button class="btn btn-submit" data-toggle="modal" data-target="signup.php"><a href= "signup.php">Register</a></button>
                        <button class="btn btn-submit" data-toggle="modal" data-target="login.php"><a href= "login.php">Log In</a></button>
                ';
            else
                echo '
                    <a href="logout.php" class="btn btn-warning">Log Out</a>
                ';
            ?>
        </div>
    </div>
      <div class="section-heading">
            <h2>A D D  ~  P L A C E</h2>
            <div class="line-dec"></div>
          </div>
      <div class="container">
      <form method='post' enctype="multipart/form-data" >
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading">

                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="input-group">
                            <input type="text" placeholder="Place Name" name='name'>
                        </div>
                        <div class="input-group">
                            <textarea placeholder="About PLace" name='about' cols="70" rows="2"></textarea>
                        </div>
                        <div class="row row-space">
                            <div class="col-4" >
                                <label class="input--style-2" >Opening Hours</label>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                <input class="input--style-2" type="time" placeholder="Opening Hours" name='openhour'>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">

                        <div class="col-4">
                                <label class="input--style-2" >Closing Hour</label>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                <input class="input--style-2" type="time" placeholder="Closing Hour" name='closehour'>
                                </div>
                            </div>
                            </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                    <select name='type'class="input--style-2">
                                    <option disabled="" selected="selected">Type</option>
                                    <option value="explace">Well Known place</option>
                                    <option value="ueplace">Undetected Place</option>
                                
                            </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <br>
                            <div class="input-group">
                            <input type="text" placeholder="Google Location" name='gmap'>
                            </div>
                            <br>
                            <div class="input-group">
                            <textarea placeholder="History" name='para1' cols="70" rows="2"></textarea>
                            </div>
                            <div class="input-group">
                            <textarea placeholder="More Information" name='para2' cols="70" rows="2"></textarea>
                            </div>
                        
                            <div class="row row-space">
                            <div class="col-5" >
                                <label class="input--style-2" >Upload pic 1</label>
                            </div>
                            <div class="col-5">
                                <div >
                                <input type="file" name="uploaded_file1" class="input--style-2"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-5" >
                                <label class="input--style-2" >Upload pic 2</label>
                            </div>
                            <div class="col-5">
                                <div >
                                <input type="file" name="uploaded_file2" class="input--style-2"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-5" >
                                <label class="input--style-2" >Upload pic 3</label>
                            </div>
                            <div class="col-5">
                                <div >
                                <input type="file" name="uploaded_file3" class="input--style-2"></input>
                                </div>
                            </div>
                        </div>
                            <div class="p-t-30">
                                <button class="btn btn--radius btn--green" type="submit" name ='submit' value="submit">A D D</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    
</form>
</div>

      </section>


    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
 
     
    </script>
    <style>
    .card-2 .card-heading {
  background: url("assets/img/bg-heading-01.png") top left/cover no-repeat;
  width: 29.1%;
  display: table-cell;
}

textarea {
    width:100%;
    display:block;
    max-width:100%;
    line-height:1.5;
    padding:15px 15px 30px;
    border-radius:3px;
    border:1px solid #F7E98D;
    font:13px Tahoma, cursive;
    transition:box-shadow 0.5s ease;
    box-shadow:0 4px 6px rgba(0,0,0,0.1);
   
    
}

    </style>
	
  </body>
  <?php
if(isset($_POST['submit']))
{
echo"<br>";

$name=$_POST['name'];
$about=$_POST['about'];
$openhour=$_POST['openhour'];
$closehour=$_POST['closehour'];
$type=$_POST['type'];
$gmap=$_POST['gmap'];
$para1=$_POST['para1'];
$para2=$_POST['para2'];

    //image 3

    $path4 = "assets/images/";
    $fileTmpPath4 = $_FILES['uploaded_file3']['tmp_name'];
    $fname3=$_FILES['uploaded_file3']['name'];
    $path4 = $path4 . basename( $_FILES['uploaded_file3']['name']);

    if(move_uploaded_file($_FILES['uploaded_file3']['tmp_name'], $path4)){
     
  }



    //end image 3

    $sql = mysqli_query($conn, "INSERT INTO `post`(`P_id`, `P_head`, `C_id`, `P_type`,  `P_pic`, `P_gmap`, `about`, `para1`, `para2`, `open_hr`,`P_show`) VALUES ('','$name','$City_id','$type','$path4','$gmap','$about','$para1','$para2','$openhour to $closehour','no')");

    //image 1  
    $sql9 = "SELECT P_id FROM `post` where P_head = '$name' ";
                $result9 = $conn->query($sql9);
                
                $data9 = $result9->fetch_assoc();
                $data99 = $data9['P_id'];
      
    $path = "assets/images/";
    $fileTmpPath = $_FILES['uploaded_file1']['tmp_name'];
    $fname=$_FILES['uploaded_file1']['name'];
    $path = $path . basename( $_FILES['uploaded_file1']['name']);

    if(move_uploaded_file($_FILES['uploaded_file1']['tmp_name'], $path)) {
     // echo "The file ".  basename($fname). " has been uploaded";
     
      $sql2="INSERT into picture (`Pic_id`,`Pic_url`,`P_id`,`Pic_desc`,`Pic_type`) values ('','$path','$data99','top','1')";
      if (mysqli_query($conn, $sql2)) 
	 {
		//echo "New record created successfully !";
	 }
	 else
	 {
		echo "Error: " . $sql2 . " " . mysqli_error($conn);
	 }
  }

  //image 2

  $path2 = "assets/images/";
    $fileTmpPath2 = $_FILES['uploaded_file2']['tmp_name'];
    $fname2=$_FILES['uploaded_file2']['name'];
    $path2 = $path2 . basename( $_FILES['uploaded_file2']['name']);

    if(move_uploaded_file($_FILES['uploaded_file2']['tmp_name'], $path2)) {
     // echo "The file ".  basename($fname). " has been uploaded";
      $sql3="INSERT into picture (`Pic_id`,`Pic_url`,`P_id`,`Pic_desc`,`Pic_type`) values ('','$path2','$data99','mid','2')";
      if (mysqli_query($conn, $sql3)) 
	 {
		//echo "New record created successfully !";
	 }
	 else
	 {
		echo "Error: " . $sql3 . " " . mysqli_error($conn);
	 }
  }


}

mysqli_close($conn);
    

?>
</html>