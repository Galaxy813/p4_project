<?php require_once base_path("views/partials/head.php") ?>

<?php require_once base_path("views/partials/nav.php") ?>
<main>

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
          <?php
              $types = [
                'Beheerder' => 'Beheerder',
                'Ticketmanager' => 'Ticketmanager',
                '' => 'Review'
              ];
              $selected = $_POST['type'] ?? '';
            ?>
            <div class="mb-6">
              <div class="flex space-x-3">
                <?php foreach ($types as $value => $label): ?>
                  <label class="block">
                    <input
                      type="radio"
                      name="type"
                      value="<?= $value ?>"
                      class="sr-only peer"
                      <?= $selected === $value ? 'checked' : '' ?>
                    >
                    <div class="px-4 py-2 rounded-md border text-sm font-medium cursor-pointer transition
                                border-gray-300 bg-white text-gray-700 hover:bg-indigo-100
                                peer-checked:bg-indigo-600 peer-checked:text-white">
                      <?= $label ?>
                    </div>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>
          
        </div>
        

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Regristeer</button>
        </div>
      </form>

    </div>
  </div>

</main>

<?php require_once base_path("views/partials/footer.php") ?>