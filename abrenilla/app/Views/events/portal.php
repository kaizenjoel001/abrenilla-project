<!DOCTYPE html>
<html>
<head>
  <title>Post Youth Event</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .img-preview {
      max-height: 200px;
      margin-top: 10px;
    }
  </style>
</head>
<body class="bg-light py-5">

<div class="container">
  <div class="text-center mb-4">
    <h2 class="text-primary">Post a Youth Event</h2>
    <p class="text-muted">Encourage youth participation by posting community activities.</p>
  </div>

  <?php if (session()->getFlashdata('toast_success')) : ?>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: '<?= session()->getFlashdata('toast_success') ?>',
          timer: 2000,
          showConfirmButton: false
        });
      });
    </script>
  <?php endif; ?>

  <div class="card shadow p-4">
    <form action="<?= base_url('event/store') ?>" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Event Title</label>
        <input name="title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Event Description</label>
        <textarea name="description" class="form-control" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category" class="form-select" required>
          <option value="">Select Category</option>
          <option value="Health">Health</option>
          <option value="Education">Education</option>
          <option value="Sports">Sports</option>
          <option value="Environment">Environment</option>
          <option value="Recreation">Recreation</option>
        </select>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Event Date</label>
          <input type="date" name="event_date" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Location</label>
          <input name="location" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Event Image (optional)</label>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
        <img id="preview" class="img-preview d-none" />
      </div>

      <div class="d-flex justify-content-between">
        <a href="<?= base_url('index.php/dashboard/sk') ?>" class="btn btn-outline-secondary">← Back</a>
        <a href="<?= base_url('event/history') ?>" class="btn btn-outline-info">📋 View Event History</a>
        <button class="btn btn-primary">Submit Event</button>
      </div>
    </form>
  </div>
</div>

<script>
  function previewImage(event) {
    const reader = new FileReader();
    const preview = document.getElementById('preview');
    reader.onload = function() {
      preview.src = reader.result;
      preview.classList.remove('d-none');
    };
    if (event.target.files[0]) {
      reader.readAsDataURL(event.target.files[0]);
    }
  }
</script>

</body>
</html>
