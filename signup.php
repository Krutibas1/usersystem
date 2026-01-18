<?php
session_start();
require_once "config.php";

$error = "";

if (isset($_POST['signup'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {

        // redirect to login after signup
        header("Location: login.php");
        exit;

    } else {
        $error = "Email already exists";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Signup</h2>

<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="signup">Signup</button>
</form>

<p style="color:red;"><?php echo $error; ?></p>
</body>
</html>
