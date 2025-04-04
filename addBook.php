<?php
ini_set('display_errors', 1);
session_start();

include_once("Database.php");

$database = new Database();  
$conn = $database->conn; 

if (isset($_GET['title']) && isset($_GET['isbn']) && isset($_GET['price'])){
    $isbn = $_GET['isbn'];
    $title = $_GET['title'];
    $price = $_GET['price'];

    if (checkBook($isbn, $title, $conn) == 1) {
        addBook($isbn, $title, $price, $conn);
    } else {
        echo "<script>alert('Book already exists');window.history.back();</script>";
        return;
    }
}

function checkBook($isbn, $title, $conn) {
    $sql = "SELECT * FROM book WHERE isbn = '$isbn' OR title = '$title'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return 0;
        }
    }

    return 1;
}

function addBook($isbn, $title, $price, $conn) {
    if (strlen($isbn) != 10 || !ctype_digit($isbn)) {
        echo "<script>alert('ISBN must have a length of 10');window.history.back();</script>";
        return;
    }

    if (!is_numeric($price) || $price < 0) {
        echo "<script>alert('Price Invalid');window.history.back();</script>";
        return;
    }

    $sql = "INSERT INTO book (isbn, title, price) VALUES ('$isbn', '$title', '$price')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Book Added');window.history.back();</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
