<?php

include_once("Database.php");
$database = new Database();
$conn = $database->conn;

$tables = ['book', 'customer', 'purchases'];
mysqli_query($conn, "SET foreign_key_checks = 0");

foreach ($tables as $table) {
    $sql = "TRUNCATE TABLE $table";
    $conn->query($sql);
}
$sql = "INSERT INTO `logan_elick`.`customer` VALUES (1, 'admin', 0)";
$conn->query($sql);

mysqli_query($conn, "SET foreign_key_checks = 1");

echo "<script>alert('System cleared'); window.location.href='index.html';</script>";

$conn->close();
?>
