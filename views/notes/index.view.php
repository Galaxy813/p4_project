<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"/>
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>

<body class="h-full notes">

  <div class="min-h-full">

<?php require_once base_path("views/partials/nav.php") ?>
<div class="section__container">
  <div class="header">
    <p>Meldingen</p>
    <h1>Wat onze klanten denken van ons.</h1>
  </div>

  <?php if (!empty($notes)): ?>
    <div class="testimonials__grid">
      <?php foreach ($notes as $note): ?>
        <div class="card">
          <span><i class="ri-double-quotes-l"></i></span>
          <p><?= htmlspecialchars($note['Bericht']) ?></p>
          <hr>
          <img src="/img/Anonymous-avatar.png" alt="Avatar">
          <p class="name"><em>Door:</em> <?= htmlspecialchars($note['VolledigeNaam']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="error-box">
      <h1>Er bestaan geen meldingen op dit moment</h1>
    </div>
  <?php endif; ?>
</div>
  
</body>
</html>