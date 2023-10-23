<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "bes23-24";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query to retrieve user information from the database
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        // Verify the password (plaintext comparison)
        if ($password === $stored_password) {
            header("Location: data.php");
            exit;
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Username not found!";
    }
}

$conn->close();
?>