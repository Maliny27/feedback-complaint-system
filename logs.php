//logs.php

<?php
session_start();
if ($_SESSION['role'] !== 'admin') die("Access Denied");
$conn = new mysqli("localhost", "root", "", "feedback_system");

$result = $conn->query("SELECT l.*, u.name FROM logs l JOIN users u ON l.admin_id = u.user_id ORDER BY l.timestamp DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Activity Log</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Admin Activity Logs</h3>
  <a href="admin.php" class="btn btn-link mb-3">← Back to Dashboard</a>

  <?php while ($log = $result->fetch_assoc()): ?>
    <div class="border-bottom mb-2">
      <strong><?= $log['name'] ?></strong> — <?= $log['action'] ?>
      <div><small><?= $log['timestamp'] ?></small></div>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
