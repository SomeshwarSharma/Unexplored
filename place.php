<?php
session_start();

$loggedIn = false;

if (isset($_SESSION['loggedIn']) && isset($_SESSION['name'])) {
    $loggedIn = true;
}
$conn = new mysqli('localhost', 'root', '', 'unexplored');

function createCommentRow($data, $isReply = false) {
    global $conn;

    if ($isReply)
        $isReply = 'yes';
    else
        $isReply = 'no';

    $response = '
            <div id="comment_'.$data['id'].'" class="comment">
                <div class="user">'.$data['name'].' <span class="time timeago" data-date="'.$data['createdOn'].'"></span></div>
                <div class="userComment">'.$data['comment'].'</div>
                <div class="reply">
                    <i class="fas fa-thumbs-up" data-isReply="'.$isReply.'" onclick="react(this,'.$data['id'].', \'up\')"></i>
                    <i class="fas fa-thumbs-down" data-isReply="'.$isReply.'" onclick="react(this,'.$data['id'].', \'down\')"></i>
                    <a href="javascript:void(0)" data-commentID="'.$data['id'].'" onclick="reply(this)">REPLY</a>
                </div>
                <div class="replies">';

    $sql = $conn->query("SELECT replies.id, name, comment, replies.createdOn FROM replies INNER JOIN users ON replies.userID = users.id WHERE replies.commentID = '".$data['id']."' ORDER BY replies.id DESC LIMIT 1");
    while($dataR = $sql->fetch_assoc())
        $response .= createCommentRow($dataR, true);

    $response .= '
                        </div>
            </div>
        ';

    return $response;
}

if (isset($_POST['getUserReactions'])) {
    $reactions = [];
    $sql = $conn->query("SELECT commentID, type, isReply FROM reactions");
    while($data = $sql->fetch_assoc())
        $reactions[] = array("commentID" => $data['commentID'], "type" => $data['type'], "isReply" => $data['isReply']);

    exit(json_encode($reactions));
}

if (isset($_POST['getAllComments'])) {
    $start = $conn->real_escape_string($_POST['start']);

    $response = "";
    $sql = $conn->query("SELECT comments.id, name, comment, comments.createdOn FROM comments INNER JOIN users ON comments.userID = users.id ORDER BY comments.id DESC LIMIT $start, 20");
    while($data = $sql->fetch_assoc())
        $response .= createCommentRow($data);

    exit($response);
}

if (isset($_POST['react'])) {
    $commentID = $conn->real_escape_string($_POST['commentID']);
    $type = $conn->real_escape_string($_POST['type']);
    $isReply = $conn->real_escape_string($_POST['isReply']);

    $sql = $conn->query("SELECT id FROM reactions WHERE commentID='$commentID' && userID='".$_SESSION['userID']."'");
    if ($sql->num_rows > 0) {
        $status = "updated";
        $conn->query("UPDATE reactions SET type='$type' WHERE commentID='$commentID' && userID='".$_SESSION['userID']."'");
    } else {
        $status = "inserted";
        $conn->query("INSERT INTO reactions (isReply,type,commentID, userID) VALUES ('$isReply','$type', '$commentID', '".$_SESSION['userID']."')");
    }

    exit(json_encode(array('status' => $status)));
}

if (isset($_POST['addComment'])) {
    $comment = $conn->real_escape_string($_POST['comment']);
    $isReply = $conn->real_escape_string($_POST['isReply']);
    $commentID = $conn->real_escape_string($_POST['commentID']);

    if ($isReply != 'false') {
        $conn->query("INSERT INTO replies (comment, commentID, userID, createdOn) VALUES ('$comment', '$commentID', '".$_SESSION['userID']."', NOW())");
        $sql = $conn->query("SELECT replies.id, name, comment, replies.createdOn FROM replies INNER JOIN users ON replies.userID = users.id ORDER BY replies.id DESC LIMIT 1");
    } else {
        $conn->query("INSERT INTO comments (userID, comment, createdOn) VALUES ('".$_SESSION['userID']."','$comment',NOW())");
        $sql = $conn->query("SELECT comments.id, name, comment, comments.createdOn FROM comments INNER JOIN users ON comments.userID = users.id ORDER BY comments.id DESC LIMIT 1");
    }

    $data = $sql->fetch_assoc();
    exit(createCommentRow($data));
}

