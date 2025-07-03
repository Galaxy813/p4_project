<?php 
    require_once __DIR__ . '/../partials/head.php';
    require_once __DIR__ . '/../partials/nav.php';
?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Voeg nieuwe evenement</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/addEvenement" method="POST"> 
        <div>
          <label for="name" class="block text-sm/6 font-medium text-gray-900">naam</label>
          <div class="mt-2">
            <input type="text" name="naam" id="name" autocomplete="naam" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="beschrijving" class="block text-sm/6 font-medium text-gray-900">Beschrijving</label>
          </div>
          <div class="mt-2">
            <input type="text" name="beschrijving" id="beschrijving" autocomplete="beschrijving"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
          
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="date" class="block text-sm/6 font-medium text-gray-900">datum</label>
          </div>
          <div class="mt-2">
            <input type="date" name="datum" id="date" autocomplete="datum" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
          
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="time" class="block text-sm/6 font-medium text-gray-900">tijd</label>
          </div>
          <div class="mt-2">
            <input type="time" name="time" id="time" autocomplete="time" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
          
        </div>

       

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">voeg event toe</button>
        </div>
      </form>

  </div>

</main>

<?php require_once __DIR__ . '/../partials/footer.php';