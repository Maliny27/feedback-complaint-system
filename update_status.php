<?php
session_start();
$conn = new mysqli("localhost", "root", "", "feedback_system");

// Update feedback status
$stmt = $conn->prepare("UPDATE feedback SET status=? WHERE feedback_id=?");
$stmt->bind_param("si", $_POST['status'], $_POST['id']);
$stmt->execute();

// Log the action
$admin_id = $_SESSION['user_id'];
$status = $_POST['status'];
$fid = $_POST['id'];
$action = "Updated feedback ID $fid to '$status'";

$log_stmt = $conn->prepare("INSERT INTO logs (admin_id, action) VALUES (?, ?)");
$log_stmt->bind_param("is", $admin_id, $action);
$log_stmt->execute();

header("Location: admin.php");
?>
