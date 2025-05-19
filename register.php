//register.php

<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>User Registration</h2>
  <form action="register_action.php" method="post" class="card p-4 shadow">
    <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
    <button type="submit" class="btn btn-primary w-100">Register</button>
    <a href="login.php" class="btn btn-link mt-2">Already have an account?</a>
  </form>
</div>
</body>
</html>
