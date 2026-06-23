<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Add Books</title>
  <link rel="stylesheet" href="style.css">
    
</head>
<body>
	<header>
    <h1>Add Books | QuikBook</h1>
    <nav>
      <button onclick="location.href='admin.php'">Return To Admin Dashboard</button>
	  
    </nav>
  </header><br><br><br><br><br><br><br><br><br><br>
    
	
	
	
	
    
    <footer>
      <p>&copy; QuikBook 2024</p>
    </footer>
</body>
</html>