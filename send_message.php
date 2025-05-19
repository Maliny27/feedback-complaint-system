//send_message.php

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "feedback_system");

$feedback_id = $_POST['feedback_id'];
$role = $_SESSION['role'];
$content = $_POST['content'];

$stmt = $conn->prepare("INSERT INTO messages (feedback_id, sender_role, content) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $feedback_id, $role, $content);
$stmt->execute();

header("Location: view_feedback.php?id=$feedback_id");
?>
