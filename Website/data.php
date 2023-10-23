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
        <table>
            <tr>
                <td>RFID</td>
                <td>NAME</td>
                <td>AMOUNT</td>
                <td>DATA</td>
            </tr>
            <?php
            $conn = mysqli_connect("localhost", "root", "bes23-24", "researchdb");
            if ($conn->connect_error) {
                die("Connection failed:" . $conn->connect_error);
            }

            $sql = "SELECT id, std_name, amount, last_transaction from data";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["std_name"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["last_transaction"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 result";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>


</html>