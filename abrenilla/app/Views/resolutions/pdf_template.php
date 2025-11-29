<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Resolution PDF</title>
  <style>
    body {
      font-family: "Times New Roman", Times, serif;
      margin: 50px;
      font-size: 16px;
      line-height: 1.6;
    }
    h3, h4, h5, h6, .center {
      text-align: center;
    }
    .header {
      margin-bottom: 30px;
    }
    .resolution-number {
      text-align: center;
      font-weight: bold;
      margin-top: 40px;
      text-transform: uppercase;
    }
    .title {
      text-align: center;
      font-weight: bold;
      margin: 10px 0 30px 0;
    }
    .body-text {
      text-align: justify;
      margin-bottom: 20px;
    }
    .approved-section {
      margin-top: 30px;
      text-align: justify;
    }
    .certified, .attested, .approved-by {
      margin-top: 50px;
    }
    .signature-block {
      margin-top: 30px;
      text-align: left;
    }
    .signatories-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .signatories-table th, .signatories-table td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }
    .underline {
      display: inline-block;
      border-bottom: 1px solid #000;
      width: 200px;
    }
  </style>
</head>
<body>

  <div class="header">
    <h4>Republic of the Philippines</h4>
    <h4>Province of <?= esc($res['province'] ?? 'Your Province') ?></h4>
    <h4>Municipality of <?= esc($res['municipality'] ?? 'Your Municipality') ?></h4>
    <h4>Barangay <?= esc($res['barangay'] ?? 'Your Barangay') ?></h4>
    <h4><strong>SANGGUNIANG KABATAAN</strong></h4>
  </div>

  <div class="resolution-number">
    SANGGUNIANG KABATAAN RESOLUTION NO. <?= esc($res['resolution_no']) ?>, SERIES OF 2025
  </div>

  <div class="title">
    <?= strtoupper(esc($res['title'])) ?>
  </div>

  <div class="body-text">
    <?= nl2br(esc($res['resolution_content'])) ?>
  </div>

  <div class="approved-section">
    <p>
      APPROVED this <?= date('jS \day of F Y', strtotime($res['date_passed'])) ?>, at the SK Office, Barangay <?= esc($res['barangay'] ?? 'Your Barangay') ?>, Municipality of <?= esc($res['municipality'] ?? 'Your Municipality') ?>, Province of <?= esc($res['province'] ?? 'Your Province') ?>.
    </p>
  </div>

  <div class="certified">
    <p><strong>CERTIFIED CORRECT:</strong></p>
    <br><br>
    <p class="underline"><?= esc($res['sk_secretary'] ?? '[Name]') ?></p>
    <p>SK Secretary</p>
  </div>

  <div class="attested">
    <p><strong>ATTESTED BY:</strong></p>
    <br><br>
    <p class="underline"><?= esc($res['prepared_by']) ?></p>
    <p>SK Chairperson</p>
  </div>

  <div class="approved-by">
    <p><strong>APPROVED BY THE SK COUNCIL:</strong></p>
    <table class="signatories-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Signature</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if (!empty($res['councilor_names'])):
            foreach ($res['councilor_names'] as $name):
        ?>
          <tr>
            <td><?= esc($name) ?></td>
            <td>SK Councilor</td>
            <td>__________________</td>
          </tr>
        <?php
            endforeach;
          else:
        ?>
          <!-- Placeholder rows if no data -->
          <?php for ($i = 1; $i <= 7; $i++): ?>
            <tr>
              <td>[Name <?= $i ?>]</td>
              <td>SK Councilor</td>
              <td>__________________</td>
            </tr>
          <?php endfor; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
