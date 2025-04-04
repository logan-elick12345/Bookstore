<?php
ini_set('display_errors', 1);
include_once("Database.php");
include_once("LoginClass.php");

$act = $_GET['act'];
$name = $_GET['name'];
$name = strtolower($name);

$database = new Database();

$login = new LoginClass($act, $name, $database);

if ($login->signInResult == 1 || $login->signUpResult == 1){
    header("Location: dashboard.php?name=$name");
    exit();
} elseif ($login->signUpResult == 2) {
    echo "<script>alert('User already registered'); window.location.href='index.html';</script>";
} else {
    echo "<script>alert('User not found'); window.location.href='index.html';</script>";
}