if (isset($_POST['register'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = $conn->query("SELECT id FROM users WHERE email='$email'");
        if ($sql->num_rows > 0)
            exit('failedUserExists');
        else {
            $ePassword = password_hash($password, PASSWORD_BCRYPT);
            $conn->query("INSERT INTO users (name,email,password,createdOn) VALUES ('$name', '$email', '$ePassword', NOW())");

            $sql = $conn->query("SELECT id FROM users ORDER BY id DESC LIMIT 1");
            $data = $sql->fetch_assoc();

            $_SESSION['loggedIn'] = 1;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['userID'] = $data['id'];

            exit('success');
        }
    } else
        exit('failedEmail');
}

if (isset($_POST['logIn'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = $conn->query("SELECT id, password, name FROM users WHERE email='$email'");
        if ($sql->num_rows == 0)
            exit('failed');
        else {
            $data = $sql->fetch_assoc();
            $passwordHash = $data['password'];

            if (password_verify($password, $passwordHash)) {
                $_SESSION['loggedIn'] = 1;
                $_SESSION['name'] = $data['name'];
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];

                exit('success');
            } else
                exit('failed');
        }
    } else
        exit('failed');
}

$sqlNumComments = $conn->query("SELECT id FROM comments");
$numComments = $sqlNumComments->num_rows;

$P_id = $_GET['pid'];
	
	$sql1 = "select Pic_url from picture where P_id= $P_id and Pic_desc= 'top'";
	$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) 
		{
			while($row = $result1->fetch_assoc())
			{
				$pic_url1 = $row['Pic_url'];
			}
		}
	$sql2 = "select Pic_url from picture where P_id=$P_id and Pic_desc='mid' ";
	$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0) 
		{
			while($row = $result2->fetch_assoc())
			{
				$pic_url2=$row['Pic_url'];
			}
		}
	$sql3 = "select * from post where P_id=$P_id";
	$result3 = $conn->query($sql3);
		if ($result3->num_rows > 0) 
		{
			while($row = $result3->fetch_assoc())
			{
				$about=$row['about'];
				$open_hr=$row['open_hr'];
				$name= $row['P_head'];
				$para1= $row['para1'];
				$head_url= $row['P_pic'];
				$gmap= $row['P_gmap'];
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
    <style type="text/css">
        .comment {
            margin-bottom: 20px;
        }

        .user {
            font-weight: bold;
            color: black;
        }

        .time, .reply {
            color: gray;
        }

        .userComment {
            color: #000;
        }

        .replies .comment {
            margin-top: 20px;

        }

        .replies {
            margin-left: 20px;
        }

        #registerModal input, #logInModal input {
            margin-top: 10px;
        }

        .fas {
            margin-right: 10px;
        }
        img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
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
              <h4>Explore the unexplored</h4>
            </div>
            <nav class="main-nav" role="navigation">
              <ul class="main-menu">
                <li><a href="#section1">About</a></li>
                <li><a href="#section2">Google Map</a></li>
                <li><a href="#section3">Reviews</a></li>
<!--                <li><a href="#section4">Comments</a></li>-->
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Register</button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#logInModal">Log In</button>
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
                  <img src="<?php echo $pic_url2 ?>" alt="" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="right-text">
                  <h4><?php echo $name;?></h4>
                  <p>
                    <?php echo $about;?>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="right-image-post">
            <div class="row">
              <div class="col-md-6">
                <div class="left-text">
                  <p>
                    <?php echo $para1;?>
                  </p>
				  <p>
					<?php echo $open_hr; ?>
				  </p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="right-image">
                  <img src="<?php echo $pic_url1 ?>" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section my-services" data-section="section2">
        <div class="section-heading">
            <h2>Google Map</h2>
            <div class="line-dec"></div>
          </div>
          <div class="row">
               <iframe src="<?php echo $gmap;?> " width="600" height="450" frameborder="0" style="border:0; width:100%;max-width:1000px;margin-top:32px;" allowfullscreen="" aria-hidden="false" tabplace="0"></iframe>  
            </div>
      </section>

      <section class="section about-services" data-section="section3">
          <div class="container">
          <div class="section-heading">
            <h2>Reviews</h2>
            <div class="line-dec"></div>
           
          </div>
          <div class="row">
               <div class="first-service-icon service-icon"> </div>
               
               <div class="modal" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registration Form</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="userName" class="form-control" placeholder="Your Name">
                <input type="email" id="userEmail" class="form-control" placeholder="Your Email">
                <input type="password" id="userPassword" class="form-control" placeholder="Password">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="registerBtn">Register</button>
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="logInModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log In Form</h5>
            </div>
            <div class="modal-body">
                <input type="email" id="userLEmail" class="form-control" placeholder="Your Email">
                <input type="password" id="userLPassword" class="form-control" placeholder="Password">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="loginBtn">Log In</button>
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top:50px;">
    
   
    <div class="row">
        <div class="col-md-12">
            <textarea class="form-control" id="mainComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
            <button style="float:right" class="btn-primary btn" onclick="isReply = false;" id="addComment">Add Comment</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2><b id="numComments"><?php echo $numComments ?> Comments</b></h2>
            <div class="userComments">

            </div>
        </div>
    </div>
</div>

<div class="row replyRow" style="display:none">
    <div class="col-md-12">
        <textarea class="form-control" id="replyComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
        <button style="float:right" class="btn-primary btn" onclick="isReply = true;" id="addReply">Add Reply</button>
        <button style="float:right" class="btn-default btn" onclick="$('.replyRow').hide();">Close</button>
    </div>
</div>
		
            </div>
          </div>
      </section>

      <!--<section class="section contact-me" data-section="section4">
        <div class="container">
          <div class="section-heading">
            <h2>Reviews</h2>
            <div class="line-dec"></div>
            <span>
			</span>
          </div>
          <div class="row">
               <div class="first-service-icon service-icon"></div>
			   <p>
                Comment Section
				</p>
            </div>
          </div>
      </section>-->
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
<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/jquery.timeago.js"></script>
<script type="text/javascript">
    var isReply = false, commentID = 0, max = <?php echo $numComments ?>;

    $(document).ready(function () {
        $("#addComment, #addReply").on('click', function () {
            var comment;

            if (!isReply)
                comment = $("#mainComment").val();
            else
                comment = $("#replyComment").val();

            if (comment.length > 5) {
                $.ajax({
                    url: 'place.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        addComment: 1,
                        comment: comment,
                        isReply: isReply,
                        commentID: commentID
                    }, success: function (response) {
                        max++;
                        $("#numComments").text(max + " Comments");

                        if (!isReply) {
                            $(".userComments").prepend(response);
                            $("#mainComment").val("");
                        } else {
                            commentID = 0;
                            $("#replyComment").val("");
                            $(".replyRow").hide();
                            $('.replyRow').parent().next().append(response);
                        }

                        calcTimeAgo();
                    }
                });
            } else
                alert('Please Check Your Inputs');
        });

        $("#registerBtn").on('click', function () {
            var name = $("#userName").val();
            var email = $("#userEmail").val();
            var password = $("#userPassword").val();

            if (name != "" && email != "" && password != "") {
                $.ajax({
                    url: 'place.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        register: 1,
                        name: name,
                        email: email,
                        password: password
                    }, success: function (response) {
                        if (response === 'failedEmail')
                            alert('Please insert valid email address!');
                        else if (response === 'failedUserExists')
                            alert('User with this email already exists!');
                        else
                            window.location = window.location;
                    }
                });
            } else
                alert('Please Check Your Inputs');
        });

        $("#loginBtn").on('click', function () {
            var email = $("#userLEmail").val();
            var password = $("#userLPassword").val();

            if (email != "" && password != "") {
                $.ajax({
                    url: 'place.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        logIn: 1,
                        email: email,
                        password: password
                    }, success: function (response) {
                        if (response === 'failed')
                            alert('Please check your login details!');
                        else
                            window.location = window.location;
                    }
                });
            } else
                alert('Please Check Your Inputs');
        });

        getAllComments(0, max);
        getAllUserReactions();
    });

    function getAllUserReactions() {
        $.ajax({
            url: 'place.php',
            method: 'POST',
            dataType: 'json',
            data: {
                getUserReactions: 1
            }, success: function (response) {
                for (var i=0; i < response.length; i++) {
                    $('i[onclick="react(this,'+response[i].commentID+', \''+response[i].type+'\')"]').each(function () {
                        if (response[i].isReply === $(this).attr('data-isReply'))
                            $(this).css('color', 'blue');
                    });
                }
            }
        });
    }

    function reply(caller) {
        commentID = $(caller).attr('data-commentID');
        $(".replyRow").insertAfter($(caller));
        $('.replyRow').show();
    }

    function calcTimeAgo() {
        $('.timeago').each(function () {
            var timeAgo = $.timeago($(this).attr('data-date'));
            $(this).text(timeAgo);
            $(this).removeClass('timeago');
        });
    }

    function react(caller, commentID, type) {
        $.ajax({
            url: 'place.php',
            method: 'POST',
            dataType: 'json',
            data: {
                react: 1,
                commentID: commentID,
                type: type,
                isReply: $(caller).attr('data-isReply')
            }, success: function (response) {
                if (response.status === 'updated') {
                    if (type === 'up')
                        $(caller).next().css('color', '');
                    else
                        $(caller).prev().css('color', '');
                }

                $(caller).css('color', 'blue');
            }
        });
    }

    function getAllComments(start, max) {
        if (start > max) {
            calcTimeAgo();
            return;
        }

        $.ajax({
            url: 'place.php',
            method: 'POST',
            dataType: 'text',
            data: {
                getAllComments: 1,
                start: start
            }, success: function (response) {
                $(".userComments").append(response);
                getAllComments((start+20), max);
            }
        });
    }
</script>
  </body>
</html>