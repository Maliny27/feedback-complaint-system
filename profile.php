//profile.php

<?php
session_start();
if ($_SESSION['role'] !== 'admin') die("Access Denied");

$conn = new mysqli("localhost", "root", "", "feedback_system");
$admin_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $password = $_POST['password'];
  if ($password) {
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE users SET name=?, password_hash=? WHERE user_id=?");
    $stmt->bind_param("ssi", $name, $hash, $admin_id);
  } else {
    $stmt = $conn->prepare("UPDATE users SET name=? WHERE user_id=?");
    $stmt->bind_param("si", $name, $admin_id);
  }
  $stmt->execute();
  $_SESSION['name'] = $name;
  $conn->query("INSERT INTO logs (admin_id, action) VALUES ($admin_id, 'Updated admin profile')");
  echo "<script>alert('Profile updated.'); window.location='admin.php';</script>";
}

$user = $conn->query("SELECT * FROM users WHERE user_id=$admin_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Admin Profile Settings</h3>
  <form method="post" class="card p-4 shadow">
    <div class="mb-3">
      <label>Name:</label>
      <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
    </div>
    <div class="mb-3">
      <label>New Password (leave blank to keep current):</label>
      <input type="password" name="password" class="form-control">
    </div>
    <button class="btn btn-success">Save Changes</button>
    <a href="admin.php" class="btn btn-link">← Back to Dashboard</a>
  </form>
</div>
</body>
</html>
