//submit_feedback.php

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "feedback_system");

$stmt = $conn->prepare("INSERT INTO feedback (user_id, category, message) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $_SESSION['user_id'], $_POST['category'], $_POST['message']);
$stmt->execute();

header("Location: dashboard.php");
?>
