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
  <title>Admin</title>
  <link rel="stylesheet" href="style.css">
    
</head>
<body>
	<header>
    <h1>Admin Section | QuikBook</h1>
    <nav>
      <button onclick="location.href='logout.php'">Logout</button>
	  
    </nav>
  </header><br><br><br><br><br><br><br><br><br><br>
    
	
	<section id="admin-dashboard" style="text-align:center; color:#4ab8c7;">
      <h2>Welcome Back <?php echo $user_data['username']; ?></h2>
	  <p>Welcome to the admin dashboard. Here, you can access and manage all aspects of your business operations.</p>
    </section>
	
	<section id="nav-section" style="text-align:center; margin-top:150px;">
        <nav>
            <button onclick="location.href='adminBooks.php'">Manage Books</button>
            <button onclick="location.href='adminTrans.php'">View Transactions</button> 
			<button onclick="location.href='adminSales.php'">View Sales Report</button> 
			<button onclick="location.href='adminUsers.php'">View Users</button> 
			<button onclick="location.href='profileadm.php'">Edit Admin Details</button> 
        </nav>
    </section>
    
    <footer>
      <p>&copy; QuikBook 2024</p>
    </footer>
</body>
</html>
