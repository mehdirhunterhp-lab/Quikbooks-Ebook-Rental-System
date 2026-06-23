<?php
session_start();
include("connection.php");
include("functions.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; 

if (!isset($_GET['user_id'])) {
    echo "Invalid request.";
    exit;
}

$user_id = $_GET['user_id'];

$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $current_username = $user_data['username'];
    $current_email = $user_data['email'];
} else {
    echo "User not found!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    if (!empty($username) && !empty($email) && !is_numeric($username) && !is_numeric($email)) {
        $update_query = "UPDATE users SET username = ?, email = ? WHERE user_id = ?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("sss", $username, $email, $user_id);

        if ($stmt->execute()) {
            header("Location: adminUsers.php"); // Redirect back to admin panel
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Please enter valid information.";
    }
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
   
     <style>
    body { 
        font-family: Arial, sans-serif; 
        background-color: #f5f5dc; 
        text-align: center; 
        margin: 0;
        padding: 0;
    }
    
    header, footer { 
        background-color: #4ab8c7; 
        color: white; 
        padding: 15px 0; 
        width: 100%; 
        position: fixed; 
        left: 0;
        text-align: center;
    }

    header {
        top: 0;
    }

    footer {
        bottom: 0;
    }

    .container { 
        margin: 100px auto 60px; /* Adjust margin to avoid overlap with header/footer */
        width: 50%; 
        background: white; 
        padding: 20px; 
        border-radius: 10px; 
    }

    input { 
        width: 80%; 
        padding: 8px; 
        margin: 10px 0; 
        border: 1px solid #ccc; 
        border-radius: 5px; 
    }

    button { 
        padding: 10px 15px; 
        background: #4ab8c7; 
        color: white; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
    }

    button:hover { 
        background: #3a9aa8; 
    }
		</style>

  
</head>
<body>
    <header>
        <h2>Edit User</h2>
    </header>
	<br>
	<br>
	<br>
    <div class="container">
        <form action="adminUserEdit.php?user_id=<?php echo $user_id; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($current_username); ?>" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($current_email); ?>" required>
            <br>
            <button type="submit">Save</button>
            <button type="button" onclick="location.href='adminUsers.php'">Cancel</button>
        </form>
    </div>
    <footer>
        <p>&copy; QuikBook 2024</p>
    </footer>
</body>
</html>
