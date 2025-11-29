<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
  body {
    background: linear-gradient(135deg, #f0f4ff, #e4f1ff);
    font-family: 'Segoe UI', sans-serif;
  }
  .profile-card {
    border-radius: 20px;
    background: #fff;
    transition: transform 0.3s ease;
  }
  .profile-card:hover {
    transform: translateY(-5px);
  }
  .profile-picture {
    position: relative;
    display: inline-block;
  }
  .profile-picture input {
    display: none;
  }
  .profile-picture label {
    cursor: pointer;
    position: absolute;
    bottom: 0;
    right: 0;
    background: #0d6efd;
    color: white;
    border-radius: 50%;
    padding: 6px;
    border: 2px solid white;
    transition: background 0.3s;
  }
  .profile-picture label:hover {
    background: #084298;
  }
  .milestone-item {
    transition: all 0.3s ease;
  }
  .milestone-item:hover {
    background-color: #f8f9fa;
    transform: scale(1.02);
  }
  .progress {
    height: 10px;
    border-radius: 5px;
  }
</style>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <!-- Profile Card -->
      <div class="card shadow-lg profile-card p-4" data-aos="fade-up">
        <a href="<?= base_url('dashboard/sk') ?>" class="btn btn-outline-secondary mb-4">
          <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
        </a>

        <h2 class="text-center mb-4"><i class="bi bi-person-circle me-2"></i>My Profile</h2>

        <?php if(session()->getFlashdata('success')): ?>
          <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
          <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- Profile Picture -->
        <div class="text-center mb-4 profile-picture" data-aos="zoom-in">
          <?php if (!empty($official['profile_picture'])): ?>
            <img src="<?= base_url('uploads/profile_pictures/' . $official['profile_picture']) ?>" class="rounded-circle shadow" width="150" height="150" style="object-fit: cover;">
          <?php else: ?>
            <img src="<?= base_url('assets/img/default-avatar.png') ?>" class="rounded-circle shadow" width="150" height="150">
          <?php endif; ?>
          <label for="profilePic"><i class="bi bi-camera-fill"></i></label>
        </div>

        <!-- Profile Form -->
        <form action="<?= base_url('skprofile/updateProfile') ?>" method="post" enctype="multipart/form-data" data-aos="fade-up">
          <input type="file" name="profile_picture" id="profilePic">

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="<?= esc($official['full_name'] ?? '') ?>">
            <label>Full Name</label>
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?= esc($official['email'] ?? '') ?>">
            <label>Email</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?= esc($official['phone'] ?? '') ?>">
            <label>Phone</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="address" placeholder="Address" value="<?= esc($official['address'] ?? '') ?>">
            <label>Address</label>
          </div>

          <!-- About Me -->
          <div class="form-floating mb-3">
            <textarea class="form-control" name="bio" placeholder="About Me" style="height: 100px"><?= esc($official['bio'] ?? '') ?></textarea>
            <label>About Me</label>
          </div>

          <!-- Profile Completion -->
          <div class="mb-3">
            <label class="form-label">Profile Completion</label>
            <div class="progress">
              <div class="progress-bar bg-success" style="width: 80%"></div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-1"></i> Update Profile</button>
        </form>

        <hr class="my-5">

        <!-- Achievements -->
        <h4 class="text-center mb-4"><i class="bi bi-trophy-fill me-2"></i>My Achievements</h4>
        <ul class="list-group mb-4">
          <?php if (!empty($milestones)): ?>
            <?php foreach ($milestones as $milestone): ?>
              <li class="list-group-item milestone-item">
                <strong><?= esc($milestone['title']) ?></strong><br>
                <span><?= esc($milestone['description']) ?></span>
                <?php if (!empty($milestone['attachment'])): ?>
                  <br>
                  <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $milestone['attachment'])): ?>
                    <img src="<?= base_url('uploads/milestones/' . $milestone['attachment']) ?>" style="max-width:200px; margin-top:10px;">
                  <?php else: ?>
                    <a href="<?= base_url('uploads/milestones/' . $milestone['attachment']) ?>" target="_blank">View Attachment</a>
                  <?php endif; ?>
                <?php endif; ?>
                <div class="text-muted mt-1"><small>Uploaded on <?= date('F j, Y', strtotime($milestone['created_at'])) ?></small></div>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="list-group-item text-muted">No milestones yet.</li>
          <?php endif; ?>
        </ul>

        <!-- Change Password -->
        <h4 class="text-center mb-3"><i class="bi bi-shield-lock-fill me-2"></i>Change Password</h4>
        <form action="<?= base_url('skprofile/changePassword') ?>" method="post" data-aos="fade-up">
          <div class="form-floating mb-3">
            <input type="password" class="form-control" name="current_password" placeholder="Current Password" required>
            <label>Current Password</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" name="new_password" placeholder="New Password" required>
            <label>New Password</label>
          </div>
          <button type="submit" class="btn btn-warning w-100"><i class="bi bi-arrow-repeat me-1"></i> Change Password</button>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800 });
</script>
