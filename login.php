<?php
session_start();
require_once "config.php";

$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user'] = [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email']
        ];

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Invalid login details";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Login</h2>

<form method="post">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>

<p style="color:red;"><?php echo $error; ?></p>
</body>
</html>
