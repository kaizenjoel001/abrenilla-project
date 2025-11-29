<!-- Bootstrap 5.3 JS and CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modern Table UI -->
<div class="container mt-4">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom">
      <h5 class="mb-0 text-primary fw-bold">Project Proposals</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-hover table-borderless align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Start - End</th>
            <th>Budget</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($proposals)): ?>
            <?php foreach ($proposals as $proposal): ?>
              <tr>
                <td class="fw-semibold"><?= esc($proposal['title']) ?></td>
                <td><?= esc($proposal['category']) ?></td>
                <td>
                  <?php if ($proposal['status'] === 'Approved'): ?>
                    <span class="badge bg-success-subtle text-success">Approved</span>
                  <?php elseif ($proposal['status'] === 'Rejected'): ?>
                    <span class="badge bg-danger-subtle text-danger">Rejected</span>
                  <?php else: ?>
                    <span class="badge bg-warning-subtle text-dark">Pending</span>
                  <?php endif; ?>
                </td>
                <td><?= esc($proposal['start_date']) ?> – <?= esc($proposal['end_date']) ?></td>
                <td>₱<?= number_format($proposal['estimated_budget'], 2) ?></td>
                <td class="text-center">
                  <button 
                    class="btn btn-sm btn-outline-primary"
                    onclick="viewProposalModal(<?= $proposal['id'] ?>)">
                    View
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center text-muted py-4">No proposals submitted yet.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="proposalDetailsModal" tabindex="-1" aria-labelledby="proposalDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content rounded-3 shadow">
      <div class="modal-header border-bottom">
        <h5 class="modal-title text-primary fw-bold" id="proposalDetailsModalLabel">Proposal Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="proposalDetailsContent">
        <div class="text-center py-5 text-muted">Loading...</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal View Function -->
<script>
function viewProposalModal(id) {
  const modal = new bootstrap.Modal(document.getElementById('proposalDetailsModal'));
  document.getElementById('proposalDetailsContent').innerHTML = '<div class="text-center py-5 text-muted">Loading...</div>';
  modal.show();

  // Fetch the proposal details from the server
  fetch(`<?= base_url('proposals/view/') ?>${id}`, {
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(response => response.text())
  .then(data => {
    // Load the fetched data into the modal content
    document.getElementById('proposalDetailsContent').innerHTML = data;
  })
  .catch(error => {
    console.error('Error:', error);
    document.getElementById('proposalDetailsContent').innerHTML = '<div class="text-danger text-center py-3">Failed to load proposal details.</div>';
  });
}
</script>

<!-- Optional: Custom Hover Style -->
<style>
.table-hover tbody tr:hover {
  background-color: #f8f9fa;
}
</style>
