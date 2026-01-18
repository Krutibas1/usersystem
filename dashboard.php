<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Welcome</h2>

    <p>Name: <?php echo $_SESSION['user']['name']; ?></p>
    <p>Email: <?php echo $_SESSION['email']['email']; ?></p>

    <a href="logout.php">Logout</a>




</body>
</html>