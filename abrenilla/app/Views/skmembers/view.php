<!-- filepath: c:\xampp\htdocs\skgyes1\app\Views\skmembers\view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SK Members</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .member-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      border-radius: 15px;
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
      border: 3px solid #fff;
      margin-top: -50px;
    }
    .filter-bar {
      background: #fff;
      padding: 15px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>

<div class="container py-5">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <a href="http://localhost:8080/index.php/dashboard/barangay" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
    <div class="btn-group">
      <button id="tableViewBtn" class="btn btn-outline-primary active">
        <i class="bi bi-table"></i> Table View
      </button>
      <button id="cardViewBtn" class="btn btn-outline-primary">
        <i class="bi bi-grid"></i> Card View
      </button>
    </div>
  </div>

  <h1 class="text-center mb-4">SK Members</h1>

  <!-- Filter Bar -->
  <div class="filter-bar mb-4">
    <form id="filterForm" class="row g-3">
      <div class="col-md-4">
        <label for="positionFilter" class="form-label">Position</label>
        <select id="positionFilter" class="form-select">
          <option value="">All Positions</option>
          <?php foreach (array_unique(array_column($members, 'position')) as $position): ?>
            <option value="<?= esc($position) ?>"><?= esc($position) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label for="termYearFilter" class="form-label">Term Year</label>
        <input type="number" id="termYearFilter" class="form-control" placeholder="Enter Year">
      </div>
      <div class="col-md-4">
        <label for="statusFilter" class="form-label">Status</label>
        <select id="statusFilter" class="form-select">
          <option value="">All Status</option>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
    </form>
  </div>

  <!-- Table View -->
  <div id="tableView">
    <table class="table table-striped align-middle shadow-sm bg-white">
      <thead class="table-primary">
        <tr>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Position</th>
          <th>Term</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($members as $member): ?>
          <tr data-position="<?= esc($member['position']) ?>" 
              data-term-start="<?= esc(date('Y', strtotime($member['term_start']))) ?>" 
              data-term-end="<?= esc(date('Y', strtotime($member['term_end']))) ?>" 
              data-status="<?= esc($member['status']) ?>">
            <td><img src="/uploads/<?= esc($member['photo']) ?>" class="rounded-circle" style="width: 50px; height: 50px;"></td>
            <td><?= esc($member['full_name']) ?></td>
            <td><?= esc($member['position']) ?></td>
            <td><?= esc($member['term_start']) ?> - <?= esc($member['term_end']) ?></td>
            <td><span class="badge <?= $member['status'] === 'Active' ? 'bg-success' : 'bg-secondary' ?>"><?= esc($member['status']) ?></span></td>
            <td>
              <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal<?= $member['id'] ?>"><i class="bi bi-eye"></i> View</button>
            </td>
          </tr>

          <!-- Modal -->
          <div class="modal fade" id="viewModal<?= $member['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><?= esc($member['full_name']) ?> - Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                  <img src="/uploads/<?= esc($member['photo']) ?>" class="rounded-circle shadow-sm mb-3" style="width: 150px; height: 150px;">
                  <p><strong>Position:</strong> <?= esc($member['position']) ?></p>
                  <p><strong>Term:</strong> <?= esc($member['term_start']) ?> - <?= esc($member['term_end']) ?></p>
                  <p><strong>Status:</strong> <?= esc($member['status']) ?></p>
                  <p><strong>Bio:</strong> <?= esc($member['bio']) ?></p>
                  <p><strong>Achievements:</strong> <?= esc($member['achievements']) ?></p>
                  <p><strong>Projects:</strong> <?= esc($member['projects']) ?></p>
                  <p><strong>Contact Info:</strong> <?= esc($member['contact_info']) ?></p>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Card View -->
  <div id="cardView" class="row d-none">
    <?php foreach ($members as $member): ?>
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="card member-card shadow-sm text-center">
          <div class="card-body">
            <img src="/uploads/<?= esc($member['photo']) ?>" class="member-photo shadow-sm">
            <h5 class="mt-3 mb-1"><?= esc($member['full_name']) ?></h5>
            <p class="text-muted mb-1"><?= esc($member['position']) ?></p>
            <p class="small text-secondary mb-2"><?= esc($member['term_start']) ?> - <?= esc($member['term_end']) ?></p>
            <span class="badge <?= $member['status'] === 'Active' ? 'bg-success' : 'bg-secondary' ?>">
              <?= esc($member['status']) ?>
            </span>
            <hr>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal<?= $member['id'] ?>"><i class="bi bi-eye"></i> View</button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('filterForm').addEventListener('input', function () {
    const positionFilter = document.getElementById('positionFilter').value.toLowerCase();
    const termYearFilter = document.getElementById('termYearFilter').value;
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();

    document.querySelectorAll('#membersTable tbody tr, #cardView .member-card').forEach(row => {
      const position = row.dataset.position?.toLowerCase() || '';
      const termStart = row.dataset.termStart || '';
      const termEnd = row.dataset.termEnd || '';
      const status = row.dataset.status?.toLowerCase() || '';

      const matchesPosition = !positionFilter || position.includes(positionFilter);
      const matchesTermYear = !termYearFilter || (termYearFilter >= termStart && termYearFilter <= termEnd);
      const matchesStatus = !statusFilter || status === statusFilter;

      row.style.display = matchesPosition && matchesTermYear && matchesStatus ? '' : 'none';
    });
  });

  document.getElementById('tableViewBtn').addEventListener('click', function () {
    document.getElementById('tableView').classList.remove('d-none');
    document.getElementById('cardView').classList.add('d-none');
    this.classList.add('active');
    document.getElementById('cardViewBtn').classList.remove('active');
  });

  document.getElementById('cardViewBtn').addEventListener('click', function () {
    document.getElementById('tableView').classList.add('d-none');
    document.getElementById('cardView').classList.remove('d-none');
    this.classList.add('active');
    document.getElementById('tableViewBtn').classList.remove('active');
  });
</script>

</body>
</html>
