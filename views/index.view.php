<?php require_once "partials/head.php" ?>

<?php require_once "partials/nav.php" ?>

<?php require_once "partials/header.php" ?>

<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <?php if ($_SESSION['user'] ?? false): ?>
      <form method="POST" action="/note">
        <div class="col-span-full">
          <div class="w-full md:w-[60%]">

            <!-- Titel -->
            <label for="Bericht" class="block text-xl font-medium text-gray-900 mb-4">Beoordeling</label>

            <!-- Type selectie als knoppen -->
            <?php
              $types = [
                'notificatie' => 'Notificatie',
                'klacht' => 'Klacht',
                'review' => 'Review'
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

            <!-- Datum -->
            <div class="mb-6">
              <label for="date" class="block text-sm font-semibold text-gray-900 mb-1">Datum</label>
              <input type="date" name="date" id="date"
                class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 border border-gray-300 focus:outline-indigo-600"
                value="<?= $_POST['date'] ?? '' ?>">
                <?php if (isset($errors['date'])): ?>
                <p class="text-red-500 text-sm mt-1"><?= $errors['date'] ?></p>
              <?php endif ?>
            </div>
            

            <!-- Bericht -->
            <div class="mb-4">
              <textarea name="Bericht" id="Bericht" rows="3" placeholder="Typ hier je beoordeling..." required
                class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 border border-gray-300 focus:outline-indigo-600 sm:text-sm"><?= $_POST['Bericht'] ?? '' ?></textarea>
              <?php if (isset($errors['Bericht'])): ?>
                <p class="text-red-500 text-sm mt-1"><?= $errors['Bericht'] ?></p>
              <?php endif ?>
            </div>

            <!-- Submit -->
            <button type="submit"
              class="mt-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-indigo-600">
              Opslaan
            </button>

          </div>
        </div>
      </form>
    <?php endif; ?>
  </div>
</main>




<?php require_once "partials/footer.php" ?>