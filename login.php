<!DOCTYPE html>
   <head>
      <title>Login Page</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="logsign.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <header>LOGIN</header>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


            
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="user" maxlength="8" required placeholder="Username">
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="pass" maxlength="8" class="pass-key" required placeholder="Password">
               </div>
               <br><br><br>
                <!-- <script>
					alert("hello");
				</script> -->

               <div class="field">
                  <input type="submit" name="submit" value="LOGIN">
               </div>
            </form>
           <br>
            <div class="signup">
               Don't have account?
               <a href="signup.php">Signup Now</a>
            </div>
         </div>
      </div>
</Form>

<?php
	session_start();
	if(isset($_COOKIE['username'])&&isset($_COOKIE['password']))
	{
		header("location:home.php");
	}
	if(isset($_POST['submit'])){
		$_SESSION['name'] = $_POST['user'];
		$con = mysqli_connect("localhost","root","","coffee_bar");
		$user = $_POST['user'];
		$password = $_POST['pass'];
		$sql = "select * from register where Username='$user' and Password='$password'";
		

		$res = mysqli_query($con,$sql);
		if (!$res) {
			die('Error: ' . mysqli_error($con));
		}
		if(mysqli_num_rows($res) > 0)
		{
			$row = mysqli_fetch_assoc($res);
			$cookie_name = "user";
            // $cookie_value = $res;
            //  setcookie($cookie_name, $res, time() + (86400 * 30), "/");
	     	//	echo "<script type=\"text/javascript\">console.log('$res');</script>";
			// User exists, login successful
			// $cookie_name = "user";
			setcookie($cookie_name,$row['Userid'], time() + (86400 * 30), "/");
			header("location: home.php");
			
		}
		else
		{
			// User does not exist, login failed
			echo "<script>alert('Incorrect username or password.');</script>";
			
			// header("location:signup.php");
		}   
		if(isset($con))
		{
			// echo "Connect to Mysql";
		}
		else{
			echo "Couldn't connect ".mysqli_error($con);
		}
	mysqli_close($con);
}
?>
   </body>
</html>