<?php
include_once("Database.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$database = new Database();
$conn = $database->conn;

$title = $_GET['title'];
$name = $_GET['name'];

$sql = "SELECT * FROM BOOK WHERE `title` = '$title'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$isbn = $row['ISBN'];
$price = $row['price'];

$sql = "SELECT * FROM PURCHASES WHERE `isbn` = '$isbn'";
$result = $conn->query($sql);
$quantity = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $quantity += ($row['quantity']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ("Info for " . $title) ?></title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container">

        <table>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Price</th>
                <th>Quantity Purchased</th>
            </tr>
            <tr>
                <td><?php echo $isbn?></td>
                <td><?php echo $title?></td>
                <td><?php echo $price?></td>
                <td><?php echo $quantity?></td>
            </tr>

        </table>

        <form action="return.php" method="GET">
            <button type="submit" class="back-btn">Back</button>
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="interface" value="5">
        </form> 
    </div>
</body>
</html>
