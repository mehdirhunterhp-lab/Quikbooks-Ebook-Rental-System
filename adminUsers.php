<?php
session_start();
include("connection.php");
include("functions.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; 

$sql = "SELECT id, user_id, username, role, email FROM users";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8e7;
            text-align: center;
            overflow-y: auto; /* Enables vertical scrolling */
            height: 100vh; /* Ensures it takes full viewport height */
        }
        header {
            background-color: #4db6ac;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            position: relative;
        }
        .logout-button {
            position: absolute;
            left: 20px;
            top: 20px;
            background-color: #00796b;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        main {
            padding: 20px;
            max-height: 80vh; /* Adjust based on footer/header height */
            overflow-y: auto; /* Allows scrolling within the main section */
        }
        .styled-table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .styled-table th, .styled-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .styled-table th {
            background-color: #4db6ac;
            color: white;
        }
        .styled-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .view-button {
            text-decoration: none;
            background-color: #00796b;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            display: inline-block;
        }
        .add-button {
            text-decoration: none;
            background-color: #00796b;
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            float: left;
            display: inline-block;
        }
        footer {
            background-color: #4db6ac;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }
        .delete-button {
            text-decoration: none;
            background-color: #d32f2f;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            display: inline-block;
        }
        .delete-button:hover {
            background-color: #b71c1c;
        }
    </style>
    <script>
        function logout() {
            window.location.href = 'admin.php';
        }
    </script>
</head>
<body>

    <header>
        Admin Section | QuikBook
        <button class="logout-button" onclick="logout()">Back</button>
    </header>
    <main>
        <h2>Users List</h2>
        <a class='add-button' href='adminSignup.php'>Add User</a>
        <table class="styled-table">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>
                        <a class='view-button' href='adminUserEdit.php?user_id=" . $row["user_id"] . "'>Edit</a>
                        <a class='delete-button' href='adminUserDelete.php?user_id=" . $row["user_id"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No users found</td></tr>";
            }
            ?>
        </table>
    </main>
    <footer>
        <p>&copy; QuikBook 2024</p>
    </footer>
</body>
</html>

<?php
$con->close();
?>
