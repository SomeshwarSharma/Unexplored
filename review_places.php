<?php
session_start();
include_once 'includes/dbhandler.php';
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
                <li><a href="admin_home.php">HOME</a></li>
                <li><a href="#section1">REVIEW PLACES</a></li>
                <li><a href="review_eatries.php">REVIEW EATERIES</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

      <section class="section about-me" data-section="section2">
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
      <div class="section-heading">
            <h2>Unreviewed places</h2>
            <div class="line-dec"></div>
          </div>
        <div class="container">
          <br><br>
        <table class ="table table-striped table-hover table-bordered" >
            <tr>
                <th>Place ID</th>
                <th>Place Name</th>
                <th>Discription</th>
                <th>Type</th>
                <th colspan ="2">Action</th>
            </tr>
            <?php
                $select = "select *  from post where ( P_type = 'ueplace' OR  P_type = 'explace') AND P_show = 'no' ORDER BY P_id DESC";
                $result = mysqli_query($conn, $select);
                 while($row = mysqli_fetch_array($result)) 
                 { ?>
                    <tr>
                        <td><?php echo $row['P_id']?></td>
                        <td><?php echo $row['P_head']?></td>
                        <td><?php echo $row['about']?></td>
                        <td><?php echo $row['P_type']?></td>
                        <td> <button class="btn"> <a href="editplace.php?id=<?php echo $row['P_id']; ?>" class="text-white"> REVIEW </a> </button> </td>
                        <td> <button class="btn"> <a href="deleteplace.php?id=<?php echo $row['P_id']; ?>" class="text-white"> Delete </a>  </button> </td>

                    </tr>
                    <?php    }      ?>
        </table>


        </div>

        <div class="section-heading">
            <h2>reviewed places</h2>
            <div class="line-dec"></div>
          </div>

          <div class="container">
          <br><br>
        <table class ="table table-striped table-hover table-bordered" >
            <tr>
                <th>Place ID</th>
                <th>Place Name</th>
                <th>Discription</th>
                <th>Type</th>
                <th colspan ="2">Action</th>
            </tr>
            <?php
                $select = "select *  from post where (  P_type = 'explace' or P_type = 'ueplace' )AND P_show = 'yes' ORDER BY P_id DESC";
                $result = mysqli_query($conn, $select);
                 while($row = mysqli_fetch_array($result)) 
                 { ?>
                    <tr>
                        <td><?php echo $row['P_id']?></td>
                        <td><?php echo $row['P_head']?></td>
                        <td><?php echo $row['about']?></td>
                        <td><?php echo $row['P_type']?></td>
                        <td> <button class="btn"> <a href="editplace.php?id=<?php echo $row['P_id']; ?>" class="text-white"> REVIEW </a> </button> </td>
                        <td> <button class="btn"> <a href="deleteplace.php?id=<?php echo $row['P_id']; ?>" class="text-white"> Delete </a>  </button> </td>

                    </tr>
                    <?php    }      ?>
        </table>


        </div>
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
	
  </body>
</html>