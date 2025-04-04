<?php
$name = $_GET['name'];

if ($name !== "admin") {
    echo "<script>
        alert('Only admin can add books');
        window.location.href = 'dashboard.php?name=$name';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <div class="container">

        <form action="return.php" method="GET">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="interface" value="3">
            <button type="submit" style="background-color: gray;">Back</button>
        </form> 

        <h3>Add a New Book</h3>
        <form action="addBook.php" method="GET">
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required>

            <label for="title">Book Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>

            <button type="submit">Add Book</button>
        </form>
    </div>

</body>
</html>
