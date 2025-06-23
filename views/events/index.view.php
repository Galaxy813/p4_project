<?php 
    require_once __DIR__ . '/../partials/head.php';
    require_once __DIR__ . '/../partials/nav.php';
    require_once __DIR__ . '/../partials/header.php';

?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4"><?php echo $heading; ?></h1>
        <ul>
            <?php foreach ($events as $event): ?>
                <li class="mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                        <a href="/event/<?php echo $event['Id']; ?>" class="text-xl font-semibold text-blue-600 hover:underline">
                            <?php echo htmlspecialchars($event['Naam']); ?>
                        </a>
                        <div class="mt-2 text-gray-700">
                            <p><?php echo htmlspecialchars($event['Beschrijving']); ?></p>
                        </div>
                        <div class="mt-4 text-sm text-gray-500 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <?php echo htmlspecialchars($event['Datum']); ?> om <?php echo htmlspecialchars($event['Tijd']); ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php';
 ?>