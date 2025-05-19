//register_action.php

<?php
$conn = new mysqli("localhost", "root", "", "feedback_system");

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// By default, new users are 'user'
$stmt = $conn->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, 'user')");
$stmt->bind_param("sss", $name, $email, $password);
$stmt->execute();

header("Location: login.php");
?>
