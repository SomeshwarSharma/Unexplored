

<?php
  if(!isset($_SESSION)) {
    session_start();
  }
  include "includes/dbhandler.php";
  //<body style="background-image: url('assets/images/page-bg.jpg');background-size: 100% 100%; background-repeat: no-repeat;">
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>The unexplored</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css?<?php echo time(); ?> /">
    <link rel="stylesheet" href="css/style-mickey.css?<?php echo time(); ?> /">
  </head>
  
  <!--<body style="background-image: url('assets/images/try2.jpg');background-size: cover; background-repeat: no-repeat;">-->
  
<br><br><br><br>
<br>
<br>
  <div class="wrapper">
    <section>
	<center>
	</center>
      <div class="login-page">
	  
        <div class="form">
          <form class="login-form" method="POST">
		  <h4><?php if($_GET){echo $_GET['msg'];}?></h4>
		  <h1> Login to your account : </h1>
            <input type="text" name="userid" placeholder="username"/>
            <input type="password" name="password" placeholder="password"/>
            <button type="submit" name="submit">Login</button>
			<p class="message">Not registered ? <a href="signin.php">Register</a></p>
          </form>
        </div>
      </div>
    </section>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="../js/index.js"></script>
    </div>
  </body>
</html>

<?php
  if(isset($_POST['submit'])) {
    $email = $conn->real_escape_string($_POST['userid']);
    $password = $conn->real_escape_string($_POST['password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = $conn->query("SELECT id, password, name , type FROM users WHERE email='$email'");
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

                if($data['type']=='admin'){
                  header("Location: admin_home.php");

                }else{
                  header("Location: main_homepage.php");

                }
            } else
                exit('failed');
        }
    } else
        exit('failed');
  }
?>