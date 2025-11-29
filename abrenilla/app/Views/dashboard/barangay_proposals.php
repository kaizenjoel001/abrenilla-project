<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Barangay - View Proposals</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <style>
    #no-results {
      display: none;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-primary">Barangay Dashboard - View Proposals</h2>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <a href="<?= base_url('dashboard/barangay') ?>" class="btn btn-secondary mb-3">Back to Dashboard</a>


    <!-- Real-time Search Input -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by Title...">

    <table class="table table-bordered" id="proposalTable">
      <thead class="table-dark">
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Location</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($proposals)): ?>
          <?php foreach ($proposals as $proposal): ?>
            <tr>
              <td><?= esc($proposal['title']) ?></td>
              <td><?= esc($proposal['category']) ?></td>
              <td><?= esc($proposal['location']) ?></td>
             <?php
  $status = strtolower($proposal['status']);
  $badgeClass = match ($status) {
    'approved' => 'bg-success',
    'rejected' => 'bg-danger',
    default     => 'bg-warning text-dark'
  };
?>
<td><span class="badge <?= $badgeClass ?>"><?= esc($proposal['status']) ?></span></td>

              <td>
                <a href="<?= base_url('proposals/barangay/view/' . $proposal['id']) ?>" class="btn btn-primary btn-sm">View</a>
                <a href="<?= base_url('proposal/approve/' . $proposal['id']) ?>" class="btn btn-success btn-sm">Approve</a>
                <a href="<?= base_url('proposal/reject/' . $proposal['id']) ?>" class="btn btn-danger btn-sm">Reject</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center">No proposals found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <p id="no-results" class="text-center text-muted">No proposals found.</p>
  </div>

  <script>
    lucide.createIcons();

    // Real-time client-side search
    document.getElementById('searchInput').addEventListener('keyup', function () {
      const filter = this.value.toLowerCase();
      const rows = document.querySelectorAll('#proposalTable tbody tr');
      let visibleCount = 0;

      rows.forEach(row => {
        const title = row.cells[0].textContent.toLowerCase();
        if (title.startsWith(filter)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      // Show "no results" message
      document.getElementById('no-results').style.display = visibleCount === 0 ? 'block' : 'none';
    });
  </script>
</body>
</html>
