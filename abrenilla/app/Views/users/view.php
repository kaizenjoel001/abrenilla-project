
<!-- filepath: c:\xampp\htdocs\skgyes1\app\Views\users\view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1 class="mb-4">User Details</h1>
  <p><strong>ID:</strong> <?= esc($user['user_id']) ?></p>
  <p><strong>Full Name:</strong> <?= esc($user['full_name']) ?></p>
  <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
  <p><strong>Role:</strong> <?= esc($user['role']) ?></p>
  <p><strong>Phone:</strong> <?= esc($user['phone']) ?></p>
  <p><strong>Address:</strong> <?= esc($user['address']) ?></p>
  <p><strong>Age:</strong> <?= esc($user['age']) ?></p>
  <p><strong>Profile Picture:</strong></p>
  <img src="/uploads/<?= esc($user['profile_picture']) ?>" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;">
  <a href="/users" class="btn btn-secondary mt-3">Back to Users</a>
</div>
</body>
</html>