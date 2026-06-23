<?php
session_start();
include("connection.php");
include("functions.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; 


$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $current_username = $user_data['username'];
    $current_email = $user_data['email'];
    $current_id = $user_data['id'];
    
} else {
    echo "User not found!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
	//var_dump($_POST);return;
	
    if (!empty($username) && !empty($email) && (!empty($password) && $password === $confirm_password || empty($password)) && !is_numeric($username) && !is_numeric($email)) {  //Password can be empty

        
        if (!empty($password)) {
            $hashed_password = md5($password, PASSWORD_DEFAULT); 
            $update_query = "UPDATE users SET username = ?, email = ?, password = ? WHERE user_id = ?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $user_id);
        } else {
            $update_query = "UPDATE users SET username = ?, email = ? WHERE user_id = ?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param("sss", $username, $email, $user_id);
        }

        if ($stmt->execute()) {
            header("Location: admin.php"); 
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please enter valid information. Passwords must match or you can leave it empty!";
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h2>Edit Profile</h2>
    </header><br><br><br><br><br><br><br><br>
   <form action="profileadm.php" method="post">
   <input type="text" name="id" value="<?php echo $current_id; ?>" hidden>
    <label for="name" style="color:#4ab8c7;">Username:</label>
    <input type="text" id="name" name="username" value="<?php echo $current_username; ?>" required>
    <br><br>
    <label for="email" style="color:#4ab8c7;">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $current_email; ?>" required>
    <br><br>

    <div class="button-container">
        <button type="submit" style="color:#4ab8c7;">Save</button>
        <button type="button" onclick="location.href='admin.php'" style="color:#4ab8c7;">Cancel</button>
    </div>
</form>

	
	
    <footer>
        <p>&copy; QuikBook 2024</p>
    </footer>
</body>
</html>