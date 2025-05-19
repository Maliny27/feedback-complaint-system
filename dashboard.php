

<?php
session_start();
if ($_SESSION['role'] !== 'user') die("Access Denied");

$conn = new mysqli("localhost", "root", "", "feedback_system");
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM feedback WHERE user_id=$user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Welcome, <?= $_SESSION['name'] ?></h2>

  <form method="post" action="submit_feedback.php" class="card p-4 mt-4 shadow">
    <h4>Submit Feedback/Complaint</h4>
    <input type="text" name="category" class="form-control mb-2" placeholder="Category (e.g., IT, HR)" required>
    <textarea name="message" class="form-control mb-2" placeholder="Describe your issue..." required></textarea>
    <button class="btn btn-primary w-100">Submit</button>
  </form>

  <h4 class="mt-5">Your Submissions</h4>
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="card my-3 p-3">
      <strong><?= $row['category'] ?> [<?= $row['status'] ?>]</strong>
      <p><?= $row['message'] ?></p>
      <a href="view_feedback.php?id=<?= $row['feedback_id'] ?>" class="btn btn-sm btn-outline-primary">View Thread</a>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
