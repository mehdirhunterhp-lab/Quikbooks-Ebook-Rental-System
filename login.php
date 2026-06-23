<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hashed_password = md5($password);
		//var_dump($_POST);return;
		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			//read from database
			$query = "select * from users where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					//var_dump($user_data);return;
					//echo $user_data['password'].'<br>';
					//echo $hashed_password;return;
					if($user_data['password'] === $hashed_password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						if($user_data['id'] == 8){ 
							header("Location: admin.php");
							die;
						}else{
							header("Location: dashboard.php");
							die;
						}
						
						
					}
					echo 'end here';
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Sign In</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h2>Login/Sign In</h2>
    <button onclick="location.href='index.html'" style="background-color: #818589; color: white; padding: 10px 20px; border: none; border-radius: 4px; margin-left: 20px; cursor: pointer;">Return Home</button><br><br>
  </header><br><br><br><br><br><br><br><br>
  <form action="login.php" method="POST">
    <label for="username" style="color:#4ab8c7;">Username:</label>
    <input type="text" id="username" name="username" required>
    <br><br>
    <label for="password" style="color:#4ab8c7;">Password:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <button type="submit" style="color:#4ab8c7;">Login</button>
    <p style="color:#4ab8c7;">Customer Username:customer Password:cus123</p><p style="color:#4ab8c7;">Admin Username:admin Password:admin123</p>
    <p style="text-align: center; color:#4ab8c7;">Don't have an account? <button type="button" onclick="location.href='signup.php'" style="color:#4ab8c7;">Sign Up Here</button></p>
  </form>
  
  <footer>
    <p>&copy; QuikBook 2024</p>
  </footer>
</body>
</html>
