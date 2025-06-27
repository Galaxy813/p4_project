<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
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
              <span><?= htmlspecialchars($note['Type']) ?></span>
              <p><?= htmlspecialchars($note['Bericht']) ?></p>
              <hr>
              <div class="card__footer">
                <img src="/img/Anonymous-avatar.png" alt="Avatar">
                <p class="name"><em>Door:</em> <?= htmlspecialchars($note['VolledigeNaam']) ?></p>
              </div>
              <form method="POST" action="/note/feedback">
                <input type="hidden" name="GebruikerId"
                  class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 border border-gray-300 focus:outline-indigo-600"
                  value="<?= $note['GebruikerId'] ?? '' ?>">
                <input type="hidden" name="FeedbackType" value="Feedback"
                  class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 border border-gray-300 focus:outline-indigo-600">
                <textarea name="Bericht" rows="3" placeholder="Typ hier je feedback..."
                  class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 border border-gray-300 focus:outline-indigo-600 sm:text-sm"><?= $_POST['Bericht'] ?? '' ?></textarea>
                <button type="submit"
                  class="mt-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-indigo-600">
                  Opslaan
                </button>
            </div>

            </form>
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