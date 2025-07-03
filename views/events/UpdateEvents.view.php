<?php
<!-- filepath: c:\Users\nicky\Desktop\school shit\project\Aurora\views\events\UpdateEvents.view.php -->
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<main class="max-w-xl mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6"><?php echo $heading ?? 'Bewerk voorstelling'; ?></h1>
    <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Naam</label>
            <input type="text" name="Naam" value="<?php echo htmlspecialchars($event['Naam']); ?>" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Beschrijving</label>
            <textarea name="Beschrijving" class="w-full border rounded px-3 py-2" required><?php echo htmlspecialchars($event['Beschrijving']); ?></textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Datum</label>
            <input type="date" name="Datum" value="<?php echo htmlspecialchars($event['Datum']); ?>" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-6">
            <label class="block mb-1 font-semibold">Tijd</label>
            <input type="time" name="Tijd" value="<?php echo htmlspecialchars($event['Tijd']); ?>" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Opslaan
            </button>
            <a href="/events" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                Annuleren
            </a>
        </div>
    </form>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>