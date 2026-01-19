<?php
include "header.php";
session_start();
require_once "config.php";

$error = "";

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Email already exists";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create Account</h2>
        
        <?php if ($error): ?>
            <p class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <form method="post" class="flex flex-col gap-y-4">
            <div class="flex flex-col gap-y-1">
                <label for="name" class="text-sm font-semibold text-gray-600">Full Name</label>
                <input type="text" name="name" id="name" required 
                    class="border-2 border-gray-200 rounded-lg p-2.5 focus:border-blue-500 focus:outline-none transition-colors">
            </div>

            <div class="flex flex-col gap-y-1">
                <label for="email" class="text-sm font-semibold text-gray-600">Email Address</label>
                <input type="email" name="email" id="email" required 
                    class="border-2 border-gray-200 rounded-lg p-2.5 focus:border-blue-500 focus:outline-none transition-colors">
            </div>

            <div class="flex flex-col gap-y-1">
                <label for="password" class="text-sm font-semibold text-gray-600">Password</label>
                <input type="password" name="password" id="password" required 
                    class="border-2 border-gray-200 rounded-lg p-2.5 focus:border-blue-500 focus:outline-none transition-colors">
            </div>

            <button type="submit" name="signup" 
                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-all shadow-md active:scale-95">
                Sign Up
            </button>
        </form>

        <p class="mt-6 text-center text-gray-500 text-sm">
            Already have an account? <a href="login.php" class="text-blue-600 hover:underline font-medium">Login</a>
        </p>
    </div>

</body>
</html>