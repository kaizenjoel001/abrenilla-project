<h2><?= esc($proposal['title']) ?></h2>
<p><strong>Category:</strong> <?= esc($proposal['category']) ?></p>
<p><strong>Description:</strong> <?= esc($proposal['description']) ?></p>
<p><strong>Objectives:</strong> <?= esc($proposal['objectives']) ?></p>
<p><strong>Beneficiaries:</strong> <?= esc($proposal['beneficiaries']) ?></p>
<p><strong>Location:</strong> <?= esc($proposal['location']) ?></p>
<p><strong>Start - End:</strong> <?= esc($proposal['start_date']) ?> to <?= esc($proposal['end_date']) ?></p>
<p><strong>Estimated Budget:</strong> ₱<?= esc($proposal['estimated_budget']) ?></p>
<p><strong>Budget Breakdown:</strong> <?= esc($proposal['budget_breakdown']) ?></p>
<p><strong>Source of Funds:</strong> <?= esc($proposal['source_of_funds']) ?></p>
<p><strong>Expected Outcomes:</strong> <?= esc($proposal['expected_outcomes']) ?></p>
<p><strong>Partners:</strong> <?= esc($proposal['partners']) ?></p>

<?php if ($proposal['attachments']): ?>
  <p><strong>Attachment:</strong> 
    <a href="<?= base_url('uploads/' . $proposal['attachments']) ?>" target="_blank">View File</a>
  </p>
<?php endif; ?>

<p><a href="<?= base_url('proposals/barangay') ?>">Back to List</a></p>
