
<!-- filepath: c:\xampp\htdocs\skgyes1\app\Views\users\manage.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1 class="mb-4">Manage Users</h1>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= esc($user['user_id']) ?></td>
          <td><?= esc($user['full_name']) ?></td>
          <td><?= esc($user['email']) ?></td>
          <td><?= esc($user['role']) ?></td>
          <td>
            <a href="/users/view/<?= $user['user_id'] ?>" class="btn btn-info btn-sm">View</a>
            <a href="/users/edit/<?= $user['user_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="/users/delete/<?= $user['user_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>