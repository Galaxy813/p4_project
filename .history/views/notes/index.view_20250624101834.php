<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
  <title>Document</title>
  <link rel="stylesheet" href="/css/style.css">
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>

<body class="h-full notes">

  <?php if (!empty($_SESSION['success'])): ?>
    <div id="popup-success" style="
    position: fixed;
    bottom: 0%;
    right: 0%;
    transform: translate(-50%, -50%);
    background-color: #4ea253;
    color: rgb(255, 255, 255);
    padding: 25px 40px;
    font-size: 1.6em;
    border-radius: 10px;
    border: 1px solid rgb(79, 111, 79);
    box-shadow: 0 5px 30px rgba(0,0,0,0.2);
    font-weight: bold;
    z-index: 9999;
    opacity: 0.9;
    transition: opacity 0.5s ease-out;
">
      <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <script>
      setTimeout(() => {
        const popup = document.getElementById('popup-success');
        if (popup) {
          popup.style.opacity = '0';
          setTimeout(() => popup.remove(), 500);
        }
      }, 3000);

      // Optioneel: sluit popup bij klikken
      document.getElementById('popup-success').addEventListener('click', () => {
        const popup = document.getElementById('popup-success');
        popup.style.opacity = '0';
        setTimeout(() => popup.remove(), 500);
      });
    </script>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

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
                <input type="hidden" name="MeldingId" value="<?= $note['MeldingId'] ?? '' ?>">
                <input type="hidden" name="Nummer" value="<?= $note['Nummer'] ?? '' ?>">
                <input type="hidden" name="GebruikerId"
                  class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 border border-gray-300 focus:outline-indigo-600"
                  value="<?= $note['GebruikerId'] ?? '' ?>">
                  class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 border border-gray-300 focus:outline-indigo-600">
                <textarea name="Bericht" rows="3" placeholder="Typ hier je feedback..."
                  class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 border border-gray-300 focus:outline-indigo-600 sm:text-sm"></textarea>
                <?php if (isset($errors[$note['Nummer']]['Bericht'])): ?>
                  <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors[$note['Nummer']]['Bericht']) ?></p>
                <?php endif; ?>
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

    <!-- Hier voeg je de popup toe, vlak voor het sluiten van body -->


</body>

</html>