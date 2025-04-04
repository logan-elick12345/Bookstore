<?php

if ($_GET['password'] == "logan123") {
    
    $file = $_GET['options'];

    $allowed_files = [
        'login' => 'login.php',
        'loginClass' => 'LoginClass.php',
        'index' => 'index.html',
        'processPurchase' => 'processPurchase.php',
        'return' => 'return.php',
        'addBook' => 'addBook.php',
        'adminScreen' => 'adminScreen.php',
        'bookList' => 'bookList.php',
        'bookInfo' => 'bookInfo.php',
        'clearSystem' => 'clearSystem.php',
        'dashboard' => 'dashboard.php',
        'database' => 'database.php',
        'userList' => 'userList.php',
        'userInfo' => 'userInfo.php'
    ];

    if (array_key_exists($file, $allowed_files)) {
        $file_path = $allowed_files[$file];

        if (file_exists($file_path)) {
            echo "<pre>" . htmlspecialchars(file_get_contents($file_path)) . "</pre>";
        } else {
            echo "File does not exist.";
        }
    } else {
        echo "Invalid file selection.";
    }
} else {
    echo "Invalid password.";
}
?>
