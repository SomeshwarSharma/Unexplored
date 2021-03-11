<?php
session_start();
include_once 'includes/dbhandler.php';
$loggedIn = false;

if (isset($_SESSION['loggedIn']) && isset($_SESSION['name'])) {
    $loggedIn = true;
}
$C_id = $_GET['id'];
$_SESSION['cid']= $C_id;
$sql1 = "select * from city where C_id=$C_id";
$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) 
	{
		while($row = $result1->fetch_assoc())
		{
			$para1 = $row['para1'];
			$para2 = $row['para2'];
			$para3 = $row['para3'];
			$name= $row['C_name'];
		}
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
<style>
	h5 {
  color: #800000;
  background-color:white;
}
	</style>
	
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
              <h4>Explore the unexplored</h4><br>
			  <h5>
			  
			  </h5>
            </div>
            <nav class="main-nav" role="navigation">
              <ul class="main-menu">
                <li><a href="main_homepage.php">Home</a></li>
                <li><a href="#section2">Places to eat</a></li>
                <li><a href="#section3">Places to visit</a></li>
                <li><a href="#section4">Help us grow !</a></li>
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
                        <button class="btn btn-submit" data-toggle="modal" data-target="signup.php"><a href= "signin.php">Register</a></button>
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
            <h2>About</h2>
            <div class="line-dec"></div>
          </div>
            <div class="row">
              </div>
                  <h4>Description</h4>
				  <h3>
                  <p>
                    <?php echo $para1 ?>
                  </p>
				  <p>
					<?php echo $para2 ?>
				  </p>
				  <p>
					<?php echo $para3 ?>
				  </p>
            </div>
      </section>

      <section class="section my-services" data-section="section2">
        <div class="container">
          <div class="section-heading">
            <h2>PLACE TO EAT</h2>
            <div class="line-dec"></div>
          </div>
          <div class="section-heading">
            <h3>U N E X P L O R E D</h3>
            <div class="line-dec"></div>
          </div>
          <div class="row">
            <div class="isotope-wrapper">
			<div class="isotope-box">
				<?php
				$image_query = mysqli_query($conn,"select * from post where (C_id = $C_id and P_type='ueeatries' ) AND P_show ='yes' ");
					while($rows = mysqli_fetch_array($image_query))
					{
						$img_src = $rows['P_pic'];
						$img_desc= $rows['P_head'];
						$p_id= $rows['P_id'];
					?>
				<div class="isotope-item" data-type="nature">
                  <figure class="snip1321">
                    <img
                      src="<?php echo $img_src;?>"
                      alt="Food image!!"
                    />
                    <figcaption>
                      <div class="white-button">
                    <a href="cafe.php?pid=<?php echo $p_id;?>">View</a>
                  </div>
					  </figcaption>
					  </figure>
					  <h4><?php echo $img_desc;?></h4>
                </div>
				<?php } ?>
              </div>
            </div>
            </div>
            <div class="section-heading">
            <h3>E X P L O R E D</h3>
            <div class="line-dec"></div>
          </div>
          <div class="row">
            <div class="isotope-wrapper">
			<div class="isotope-box">
				<?php
				$image_query = mysqli_query($conn,"select * from post where (C_id = $C_id and P_type='exeatries' ) AND P_show ='yes' ");
					while($rows = mysqli_fetch_array($image_query))
					{
						$img_src = $rows['P_pic'];
						$img_desc= $rows['P_head'];
						$p_id= $rows['P_id'];
					?>
				<div class="isotope-item" data-type="nature">
                  <figure class="snip1321">
                    <img
                      src="<?php echo $img_src;?>"
                      alt="Food image!!"
                    />
                    <figcaption>
                      <div class="white-button">
                    <a href="cafe.php?pid=<?php echo $p_id;?>">View</a>
                  </div>
					  </figcaption>
					  </figure>
					  <h4><?php echo $img_desc;?></h4>
                </div>
				<?php } ?>
              </div>
            </div>
            </div>

			<div class="section-heading">
          </div>
            
          </div>
        
      </section>

      <section class="section about-services" data-section="section3">
        <div class="container">
          <div class="section-heading">
            <h2>Places to visit</h2>
            <div class="line-dec"></div>
          </div>
          <div class="section-heading">
            <h2>U N E X P L O R E D</h2>
            <div class="line-dec"></div>
          </div>
          <div class="row">
            <div class="isotope-wrapper">
			<div class="isotope-box">
				<?php
				$image_query = mysqli_query($conn,"select * from post where (C_id = $C_id and P_type='ueplace') AND P_show='yes'");
					while($rows = mysqli_fetch_array($image_query))
					{
						$img_src = $rows['P_pic'];
						$img_desc= $rows['P_head'];
						$p_id= $rows['P_id'];
					?>
				<div class="isotope-item" data-type="nature">
                  <figure class="snip1321">
                    <img
                      src="<?php echo $img_src;?>"
                      alt="PLACE IMAGE"
                    />
                    <figcaption>
                      <div class="white-button">
                    <a href="place.php?pid=<?php echo $p_id;?>">View</a>
                    
                  </div>
					  </figcaption>
					  </figure>
					  <h4><?php echo $img_desc;?></h4>
                </div>
				<?php } ?>
              </div>
            </div>
            </div>
            <!-- start-->
            <div class="section-heading">
            <h2>E X P L O R E D</h2>
            <div class="line-dec"></div>
             </div>
            <div class="row">
            <div class="isotope-wrapper">
			<div class="isotope-box">
				<?php
				$image_query = mysqli_query($conn,"select * from post where (C_id = $C_id and P_type='explace') AND P_show='yes'");
					while($rows = mysqli_fetch_array($image_query))
					{
						$img_src = $rows['P_pic'];
						$img_desc= $rows['P_head'];
						$p_id= $rows['P_id'];
					?>
				<div class="isotope-item" data-type="nature">
                  <figure class="snip1321">
                    <img
                      src="<?php echo $img_src;?>"
                      alt="PLACE IMAGE"
                    />
                    <figcaption>
                      <div class="white-button">
                    <a href="place.php?pid=<?php echo $p_id;?>">View</a>
                    
                  </div>
					  </figcaption>
					  </figure>
					  <h4><?php echo $img_desc;?></h4>
                </div>
				<?php } ?>
              </div>
            </div>
            </div>




			<div class="section-heading">
          </div>
            
          </div>
      </section>

      <section class="section contact-me" data-section="section4">
        <div class="container">
          <div class="section-heading">
            <h2>Contribute to the society</h2>
            <div class="line-dec"></div>
            <span>
				Is there a place or an eatery you couldn't find in the list ? Worry no more, we are here ! Tell us about your favourite places in <?php echo $name;?>, and we will hear all about it.
			</span>
          </div>
				<div class="row">
               <div class="first-service-icon service-icon"></div>
                <h4>What do you need ?</h4>
                <p>
					You can add information of any place that you like in <?php echo $name;?> and in just a few easy steps,the information about your favourite place will reach to us..
                </p>
				<p>
					For that you will need to:
				</p>
                <p>
                   <ol>
						<li>Click the link given below</li>
						<li>Submit some amazing photos of that place,that you yourself clicked</li>
						<li>A detailed explanation of why the place is so awesome</li>
						<li>In case of an eatery,submit the menu</li>
						<li>The location of the place through Google Map</li>
						<li>Submit the information</li>
				   </ol>
                </p>
				
				<p>
					Our editors will review the information and will add it to the website as soon as the details are verified !.
				</p>
            </div>
			<div class="section-heading">
            <h2><div class="white-button">
                    <a href="addplace.php?id=<?php echo $C_id?>">Click Here</a>
                  </div></h2>
          </div>
            
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