<?php
session_start();
if ($_SESSION['role'] !== 'admin') die("Access Denied");

$conn = new mysqli("localhost", "root", "", "feedback_system");


// Feedback stats
$stats = $conn->query("SELECT status, COUNT(*) as total FROM feedback GROUP BY status");
$counts = ['pending' => 0, 'in-progress' => 0, 'resolved' => 0];
while ($s = $stats->fetch_assoc()) {
  $counts[$s['status']] = $s['total'];
}

// Category filter
$filter = isset($_GET['category']) ? $_GET['category'] : '';
$query = "SELECT f.*, u.name FROM feedback f JOIN users u ON f.user_id = u.user_id";
if ($filter) $query .= " WHERE category='$filter'";
$query .= " ORDER BY f.created_at DESC";
$result = $conn->query($query);

// Fetch unique categories for dropdown
$categories = $conn->query("SELECT DISTINCT category FROM feedback");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Welcome Admin: <?= $_SESSION['name'] ?></h2>

  <div class="row mt-4">
    <div class="col-md-4"><div class="alert alert-info">Pending: <?= $counts['pending'] ?></div></div>
    <div class="col-md-4"><div class="alert alert-warning">In Progress: <?= $counts['in-progress'] ?></div></div>
    <div class="col-md-4"><div class="alert alert-success">Resolved: <?= $counts['resolved'] ?></div></div>
  </div>

  <form method="GET" class="my-3">
    <label>Filter by Category:</label>
    <select name="category" class="form-select" onchange="this.form.submit()">
      <option value="">All</option>
      <?php while ($cat = $categories->fetch_assoc()): ?>
        <option value="<?= $cat['category'] ?>" <?= ($cat['category'] == $filter ? 'selected' : '') ?>>
          <?= $cat['category'] ?>
        </option>
      <?php endwhile; ?>
    </select>
  </form>

  <h4>All Feedback</h4>
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="card my-3 p-3">
      <strong><?= $row['name'] ?> - <?= $row['category'] ?> [<?= $row['status'] ?>]</strong>
      <p><?= $row['message'] ?></p>

      <form method="post" action="update_status.php" class="d-flex mb-2">
        <input type="hidden" name="id" value="<?= $row['feedback_id'] ?>">
        <select name="status" class="form-select me-2">
          <option <?= $row['status']=='pending'?'selected':'' ?>>pending</option>
          <option <?= $row['status']=='in-progress'?'selected':'' ?>>in-progress</option>
          <option <?= $row['status']=='resolved'?'selected':'' ?>>resolved</option>
        </select>
        <button class="btn btn-warning">Update</button>
      </form>

      <a href="view_feedback.php?id=<?= $row['feedback_id'] ?>" class="btn btn-sm btn-outline-dark">View Messages</a>
    </div>
  <?php endwhile; ?>

  <a href="profile.php" class="btn btn-link mt-3">⚙️ Admin Profile</a>
  <a href="logs.php" class="btn btn-outline-secondary mt-3">View Activity Logs</a>
  
</div>
</body>
</html>
