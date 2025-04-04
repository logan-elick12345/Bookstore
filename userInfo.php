<?php
include_once("Database.php");

$database = new Database();
$conn = $database->conn;

$name = isset($_GET['name']) ? $_GET['name'] : '';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

$sql = "SELECT * FROM customer WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

$sql_books = "
    SELECT b.title, p.quantity, b.price
    FROM purchases p
    JOIN book b ON p.isbn = b.ISBN
    WHERE p.custID = ?
";
$stmt_books = $conn->prepare($sql_books);
$stmt_books->bind_param("i", $user_id);
$stmt_books->execute();
$books_result = $stmt_books->get_result();

$total_spent = 0;
$book_details = [];
while ($row = $books_result->fetch_assoc()) {
    $book_details[] = [
        'title' => $row['title'],
        'quantity' => $row['quantity'],
        'price' => $row['price'],
        'total' => $row['quantity'] * $row['price']
    ];
    $total_spent += $row['quantity'] * $row['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container">
        <h2>User Info: <?php echo htmlspecialchars($user['name']); ?></h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Total Spent</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td>$<?php echo number_format((float)$total_spent, 2); ?></td>
            </tr>
        </table>

        <h3>Purchased Books</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php
            if (!empty($book_details)) {
                foreach ($book_details as $book) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($book['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($book['quantity']) . "</td>";
                    echo "<td>$" . number_format((float)$book['price'], 2) . "</td>";
                    echo "<td>$" . number_format((float)$book['total'], 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No books purchased.</td></tr>";
            }
            ?>
        </table>

        <form action="userList.php" method="GET">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <button type="submit" class="back-btn">Back to User List</button>
        </form>
    </div>
</body>
</html>
