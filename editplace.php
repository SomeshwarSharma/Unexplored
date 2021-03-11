<?php
 include 'includes/dbhandler.php';
  $P_id = $_GET['id'];
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
                <li><a href="adminhome.php">Home</a></li>
                <li><a href="review_places.php">Review Place</a></li>
                <li><a href="review_eatries.php">Review Eatries</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

      <section class="section about-me" data-section="section1">
        <div class="container">
          <div class="section-heading">
            <h2>Edit Place</h2>
            <div class="line-dec"></div>
          </div>
    
    <form method="post">
    
    <br><br>
      <?php  
                $sql = "SELECT * FROM `post` where P_id = $P_id";
                $result = $conn->query($sql);
                if($result->num_rows != 1){
                    // redirect to show page
                    die('id is not in db');
                }
                $data = $result->fetch_assoc(); ?>
            <div class="card-header bg-darkgrey">
            <b><label  > Place ID: </label>
            <td><input class="form-control" type="text" placeholder=" <?php echo $P_id;?>" disabled="" ></td>
            <br>
            <label> Place name: </label>
            <input type="text" name="pname" class="form-control" value="<?php echo $data['P_head']?>"/> <br>

            <label> Discription </label><br>
            <textarea name='about' cols="120" rows="3" > <?php echo $data['about']?></textarea>

            <br>
            <label> City ID </label><br>
            <td><input class="form-control" type="text" value="<?php echo $data['C_id']?>" name="cityid"></td>
                           
            <label> Place Type </label><br>
            <select name='type' class="form-control" required="">
                                <option disabled="" selected="selected">Type</option>
                                <option value="exeatries">Trendy eatries</option>
                                <option value="ueeatries">Undetected eatries</option>
                                <option value="explace">Well Known place</option>
                                <option value="ueplace">Undetected Place</option>
                        </select>
                        <br>
            <label> Google Map </label><br>
            <td><input class="form-control" type="text" value="<?php echo $data['P_gmap']?>" name="gmap"></td>
            <br>
            <label> History </label><br>
            <textarea name="para1" cols="120" rows="3" > <?php echo $data['para1']?></textarea>
            <br>
            <label> More Information </label><br>
            <textarea name="para2" cols="120" rows="3" > <?php echo $data['para2']?></textarea>
            <br>
            <label> Timmings </label><br>
            <td><input class="form-control" type="text" value="<?php echo $data['open_hr']?>" name="openhr"></td>
            <br>
            <label> Visiblity </label><br>
            <td><input class="form-control" type="text" value="<?php echo $data['P_show']?>" name="pshow"></td>
            <br>
            <button class="btn btn-success" type="submit" name="edit"> Update </button>


            
    </form>
<?php
if(isset($_POST['edit']))
{
echo"<br>";

$name=$_POST['pname'];
$about=$_POST['about'];
$cityid=$_POST['cityid'];
$type=$_POST['type'];
$gmap=$_POST['gmap'];
$para1=$_POST['para1'];
$para2=$_POST['para2'];
$openhr=$_POST['openhr'];
$pshow=$_POST['pshow'];



$sql2 = " UPDATE post set P_head='$name', about='$about', C_id='$cityid', P_type='$type', P_gmap = '$gmap' , para1 = '$para1' , para2 = '$para2', open_hr = '$openhr' , P_show= '$pshow' where P_id= '$P_id'";
$query = mysqli_query($conn,$sql2);
 
mysqli_close($conn);

}
?>




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
      //according to loftblog tut
      $(".main-menu li:first").addClass("active");

      var showSection = function showSection(section, isAnimate) {
        var direction = section.replace(/#/, ""),
          reqSection = $(".section").filter(
            '[data-section="' + direction + '"]'
          ),
          reqSectionPos = reqSection.offset().top - 0;

        if (isAnimate) {
          $("body, html").animate(
            {
              scrollTop: reqSectionPos
            },
            800
          );
        } else {
          $("body, html").scrollTop(reqSectionPos);
        }
      };

      var checkSection = function checkSection() {
        $(".section").each(function() {
          var $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
          if (topEdge < wScroll && bottomEdge > wScroll) {
            var currentId = $this.data("section"),
              reqLink = $("a").filter("[href*=\\#" + currentId + "]");
            reqLink
              .closest("li")
              .addClass("active")
              .siblings()
              .removeClass("active");
          }
        });
      };

      

      $(window).scroll(function() {
        checkSection();
      });
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
    border:2px solid #F7E98D;
    font:13px Tahoma, cursive;
    transition:box-shadow 2.0s ease;
    box-shadow:2 4px 10px rgba(0,0,0,0.1);
   
    
}

input{
  
    width:100%;
    display:block;
    max-width:100%;
    line-height:1.5;
    padding:15px 15px 30px;
    border-radius:3px;
    border:2px solid #F7E98D;
    font:13px Tahoma, cursive;
    transition:box-shadow 2.0s ease;
    box-shadow:2 4px 10px rgba(0,0,0,0.1);

}

    </style>
  </body>
</html>