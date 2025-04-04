<?php
include_once("Database.php");

$database = new Database();
$conn = $database->conn;
$name= $_POST['name'];
$quantity = 0;

if (!empty($_POST['selected_books']) && !empty($_POST['quantity'])) {
    $totalCost = 0; 
    
    foreach ($_POST['selected_books'] as $isbn) {
        $quantity = $_POST['quantity'][$isbn];
        $sql = "SELECT `id` FROM CUSTOMER WHERE `name` = '$name'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $custID = $row['id'];
        
        if ($quantity > 0) {
            $priceSql = "SELECT price FROM book WHERE ISBN = '$isbn'";
            $result = $conn->query($priceSql);
            $row = $result->fetch_assoc();
            $bookPrice = $row['price'];
            $totalCost += $bookPrice * $quantity;

            $checkSql = "SELECT quantity FROM purchases WHERE isbn = '$isbn' AND custID = $custID";
            $result = $conn->query($checkSql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $quantityFound = $row['quantity'];
                $totalQuantity = $quantityFound + $quantity;
                $updateSql = "UPDATE purchases SET quantity = $totalQuantity WHERE isbn = '$isbn' AND custID = $custID";
                $conn->query($updateSql);
            } else {
                $insertSql = "INSERT INTO purchases (isbn, custID, quantity) VALUES ('$isbn', $custID, $quantity)";
                $conn->query($insertSql);
            }
        }
    }

    if ($totalCost > 0) {
        $updateTotalSpent = "UPDATE customer SET total_spent = total_spent + $totalCost WHERE id = $custID";
        $conn->query($updateTotalSpent);
        echo "<script>alert('Purchase successful!'); window.location.href='dashboard.php?name=$name';</script>";

    } else {
        echo "<script>alert('Error: No valid purchases made!'); window.location.href='dashboard.php?name=$name';</script>";
    }
} else {
    echo "<script>alert('No books selected!'); window.location.href='dashboard.php?name=$name';</script>";
    exit();
}

$conn->close();
