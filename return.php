<?php

if (isset($_GET['name'])){
    $name = $_GET['name'];
    if ($_GET['interface'] == "3"){
        header("Location: dashboard.php?name=$name");
    } elseif (($_GET['interface'] == "2")){
        header("Location: index.html");
    } elseif (($_GET['interface'] == "4")){
        header("Location: dashboard.php?name=$name");
    } elseif (($_GET['interface'] == "5")){
        header("Location: dashboard.php?name=$name");
    }elseif (($_GET['interface'] == "6")){
        header("Location: dashboard.php?name=$name");
    }
}