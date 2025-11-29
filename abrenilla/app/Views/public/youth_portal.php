<!DOCTYPE html>
<html>
<head>
    <title>Youth Portal - SKGYES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2 class="text-center mb-4">Youth Portal</h2>
    <p class="lead text-center">
        Welcome to the Sangguniang Kabataan Youth Portal! Here you can explore volunteer opportunities,
        view SK projects, and learn how to get involved in your community.
    </p>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>📝 Volunteer Form</h5>
            <form method="post" action="/volunteer">
                <input name="name" class="form-control mb-2" placeholder="Your Full Name" required>
                <input name="age" type="number" class="form-control mb-2" placeholder="Your Age" required>
                <input name="contact" class="form-control mb-2" placeholder="Contact Number" required>
                <textarea name="message" class="form-control mb-2" placeholder="Why do you want to volunteer?" required></textarea>
                <button class="btn btn-primary">Submit as Volunteer</button>
            </form>
        </div>
    </div>

    <hr class="my-5">

    <h4 class="mb-3">📣 Latest Youth Events</h4>
    <div class="row">
        <?php if (!empty($events)) : ?>
            <?php foreach ($events as $event) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($event['title']) ?></h5>
                            <p class="card-text"><?= esc($event['description']) ?></p>
                            <p class="card-text"><strong>Date:</strong> <?= esc($event['event_date']) ?></p>
                            <p class="card-text"><strong>Location:</strong> <?= esc($event['location']) ?></p>
                            <a href="/event/register/<?= $event['id'] ?>" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <p class="text-muted text-center">📣 No events posted yet.</p>
        <?php endif ?>
    </div>
</body>
</html>
