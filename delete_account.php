<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];

// Delete user account
$sql_delete_account = "DELETE FROM entry_details WHERE username='$username' AND password='$password'";
if ($conn->query($sql_delete_account) === TRUE) {
    session_destroy(); // Logout after deleting the account
    header("Location: login.html");
    exit();
} else {
    echo "Error deleting account: " . $conn->error;
    exit();
}
?>
