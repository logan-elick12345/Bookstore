<?php
$name = $_GET['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>

        <form action="return.php" method="GET">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="hidden" name="interface" value="2">
            <button type="submit">Back</button>
        </form> 

        <form action="adminScreen.php" method="GET">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <button type="submit">Add Books</button>
        </form>

        <form action="bookList.php" method="GET">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="text" name="keywords" placeholder="Enter keyword">
            <button type="submit">List Books</button>
        </form>

        <form action="userList.php" method="GET">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <button type="submit">List Users</button>
        </form>

    </div>
</body>
</html>
