//login.php

<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>User Login</h2>
  <form action="login_action.php" method="post" class="card p-4 shadow">
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
    <button type="submit" class="btn btn-success w-100">Login</button>
    <a href="register.php" class="btn btn-link mt-2">Don't have an account?</a>
  </form>
</div>
</body>
</html>
