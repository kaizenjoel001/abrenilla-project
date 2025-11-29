<!-- app/Views/dashboard/sk_proposal_detail.php -->

<h4 class="mb-3"><?= esc($proposal['title']) ?> (<?= esc($proposal['category']) ?>)</h4>

<p><strong>Description:</strong><br> <?= esc($proposal['description']) ?></p>
<p><strong>Objectives:</strong><br> <?= esc($proposal['objectives']) ?></p>
<p><strong>Beneficiaries:</strong> <?= esc($proposal['beneficiaries']) ?></p>
<p><strong>Location:</strong> <?= esc($proposal['location']) ?></p>
<p><strong>Duration:</strong> <?= esc($proposal['start_date']) ?> to <?= esc($proposal['end_date']) ?></p>
<p><strong>Estimated Budget:</strong> ₱<?= number_format($proposal['estimated_budget'], 2) ?></p>
<p><strong>Budget Breakdown:</strong><br><?= nl2br(esc($proposal['budget_breakdown'])) ?></p>
<p><strong>Source of Funds:</strong> <?= esc($proposal['source_of_funds']) ?></p>
<p><strong>Expected Outcomes:</strong><br><?= nl2br(esc($proposal['expected_outcomes'])) ?></p>
<p><strong>Partners:</strong> <?= esc($proposal['partners']) ?: 'N/A' ?></p>

<p><strong>Status:</strong>
  <?php if ($proposal['status'] === 'Approved'): ?>
    <span class="badge bg-success">Approved</span>
  <?php elseif ($proposal['status'] === 'Rejected'): ?>
    <span class="badge bg-danger">Rejected</span>
  <?php else: ?>
    <span class="badge bg-warning text-dark">Pending</span>
  <?php endif; ?>
</p>

<?php if ($proposal['attachments']): ?>
  <p><strong>Attachment:</strong>
    <a href="<?= base_url('uploads/' . $proposal['attachments']) ?>" target="_blank">View/Download</a>
  </p>
<?php endif; ?>
