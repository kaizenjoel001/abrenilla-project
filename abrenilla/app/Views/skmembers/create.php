
<!-- filepath: c:\xampp\htdocs\skgyes1\app\Views\skmembers\create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add SK Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1 class="mb-4">Add SK Member</h1>
  <form action="/skmembers/store" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="full_name" class="form-label">Full Name</label>
      <input type="text" name="full_name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="age" class="form-label">Age</label>
      <input type="number" name="age" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="gender" class="form-label">Gender</label>
      <select name="gender" class="form-select" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="position" class="form-label">Position</label>
      <input type="text" name="position" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="term_start" class="form-label">Term Start</label>
      <input type="date" name="term_start" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="term_end" class="form-label">Term End</label>
      <input type="date" name="term_end" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="photo" class="form-label">Photo</label>
      <input type="file" name="photo" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="bio" class="form-label">Bio</label>
      <textarea name="bio" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="achievements" class="form-label">Achievements</label>
      <textarea name="achievements" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="projects" class="form-label">Projects</label>
      <textarea name="projects" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="contact_info" class="form-label">Contact Info</label>
      <input type="text" name="contact_info" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add Member</button>
  </form>
</div>
</body>
</html>