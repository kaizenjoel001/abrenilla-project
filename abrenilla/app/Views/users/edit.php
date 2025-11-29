
<!-- filepath: c:\xampp\htdocs\skgyes1\app\Views\users\edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1 class="mb-4">Edit User</h1>
  <form action="/users/update/<?= esc($user['user_id']) ?>" method="post">
    <div class="mb-3">
      <label for="full_name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="full_name" name="full_name" value="<?= esc($user['full_name']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select class="form-select" id="role" name="role" required>
        <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
        <option value="User" <?= $user['role'] === 'User' ? 'selected' : '' ?>>User</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="text" class="form-control" id="phone" name="phone" value="<?= esc($user['phone']) ?>">
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" class="form-control" id="address" name="address" value="<?= esc($user['address']) ?>">
    </div>
    <div class="mb-3">
      <label for="age" class="form-label">Age</label>
      <input type="number" class="form-control" id="age" name="age" value="<?= esc($user['age']) ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/users" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>