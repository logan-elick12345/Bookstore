<?php
include_once("Database.php");

$database = new Database();
$conn = $database->conn;

$name = $_GET['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container">
        <h2>Book List</h2>

        <?php
        if (isset($_GET['success']) && $_GET['success'] == "true") {
            echo "<p class='success-message'>Purchase Successful</p>";
        }
        ?>

        <form action="processPurchase.php" method="POST">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
            <table>
                <tr>
                    <th>Select</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>

                <?php

                if (isset($_GET['keywords']) && $_GET['keywords']){
                    $keywords = $_GET['keywords'];
                    $keywordsArray = explode(' ', $keywords);

                    $conditions = [];
                    foreach ($keywordsArray as $word) {
                        $escapedWord = mysqli_real_escape_string($conn, $word);
                        $conditions[] = "(title LIKE '%$escapedWord%')";
                    }
                
                    $sql = "SELECT * FROM book WHERE " . implode(" OR ", $conditions);
                    
                } else {
                    $sql = "SELECT * FROM book";
                }

                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='selected_books[]' value='" . htmlspecialchars($row['ISBN']) . "'></td>";
                        echo "<td>" . htmlspecialchars($row['ISBN']) . "</td>";
                        echo "<td><a href='http://undcemcs02.und.edu/~logan.elick/457/1/bookInfo.php?name=". urlencode($name) ."&title=" . urlencode($row['title']) . "'>" . htmlspecialchars($row['title']) . "</a></td>";
                        echo "<td>$" . number_format((float)$row['price'], 2) . "</td>";
                        echo "<td><input type='number' name='quantity[" . htmlspecialchars($row['ISBN']) . "]' value='0' min='0'></td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No books found.</td></tr>";
                }
                ?>
            </table>
            <button type="submit">Add to Cart</button>
        </form>

        <form action="return.php" method="GET">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="interface" value="4">
            <button type="submit" class="back-btn">Back</button>
        </form> 
    </div>
</body>
</html>
