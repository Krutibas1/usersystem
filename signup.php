<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>SignUp</h2>
     
    <form >
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>

        <button type="submit" name="signup">Signup</button>
    </form>


    <?php
include "config.php";

if(isset($_Post['signup'])){
    $name= $_POST['name'];
    $email=$_POST['email'];
    $password= password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if($conn->query($sql)) {
        echo "Signup successful.";
    }else{
        echo "Email already exists";
    }
}
?>
</body>
</html>

