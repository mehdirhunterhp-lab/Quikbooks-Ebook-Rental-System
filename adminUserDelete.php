<!DOCTYPE html>
<html>
<head>
<title>Delete Account</title>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this account? This action cannot be undone.");
}
</script>
</head>
<body>


<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['user_id'])) {
    echo "Invalid request.";
    exit;
}

$user_id = $_GET['user_id'];

// Prevent admin from deleting themselves
if ($user_id == $_SESSION['user_id']) {
    echo "You cannot delete your own account.";
    exit;
}

// Prepare the DELETE statement
$query = "DELETE FROM users WHERE user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $user_id);

if ($stmt->execute()) {
    header("Location: adminUsers.php"); // Redirect back to the user list
    exit;
} else {
    echo "Error deleting record: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
<h1>Delete Account</h1>

<p>Are you sure you want to delete this account? This action cannot be undone.</p>

<form action="adminUserDelete.php" method="GET" onsubmit="return confirmDelete();">
    <input type="hidden" name="confirm" value="true">  </input>
    <button type="submit">Yes, Delete this Account</button>
</form>

<a href="adminUsers.php">Cancel</a>  </p>



</body>
</html>