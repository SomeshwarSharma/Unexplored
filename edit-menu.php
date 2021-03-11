<?php
session_start();
 include 'includes/dbhandler.php';
  $m_id = $_GET['id'];

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
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link
      href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900"
      rel="stylesheet"/>

    <title>The unexplored</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<!-- Font Awesome JS -->
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css" />
    <link rel="stylesheet" href="assets/css/templatemo-style.css" />
    <link rel="stylesheet" href="assets/css/owl.css" />
    <link rel="stylesheet" href="assets/css/lightbox.css" />
	
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
                <li><a href="addmenu.php">Add Menu</a></li>
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
            <h2>About Unexplored</h2>
            <div class="line-dec"></div>
          </div>
        
          <form method="post">
        
            <br><br>
                
                
                    
                    <b><label  > Menu ID: </label>
                    <td><input class="form-control" type="text" placeholder=" <?php echo $m_id;?>" disabled="" ></td>
                    <br>
                    <label> Dish name: </label>
                    <input type="text" name="dname" class="form-control"/> <br>

                    <label> Discription </label><br>
                    <textarea name='about' cols="92" rows="2"></textarea>

                    <br>
                    <label> price </label><br>
                    <td><input class="form-control" type="text" name="price"></td>
                                
                    <label> Type </label><br>
                    <select name='type' class="form-control">
                                        <option disabled="" selected="selected">Type</option>
                                        <option value="eat">Eat</option>
                                        <option value="drink">Drink</option>
                                </select><br>
                    <button class="btn btn-success" type="submit" name="edit"> Update </button>


                    
            </form>



        
      </section>
    </div>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
     
    </script>
	
  </body>
  <style>

    
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

<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
<?php
 if(isset($_POST['edit'])){
    $m_name=$_POST['dname'];
    $m_discription=$_POST['about'];
    $m_price=$_POST['price'];
    $m_type=$_POST['type'];

$sql11="select m_id from menu where m_id='$m_id'";
$result11= mysqli_query($conn,$sql11);
if($result11==true)
{
$sql = " UPDATE menu set dish_name='$m_name', dish_desc='$m_discription', price='$m_price', type='$m_type' where m_id=$m_id";
    $query = mysqli_query($conn,$sql);

    //header('location:addmenu.php ');

    echo "<script>window.location.href='addmenu.php';</script>";
 mysqli_close($conn);
}

 }
?>
</html>