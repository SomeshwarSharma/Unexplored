<?php
session_start();

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
                <li><a href="#section1">About Us</a></li>
                <li><a href="#section2">Pune</a></li>
                <li><a href="#section3">Rajkot</a></li>
                <li><a href="#section4">Jaipur</a></li>
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
          <div class="left-image-post">
            <div class="row">
              <div class="col-md-6">
                <div class="left-image">
                  <img src="assets/images/describe.jpg" alt="" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="right-text">
                  <h4>Description</h4>
                  <p>
                    When a new comer or a tourist visits an unknown city, the often
							feel lost. Most of the websites available on the internet show the
							main tourist spots or all the famous restaurants but there are many
							small or less known places or eateries which are equally good. The
							unexplored will have information on both : the famous places and
							the less explored ones.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="right-image-post">
            <div class="row">
              <div class="col-md-6">
                <div class="left-text">
                  <h4>Objective</h4>
                  <p>
                    The main objective of this website is to enhance the experience
						of the travellers and to make them feel more at home in a new
						city. Most of the times, new comers don’t know the near by
						places that they can visit and often seek help from the localities.
						This website will have all the necessary information about a
						place to visit or a place that serves delicious food.
                  </p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="right-image">
                  <img src="assets/images/objective1.jpg" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section my-services" data-section="section2">
        <div class="container">
          <div class="section-heading">
            <h2>Pune tithe kay une ?!</h2>
            <div class="line-dec"></div>
            <span>
			Pune, formerly known as Poona is the second largest city in the Indian State of Maharashtra, after Mumbai, and the eighth most populous city in India, with an estimated population of 7.4 million as of 2020.It has been ranked as "the most livable city in India" several times.</span>
          </div>
          <div class="row">
               <div class="first-service-icon service-icon"></div>
                <h4>History</h4>
                <p>
                   The term Pune comes from the word Punya or holy. Copper plates dating as early as 768 and 758 A.D. bear the first reference to the city that is now known as Pune. These copper plates were made by the Rashtrakuta ruler, Krishna I, and the region is referred to as ‘Punaka Vishaya‘ and ‘Puny Vishaya’ respectively. It was around this time that the famous and beautiful Pataleshwar rock-cut temple was built.
                </p>
				
                <p>
                   Called “Queen of the Deccan,” Pune is the cultural capital of the Maratha peoples. The city first gained importance as the capital of the Bhonsle Marathas in the 17th century. It was temporarily captured by the Mughals but again served as the official Maratha capital from 1714 until its fall to the British in 1817. It was the seasonal capital of the Bombay Presidency 
                </p>
				
				<p>
					Today, Pune is the second largest city in Maharashtra and a hub of education and corporate careers. Home to a fairly young population and surrounded by several beautiful hill stations, Pune has managed to preserve its historic heritage while making way for the contemporary. It isn’t only the ninth most populous city but also one of the most livable places in India today.
				</p>
            </div>
			<div class="section-heading">
            <h2><div class="white-button">
                    <a href="city_homepage.php?id=1">Explore</a>
                  </div></h2>
          </div>
            
          </div>
        
      </section>

      <section class="section about-services" data-section="section3">
        <div class="container">
          <div class="section-heading">
            <h2>Rangilu Rajkot</h2>
            <div class="line-dec"></div>
            <span>
			Rajkot is the fourth-largest city in the state of Gujarat, India, after Ahmedabad, Surat and Vadodara and is in the center of the Saurashtra region of Gujarat. Rajkot is the 35th-largest metropolitan area in India, with a population of more than 1.8 million as of 2018. Rajkot is the second-cleanest city of India, and is the 22nd-fastest-growing city in the world as of July 2019.</span>
          </div>
          <div class="row">
               <div class="first-service-icon service-icon"></div>
                <h4>History</h4>
                <p>
                   Rajkot city was founded by Thakorji Vibhaji in the year of 1610 and he ruled about 282 square miles area with 64 villages throughout. In 1720 the deputy subehdar Masum Khan belonging to Sorath regiment defeated the ruler and the name of Rajkot was changed to Masumabad. After that in the year of 1732 the son of the deafeated ruler Meramanji took the revenge of his father’s defeat by defeating Masum Khan again and kept its name Rajkot again
                </p>
				
                <p>
                   It is now an important commercial and industrial centre. The manufacture of cotton and woolen textiles is a major activity; ceramics, diesel engines, and water pump sets are also produced in the city. Rajkot is known for its traditional handicrafts (silver work, embroidery, and patola weaving). Educational institutions include Rajkumar College (1870) and several colleges affiliated with Saurashtra University.
                </p>
				
				<p>
					This city is popularly known as the “Rangiloo Rajkot”. In other words, “Colorful Rajkot”. Rajkot is considered as the city of painting. Thus, it is referred to as the “Chitranagri”.
				</p>
            </div>
			<div class="section-heading">
            <h2><div class="white-button">
                    <a href="city_homepage.php?id=3">Explore</a>
                  </div></h2>
          </div>
            
          </div>
        
      </section>

      <section class="section contact-me" data-section="section4">
        <div class="container">
          <div class="section-heading">
            <h2>Jaipur</h2>
            <div class="line-dec"></div>
            <span>
			Jaipur is the capital and the largest city of the Indian state of Rajasthan. As of 2011, the city had a population of 3.1 million, making it the tenth most populous city in the country. Jaipur is also known as the Pink City, due to the dominant color scheme of its buildings. It is located 268 km (167 miles) from the national capital New Delhi.</span>
          </div>
          <div class="row">
               <div class="first-service-icon service-icon"></div>
                <h4>History</h4>
                <p>
                   The city of Jaipur was founded by King of Amer, Maharaja Sawai Jai Singh II on November 18, 1727, who ruled from 1699 to 1743. He planned to shift his capital from Amer, 11 kilometres (7 mi) to Jaipur to accommodate the growing population and increasing scarcity of water.Jaipur was planned based on the principles of Vastu Shastra and Shilpa Shastra. The construction of the city began in 1726 and took four years to complete the major roads, offices, and palaces. The city was divided into nine blocks, two of which contained the state buildings and palaces, with the remaining seven allotted to the public. Huge ramparts were built, pierced by seven fortified gates.
                </p>
				
                <p>
                   During the rule of Sawai Ram Singh I, the city was painted pink to welcome HRH Albert Edward, Prince of Wales (who later became King Edward VII, Emperor of India), in 1876.Many of the avenues still remain painted in pink, giving Jaipur a distinctive appearance and the epithet Pink city.
                </p>
				
				<p>
					Jaipur is a major tourist destination in India forming a part of the Golden Triangle.According to TripAdvisor's 2015 Traveller's Choice Awards for Destination, Jaipur ranked 1st among the Indian destinations for the year.Jaipur Exhibition & Convention Centre (JECC) is Rajasthan's biggest convention and exhibition centre.
				</p>
            </div>
			<div class="section-heading">
            <h2><div class="white-button">
                    <a href="city_homepage.php?id=2">Explore</a>
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

      $(".main-menu").on("click", "a", function(e) {
        e.preventDefault();
        showSection($(this).attr("href"), true);
      });

      $(window).scroll(function() {
        checkSection();
      });
    </script>
  </body>
</html>