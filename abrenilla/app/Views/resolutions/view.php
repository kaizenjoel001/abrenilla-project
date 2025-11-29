<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2 class="mb-4 text-center">View Resolutions</h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-hover align-middle text-center border rounded shadow-sm">
      <thead class="table-primary">
        <tr>
          <th>Resolution No.</th>
          <th>Title</th>
          <th>Date Passed</th>
          <th>Status</th>
          <th>Prepared By</th> <!-- NEW COLUMN -->
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($resolutions as $res): ?>
        <tr>
          <td><?= esc($res['resolution_no']) ?></td>
          <td><?= esc($res['title']) ?></td>
          <td><?= date('F j, Y', strtotime($res['date_passed'])) ?></td>
          <td>
            <span class="badge bg-<?= $res['status'] === 'Approved' ? 'success' : ($res['status'] === 'Draft' ? 'warning' : 'secondary') ?>">
              <?= esc($res['status']) ?>
            </span>
          </td>
          <td><?= esc($res['prepared_by']) ?></td> <!-- SHOW VALUE -->
          <td>
            <a href="<?= base_url('/resolutions/view/'.$res['id']) ?>" class="btn btn-sm btn-info">View</a>
            <?php if ($res['status'] === 'Draft'): ?>
              <a href="#" class="btn btn-sm btn-primary">Edit</a>
              <a href="<?= base_url('/resolutions/delete/'.$res['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this resolution?')">Delete</a>
            <?php else: ?>
              <a href="<?= base_url('/resolutions/print/'.$res['id']) ?>" class="btn btn-sm btn-secondary" target="_blank">Print</a>
              <a href="<?= base_url('/resolutions/download/'.$res['id']) ?>" class="btn btn-sm btn-success">Download</a>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
