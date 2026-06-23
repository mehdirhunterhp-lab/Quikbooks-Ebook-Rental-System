<!DOCTYPE html>
<html>
<head>
<title>Delete Account</title>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete your account? This action cannot be undone.");
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

// Get the user ID from the session, not the URL
$user_id = $_SESSION['user_id'];  // This is the key change

// Verify that the user is trying to delete their own account
if (isset($_GET['user_id']) && $_GET['user_id'] != $user_id) {
    echo "You are not authorized to delete this account.";
    exit; // Stop execution to prevent unauthorized deletion
}


// Prepare the DELETE statement
$query = "DELETE FROM users WHERE user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id); // Changed to "i" for integer user_id (adjust if your user_id is a different type)

if ($stmt->execute()) {
    // Destroy the session and redirect to logout page or wherever you want
    session_destroy();  // Important: Destroy the session after deleting the account
    header("Location: logout.php"); // Or wherever you want to redirect after deletion
    exit;
} else {
    echo "Error deleting record: " . $stmt->error;
}

$stmt->close();
$con->close();
?>

<h1>Delete Account</h1>

<p>Are you sure you want to delete your account? This action cannot be undone.</p>

<form action="delProfile.php" method="GET" onsubmit="return confirmDelete();">
    <input type="hidden" name="confirm" value="true">  </input>
    <button type="submit">Yes, Delete Your Account</button>
</form>

<a href="dashboard.php">Cancel</a>  </p>



</body>
</html>