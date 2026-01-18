<?php
$conn = new mysqli("127.0.0.1", "root","Krutibas@2003", "user_system",3306);

if($conn-> connect_error){
    die("Connection failed: ". $conn->connect_error);
}
?>