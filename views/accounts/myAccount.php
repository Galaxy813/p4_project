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
    <?php foreach ($mynotes  as $Mynote): ?>
      <div class="card">
        <span><?= htmlspecialchars($Mynote['Type']) ?></span>
        <p><?= htmlspecialchars($Mynote['Bericht']) ?></p>
        <hr>
        <img src="/img/Anonymous-avatar.png" alt="Avatar">
        <p class="name"><em>Door:</em> <?= htmlspecialchars($Mynote['VolledigeNaam']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="error-box">
    <h1>Op dit moment heb je nog geen meldingen geplaatst</h1>
  </div>
<?php endif; ?>

<h2 class="text-xl font-bold my-4 text-gray-700">Feedback van anderen!</h2>
<!-- Feedback grid komt HIER, ook binnen section__container -->

<?php if (!empty($FeedbackNotes)): ?>
  <div class="testimonials__grid">
    <?php foreach ($FeedbackNotes as $FeedbackNote): ?>
      <div class="card">
        <span><?= htmlspecialchars($FeedbackNote['Type']) ?></span>
        <p><?= htmlspecialchars($FeedbackNote['Bericht']) ?></p>
        <hr>
        <img src="/img/Anonymous-avatar.png" alt="Avatar">
        <p class="name"><em>Door:</em> <?= htmlspecialchars($FeedbackNote['VolledigeNaam']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="error-box">
    <h1>Nog geen feedback gehad.</h1>
  </div>
<?php endif; ?>

</div> <!-- Verplaats deze hiernaartoe -->
  
</body>
</html>