//login_action.php

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "feedback_system");

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password_hash'])) {
  $_SESSION['user_id'] = $user['user_id'];
  $_SESSION['role'] = $user['role'];
  $_SESSION['name'] = $user['name'];

  if ($user['role'] === 'admin') {
    header("Location: admin.php");
  } else {
    header("Location: dashboard.php");
  }
} else {
  echo "Login failed. <a href='login.php'>Try again</a>";
}
?>
