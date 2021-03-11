<?php
session_start();
include "includes/dbhandler.php";
$P_id=$_SESSION['postid'];

$loggedIn = false;

if (isset($_SESSION['loggedIn']) && isset($_SESSION['name'])) {
    $loggedIn = true;
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
        <div class="container">
          <div class="section-heading">
            <h2>A D D  ~  M E N U</h2>
            <div class="line-dec"></div>
          </div>
          
        <table class ="table table-striped table-hover table-bordered" style="background-color: grey">
            <tr>
                <th>Eatries Name</th>
                <th>Eaties Type</th>
                <th>location</th>
                <th>Timmings</th>
                <th>Action</th>
            </tr>
            <?php
                $select = "select *  from post WHERE P_type = 'ueeatries' OR P_type = 'exeatries' ORDER BY P_id DESC";
                $result = mysqli_query($conn, $select);
                 while($row = mysqli_fetch_array($result)) 
                 { ?>
                    <tr>
                        <td><?php echo $row['P_head']?></td>
                        <td><?php echo $row['P_type']?></td>
                        <td><?php echo $row['P_gmap']?></td>
                        <td><?php echo $row['open_hr']?></td>
                        <td> <button class="btn"> <a href="edit-menu.php?id=<?php echo $row['P_id']; ?>" class="text-white"> EDIT </a> </button> </td>
                    </tr>
                    <?php    }      ?>
        </table>

      </section>


    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){

                var html = '<tr><td><input class="form-control" type="text" name="dname[]" required="" ></td><td><input class="form-control" type="text" name="ddesc[]" required="" ></td><td   ><input class="form-control" type="text" name="dprice[]" required="" ></td><td><input class="form-control" type="text" name="type[]" required=""></td><td><input class="btn btn-warning"type="button" name="remove" id="remove" value="remove" ></td></tr>';

                  

                $("#add").click(function(){
                    
                    $('#table_field').append(html);
                    
                });
                
                $("#table_field").on('click','#remove',function(){
                    $(this).closest('tr').remove();

                });
            });
        </script>
    <style>
    

    </style>
	
  </body>
  
</html>