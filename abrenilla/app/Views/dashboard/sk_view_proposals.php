<!-- app/Views/dashboard/sk_view_proposals.php -->
<div id="viewProposalsSection" class="hidden container py-5">
  <h2 class="mb-4">My Submitted Proposals</h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <div id="proposalTableContainer">
    <?= view('dashboard/_proposal_table', ['proposals' => $proposals]) ?>
  </div>
</div>
