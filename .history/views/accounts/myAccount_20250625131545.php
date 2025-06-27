<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"/>
  <title>Document</title>
  <link rel="stylesheet" href="css/Account.css">
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>

<body class="h-full notes">

  <div class="min-h-full">

<?php require_once base_path("views/partials/nav.php") ?>
<div class="section__container">
  <div class="header">
    <p>Mijn Account</p>
    <h1>Dit zijn alle meldingen die ik heb geplaatsts met Feedback</h1>
  </div>

 <?php if (!empty($mynotes)): ?>
  <div class="testimonials__grid">
    <?php foreach ($mynotes as $Mynote): ?>
      <div class="card">
        <span><?= htmlspecialchars($Mynote['Type']) ?></span>
        <p><?= htmlspecialchars($Mynote['Bericht']) ?></p>
        <hr>
        <img src="/img/Anonymous-avatar.png" alt="Avatar">
        <p class="name"><em>Door: <?= htmlspecialchars($Mynote['VolledigeNaam']) ?></em></p>

        <!-- Feedback per melding -->
        <?php 
          $feedbacks = $feedbackPerMelding[$Mynote['MeldingId']] ?? [];
        ?>
        <?php if ($feedbacks): ?>
          <div class="mt-4 pl-4 border-l-4 border-blue-300 space-y-2">
            <?php foreach ($feedbacks as $feedback): ?>
              <div class="bg-blue-50 p-2 rounded">
                <p class="text-sm"><?= htmlspecialchars($feedback['FeedbackBericht']) ?></p>
                <p class="text-xs text-gray-500">
                  <em></em> op <?= date('d-m-Y', strtotime($feedback['FeedbackDatum'])) ?></em>
                </p>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-sm text-gray-400 mt-2"><em>Nog geen feedback ontvangen.</em></p>
        <?php endif; ?>

      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="error-box">
    <h1>Op dit moment heb je nog geen meldingen geplaatst</h1>
  </div>
<?php endif; ?>



</div> <!-- Verplaats deze hiernaartoe -->
  
</body>
</html>