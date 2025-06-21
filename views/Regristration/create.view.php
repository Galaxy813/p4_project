<?php require_once base_path("views/partials/head.php") ?>

<?php require_once base_path("views/partials/nav.php") ?>

<main>
  <input type="hidden" name="id">

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Regristeer je account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/register" method="POST">
        <div>
          <label for="first" class="block text-sm/6 font-medium text-gray-900">Voornaam</label>
          <div class="mt-2">
            <input type="text" name="first" id="first" autocomplete="first" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="middle" class="block text-sm/6 font-medium text-gray-900">Tussenvoegsel</label>
          </div>
          <div class="mt-2">
            <input type="text" name="middle" id="middle" autocomplete="middle"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
          
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="last" class="block text-sm/6 font-medium text-gray-900">Achternaam</label>
          </div>
          <div class="mt-2">
            <input type="text" name="last" id="last" autocomplete="last" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
          
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email-adress</label>
          </div>
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
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Regristeer</button>
        </div>
      </form>
      <?php if (isset($errors['email'])): ?>
        <p class="text-red-500 text-s mt-1 mb-1"><?= $errors['email'] ?></p>
      <?php endif ?>
      <?php if (isset($errors['password'])): ?>
        <p class="text-red-500 text-s mt-1 mb-1"><?= $errors['password'] ?></p>
      <?php endif ?>
      <?php if (isset($errors['emailUnique'])): ?>
        <p class="text-red-500 text-s mt-1 mb-1"><?= $errors['emailUnique'] ?></p>
      <?php endif ?>

      <p class="mt-10 text-center text-sm/6 text-gray-500">
        Heb je al een account?
        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Login hier</a>
      </p>
    </div>
  </div>

</main>

<?php require_once base_path("views/partials/footer.php") ?>