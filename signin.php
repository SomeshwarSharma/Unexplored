<?php
  include "includes/dbhandler.php"  
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
  <body style="background-color:lightblue;">
<br>
<br><br><br><br>
<br>
<br>
  <?php
    if(isset($_POST['submit'])) {

    $username = $_POST['userid'];
    $pass = $_POST['password'];
	$name = $_POST['name'];
	$num= $_POST['num'];
	$sql2= mysqli_query($conn,"select count(1) from user where email= '$username'");
	if(mysqli_fetch_row($sql2))
	{
		$msg= $username." account already exists";
		header("Location: login.php?msg=".$msg);
	}
	else
	{
    $sql = mysqli_query($conn, "INSERT INTO `user`(`U_id`, `U_name`, `type`,`password`, `M_no`, `email`) VALUES ('','$name','explorer','$pass','$num','$username')");

    if(!$sql)
    {
        echo mysqli_error($conn);
    }
	$_SESSION['id'] = $row['username'];
	
header("Location: Login.php");
mysqli_close($conn);
	}

  }
  ?>

  <div class="wrapper">
    <section>
      <div class="login-page">
        <div class="form">
          <form class="login-form" method="POST">
            <input type="text" name="name" placeholder="Enter your name:"/>
			<input type="text" name="userid" placeholder="Enter your email id"/>
            <input type="password" name="password" placeholder="Create a password"/>
			<input type="number" name="num" placeholder="Enter your phone number"/>
            <button type="submit" name="submit">Register</button>
			<p class="message">Already a member ? <a href="login.php">Login</a></p>
          </form>
        </div>
      </div>
    </section>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="../js/index.js"></script>
    </div>
  </body>
</html>