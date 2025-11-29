<div class="text-center">
    <img src="/uploads/<?= esc($member['photo']) ?>" 
         alt="Photo" 
         class="rounded-circle shadow-sm mb-3" 
         style="width: 120px; height: 120px; object-fit: cover;">

    <h4><?= esc($member['full_name']) ?></h4>
    <p class="text-muted"><?= esc($member['position']) ?></p>

    <span class="badge <?= $member['status'] === 'Active' ? 'bg-success' : 'bg-secondary' ?>">
        <?= esc($member['status']) ?>
    </span>

    <hr>
    <p><strong>Term:</strong> <?= esc($member['term_start']) ?> - <?= esc($member['term_end']) ?></p>
    <p><strong>Age:</strong> <?= esc($member['age']) ?></p>
    <p><strong>Gender:</strong> <?= esc($member['gender']) ?></p>

    <?php if (!empty($member['bio'])): ?>
        <p><strong>Bio:</strong> <?= esc($member['bio']) ?></p>
    <?php endif; ?>

    <?php if (!empty($member['achievements'])): ?>
        <p><strong>Achievements:</strong> <?= esc($member['achievements']) ?></p>
    <?php endif; ?>

    <?php if (!empty($member['projects'])): ?>
        <p><strong>Projects:</strong> <?= esc($member['projects']) ?></p>
    <?php endif; ?>

    <?php if (!empty($member['contact_info'])): ?>
        <p><strong>Contact:</strong> <?= esc($member['contact_info']) ?></p>
    <?php endif; ?>
</div>
