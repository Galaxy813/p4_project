<?php require_once base_path("views/partials/head.php") ?>

<?php require_once base_path("views/partials/nav.php") ?>

<main>

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Aanmelden met je account!</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/sessions" method="POST">
        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

          </div>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="current-password" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

          </div>
        </div>
        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Aanmelden</button>
        </div>
      </form>
      <?php if (isset($errors['email'])): ?>
        <p class="text-red-500 text-s mt-1 mb-1"><?= $errors['email'] ?></p>
      <?php endif ?>
      <?php if (isset($errors['password'])): ?>
        <p class="text-red-500 text-s mt-1 mb-1"><?= $errors['password'] ?></p>
      <?php endif ?>
      <p class="mt-10 text-center text-sm/6 text-gray-500">
        Heb je nog geen account?
        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Regristreer hier</a>
      </p>
    </div>
  </div>

</main>

<?php if (!empty($_SESSION['success'])): ?>
  <div id="popup-success" style="
    position: fixed;
    bottom: 20%;
    right: 20%;
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

<?php require_once base_path("views/partials/footer.php") ?>