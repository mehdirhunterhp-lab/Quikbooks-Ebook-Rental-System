<?php 
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get input values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
	
	// echo $username; exit;
    // Validate input
    if (!empty($username) && !empty($email) && !empty($password) && !is_numeric($username) && !is_numeric($email)) {

        // Check if passwords match
        if ($password !== $confirm_password) {
            echo "Passwords do not match!";
            exit;
        }

        // Hash the password
        $hashed_password = md5($password);

        // Generate user ID
        $user_id = random_num(20);

        // Prepare and execute query
        $stmt = $con->prepare("INSERT INTO users (user_id, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user_id, $username, $email, $hashed_password);
        $stmt->execute();

        // Redirect to login
        header("Location: login.php");
        exit;
    } else {
        echo "Please enter some valid information!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="style.css">  </head>
<body>
	<header>
	<h2>Registration Form</h2>
	<button onclick="location.href='index.html'" style="background-color: #818589; color: white; padding: 10px 20px; border: none; border-radius: 4px; margin-left: 20px;cursor: pointer;">Return Home</button><br><br>
	</header><br><br><br><br><br><br><br><br>
  <form action="signup.php" method="post"> 
	<label for="name" style="color:#4ab8c7;">Username:</label>
    <input type="text" id="name" name="username" required> 
	<br><br><label for="email" style="color:#4ab8c7;">Email:</label>
    <input type="email" id="email" name="email" required>  
	<br><br><label for="password" style="color:#4ab8c7;">Password:</label>
    <input type="password" id="password" name="password" required>  
	<br><br><label for="confirm_password" style="color:#4ab8c7;">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>  


    <button type="submit" style="color:#4ab8c7;">Register</button>
	<p style="text-align: center;color:#4ab8c7;">Already Have An Account? <button onclick="location.href='login.php'" style="color:#4ab8c7;">Login Here</button></p>
  </form>
<footer>
    <p>&copy; QuikBook 2024</p>
</footer>
	
</body>
</html>
