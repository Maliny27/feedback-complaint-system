<?php
session_start();
$role = $_SESSION['role'];
$conn = new mysqli("localhost", "root", "", "feedback_system");

$feedback_id = $_GET['id'];
$feedback = $conn->query("SELECT * FROM feedback WHERE feedback_id=$feedback_id")->fetch_assoc();
$messages = $conn->query("SELECT * FROM messages WHERE feedback_id=$feedback_id ORDER BY timestamp");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Message Thread</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h4>Thread: <?= $feedback['category'] ?> [<?= $feedback['status'] ?>]</h4>
  <p><strong>Original Message:</strong> <?= $feedback['message'] ?></p>
  <hr>

  <?php while ($msg = $messages->fetch_assoc()): ?>
    <div class="mb-2">
      <strong><?= ucfirst($msg['sender_role']) ?>:</strong> <?= $msg['content'] ?>
      <div><small><?= $msg['timestamp'] ?></small></div>
    </div>
  <?php endwhile; ?>

  <form method="post" action="send_message.php" class="mt-4">
    <input type="hidden" name="feedback_id" value="<?= $feedback_id ?>">
    <textarea name="content" class="form-control mb-2" placeholder="Type your message..." required></textarea>
    <button class="btn btn-secondary">Send</button>
  </form>
  <a href="<?= ($_SESSION['role'] === 'admin') ? 'admin.php' : 'dashboard.php' ?>" class="btn btn-link mt-4">← Back to Dashboard</a>

</div>
</body>
</html>
