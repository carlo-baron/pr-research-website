<?php
// Start the session (if not already started)
session_start();

// Logout logic
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();

    // Redirect to the index page
    header("Location: index.php");
    exit();
}

// Update logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $conn = mysqli_connect("localhost", "root", "", "prdb");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $rfid = $_POST["rfid"];
    $new_balance = $_POST["new_balance"];

    $update_sql = "UPDATE datas SET balance = '$new_balance' WHERE rfid = '$rfid'";
    $result = $conn->query($update_sql);

    // Note: No messages are displayed intentionally.

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles-data.css">
    <title>RFID DATABASE</title>
</head>

<body>
    <div class="title">
        <h1>RFID DATABASE</h1>
    </div>
    <div class="data">
        <!-- Logout Button -->
        <form method="post">
            <input type="submit" name="logout" value="Logout">
        </form>

        <table>
            <tr>
                <td>RFID</td>
                <td>NAME</td>
                <td>AMOUNT</td>
                <td>DATE</td>
                <td>ACTION</td>
            </tr>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "prdb");

            if ($conn->connect_error) {
                die("Connection failed:" . $conn->connect_error);
            }

            $sql = "SELECT rfid, name, balance, timestamp FROM datas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["rfid"] . "</td><td>" . $row["name"] . "</td><td>" . $row["balance"] . "</td><td>" . $row["timestamp"] . "</td><td>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='rfid' value='" . $row["rfid"] . "' />";
                    echo "<input type='number' name='new_balance' value='" . $row["balance"] . "' />";
                    echo "<input type='submit' name='update' value='Update' />";
                    echo "</form></td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>
