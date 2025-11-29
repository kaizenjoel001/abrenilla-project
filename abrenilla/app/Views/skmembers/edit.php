
<!-- filepath: c:\xampp\htdocs\skgyes1\app\Views\skmembers\edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit SK Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
  <h1 class="mb-4">Edit SK Member</h1>
  <a href="/skmembers" class="btn btn-secondary mb-3">Back to SK Members</a>
  <form action="/skmembers/update/<?= $member['id'] ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="full_name" class="form-label">Full Name</label>
      <input type="text" name="full_name" class="form-control" value="<?= esc($member['full_name']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="age" class="form-label">Age</label>
      <input type="number" name="age" class="form-control" value="<?= esc($member['age']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="gender" class="form-label">Gender</label>
      <select name="gender" class="form-select" required>
        <option value="Male" <?= $member['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $member['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
        <option value="Other" <?= $member['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="position" class="form-label">Position</label>
      <input type="text" name="position" class="form-control" value="<?= esc($member['position']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="term_start" class="form-label">Term Start</label>
      <input type="date" name="term_start" class="form-control" value="<?= esc($member['term_start']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="term_end" class="form-label">Term End</label>
      <input type="date" name="term_end" class="form-control" value="<?= esc($member['term_end']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="Active" <?= $member['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
        <option value="Inactive" <?= $member['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="photo" class="form-label">Photo</label>
      <input type="file" name="photo" class="form-control">
      <?php if (!empty($member['photo'])): ?>
        <img src="/uploads/<?= esc($member['photo']) ?>" alt="Photo" style="width: 100px; height: 100px; border-radius: 50%; margin-top: 10px;">
      <?php endif; ?>
    </div>
    <div class="mb-3">
      <label for="bio" class="form-label">Bio</label>
      <textarea name="bio" class="form-control" rows="3"><?= esc($member['bio']) ?></textarea>
    </div>
    <div class="mb-3">
      <label for="achievements" class="form-label">Achievements</label>
      <textarea name="achievements" class="form-control" rows="3"><?= esc($member['achievements']) ?></textarea>
    </div>
    <div class="mb-3">
      <label for="projects" class="form-label">Projects</label>
      <textarea name="projects" class="form-control" rows="3"><?= esc($member['projects']) ?></textarea>
    </div>
    <div class="mb-3">
      <label for="contact_info" class="form-label">Contact Info</label>
      <input type="text" name="contact_info" class="form-control" value="<?= esc($member['contact_info']) ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update Member</button>
  </form>
</div>

<!-- Modal for Profile View -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">SK Member Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img src="/uploads/<?= esc($member['photo']) ?>" alt="Photo" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 20px;">
        </div>
        <p><strong>Full Name:</strong> <?= esc($member['full_name']) ?></p>
        <p><strong>Age:</strong> <?= esc($member['age']) ?></p>
        <p><strong>Gender:</strong> <?= esc($member['gender']) ?></p>
        <p><strong>Position:</strong> <?= esc($member['position']) ?></p>
        <p><strong>Term:</strong> <?= esc($member['term_start']) ?> - <?= esc($member['term_end']) ?></p>
        <p><strong>Status:</strong> <?= esc($member['status']) ?></p>
        <p><strong>Bio:</strong> <?= esc($member['bio']) ?></p>
        <p><strong>Achievements:</strong> <?= esc($member['achievements']) ?></p>
        <p><strong>Projects:</strong> <?= esc($member['projects']) ?></p>
        <p><strong>Contact Info:</strong> <?= esc($member['contact_info']) ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>