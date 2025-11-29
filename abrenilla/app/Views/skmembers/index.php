<!-- filepath: c:\xampp\htdocs\skgyes1\app\Views\skmembers\index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SK Members</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .member-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      border-radius: 15px;
      cursor: pointer;
    }
    .member-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }
    .member-photo {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #f8f9fa;
      margin-top: -50px;
    }
    .toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 25px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-5">

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="http://localhost:8080/index.php/dashboard/sk" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
    <h1 class="text-center flex-grow-1 mb-0">SK Members</h1>
    <div style="width: 120px;"></div> <!-- Spacer for symmetry -->
  </div>

  <!-- Toolbar -->
  <div class="toolbar">
    <a href="/skmembers/create" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Add New Member
    </a>
    <input type="text" id="searchInput" class="form-control w-auto" placeholder="Search member...">
  </div>

  <!-- Members Grid -->
  <div class="row" id="membersGrid">
    <?php foreach ($members as $member): ?>
      <div class="col-md-4 col-sm-6 mb-4 member-item">
        <div class="card member-card shadow-sm" data-id="<?= $member['id'] ?>">
          <div class="card-body text-center">
            <img src="/uploads/<?= $member['photo'] ?>" alt="Photo" class="member-photo shadow-sm">
            <h5 class="mt-3 mb-1"><?= esc($member['full_name']) ?></h5>
            <p class="text-muted mb-1"><?= esc($member['position']) ?></p>
            <p class="small text-secondary mb-2"><?= esc($member['term_start']) ?> - <?= esc($member['term_end']) ?></p>
            <span class="badge <?= $member['status'] === 'Active' ? 'bg-success' : 'bg-secondary' ?>">
              <?= esc($member['status']) ?>
            </span>
            <hr>
            <div class="d-flex justify-content-center gap-2">
              <a href="/skmembers/edit/<?= $member['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
              <a href="/skmembers/delete/<?= $member['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i> Delete</a>
              <button class="btn btn-info btn-sm view-profile" data-id="<?= $member['id'] ?>"><i class="bi bi-eye"></i> View</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Member Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center" id="profileContent">
        <div class="text-muted">Loading...</div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS & Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Search filter
  document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    document.querySelectorAll('.member-item').forEach(function(card) {
      let name = card.querySelector('h5').innerText.toLowerCase();
      card.style.display = name.includes(filter) ? '' : 'none';
    });
  });

  // View profile in modal
  document.querySelectorAll('.view-profile').forEach(function(btn) {
    btn.addEventListener('click', function() {
      let id = this.dataset.id;
      let modal = new bootstrap.Modal(document.getElementById('profileModal'));
      document.getElementById('profileContent').innerHTML = '<div class="text-muted">Loading...</div>';

      fetch(`/skmembers/view/${id}`)
        .then(res => res.text())
        .then(data => {
          document.getElementById('profileContent').innerHTML = data;
        })
        .catch(() => {
          document.getElementById('profileContent').innerHTML = '<div class="text-danger">Failed to load profile.</div>';
        });

      modal.show();
    });
  });
</script>

</body>
</html>
