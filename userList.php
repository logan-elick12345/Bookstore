<?php
include_once("Database.php");

$database = new Database();
$conn = $database->conn;

session_start();

$name = isset($_GET['name']) ? $_GET['name'] : '';

$is_admin = $name === 'admin';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container">
        <h2>User List</h2>

        <table>
            <tr>
                <th>Name</th>
            </tr>

            <?php
            if (!$is_admin) {
                $sql = "SELECT * FROM customer WHERE name = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><a href='userInfo.php?name=" . urlencode($name) . "&user_id=" . urlencode($row['id']) . "'>" . htmlspecialchars($row['name']) . "</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td>No user found.</td></tr>";
                }
            } else {
                $sql = "SELECT * FROM customer";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><a href='userInfo.php?name=" . urlencode($name) . "&user_id=" . urlencode($row['id']) . "'>" . htmlspecialchars($row['name']) . "</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td>No users found.</td></tr>";
                }
            }
            ?>
        </table>

        <form action="return.php" method="GET">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="hidden" name="interface" value="6">
            <button type="submit">Back</button>
        </form> 

    </div>
</body>
</html>
