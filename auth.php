<?php
session_start();
include "header.php";
require_once "config.php";

$error = "";
$success = "";

if (isset($_POST['signup'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $success = "Account created successfully. Please login.";
    } else {
        $error = "Email already exists";
    }
}

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentication</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">

    <h2 class="text-3xl font-bold text-center mb-6">User Authentication</h2>

    <?php if ($error): ?>
        <p class="bg-red-100 text-red-700 p-3 rounded mb-4"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="bg-green-100 text-green-700 p-3 rounded mb-4"><?php echo $success; ?></p>
    <?php endif; ?>

    <!-- LOGIN -->
    <div id="loginBox">
        <form method="post" class="space-y-4">
            <input type="email" name="email" placeholder="Email"
                   class="w-full border p-2 rounded" required>
            <input type="password" name="password" placeholder="Password"
                   class="w-full border p-2 rounded" required>

            <button type="submit" name="login"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>

        <p class="text-sm text-center mt-4">
            Don't have an account?
            <button onclick="showSignup()" class="text-blue-600 font-medium">Signup</button>
        </p>
    </div>

    <!-- SIGNUP -->
    <div id="signupBox" class="hidden">
        <form method="post" class="space-y-4">
            <input type="text" name="name" placeholder="Full Name"
                   class="w-full border p-2 rounded" required>
            <input type="email" name="email" placeholder="Email"
                   class="w-full border p-2 rounded" required>
            <input type="password" name="password" placeholder="Password"
                   class="w-full border p-2 rounded" required>

            <button type="submit" name="signup"
                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Sign Up
            </button>
        </form>

        <p class="text-sm text-center mt-4">
            Already have an account?
            <button onclick="showLogin()" class="text-blue-600 font-medium">Login</button>
        </p>
    </div>

</div>

<script>
function showSignup() {
    document.getElementById("loginBox").classList.add("hidden");
    document.getElementById("signupBox").classList.remove("hidden");
}

function showLogin() {
    document.getElementById("signupBox").classList.add("hidden");
    document.getElementById("loginBox").classList.remove("hidden");
}
</script>

</body>
</html>
