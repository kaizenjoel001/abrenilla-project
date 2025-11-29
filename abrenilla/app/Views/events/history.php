<?php // app/Views/events/history.php 
?> <!DOCTYPE html>
<html> 
<head> <title>Event History</title> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> </head>
 <body class="bg-light py-4"> <div class="container"> <div class="d-flex justify-content-between align-items-center mb-4"> <h2 class="text-primary">📋 Event History</h2> <a href="<?= base_url('event/portal') ?>" class="btn btn-outline-secondary">← Back to Youth Event</a> </div>

<?php if (!empty($events)) : ?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Date</th>
          <th>Location</th>
          <th>Posted By</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($events as $event) : ?>
          <tr>
            <td><?= esc($event['title']) ?></td>
            <td><?= esc($event['category']) ?></td>
            <td><?= esc($event['event_date']) ?></td>
            <td><?= esc($event['location']) ?></td>
            <td><?= esc($event['created_by']) ?></td>
            <td><?= esc($event['created_at']) ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
<?php else : ?>
  <div class="alert alert-warning text-center">
    No events have been posted yet.
  </div>
<?php endif; ?>
