<!DOCTYPE html>
<html>
<head>
    <title>Register for <?= esc($event['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h3>Register for: <?= esc($event['title']) ?></h3>
    <p><?= esc($event['description']) ?></p>

   <form method="post" action="/event/submitRegistration">
    <input type="hidden" name="event_id" value="<?= esc($event['id']) ?>">
    <input class="form-control mb-2" name="name" placeholder="Your Name" required>
    <input class="form-control mb-2" type="number" name="age" placeholder="Your Age" required>
    <input class="form-control mb-2" name="contact" placeholder="Contact No." required>
    <input class="form-control mb-2" name="address" placeholder="Address" required>
    <textarea class="form-control mb-2" name="reason" placeholder="Why do you want to join?" required></textarea>
    <button class="btn btn-primary">Submit Registration</button>
</form>

</body>
</html>
