<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Login</h2>

    <form method="post">
        Email: <input type="email" name="email" required><br><br>
        Passwoed: <input type="password" name="password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>


    <?php
    session_start();
    include "config.php";

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = $conn-> query("SELECT * FROM users WHERE email='$email'");
        $user = $result->fetch_assoc();

        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
        }else{
            echo "Invalid login details";
        }
    }
    ?>
</body>
</html>