<?php 
    require_once __DIR__ . '/../partials/head.php';
    require_once __DIR__ . '/../partials/nav.php';
    require_once __DIR__ . '/../partials/header.php';

?>

<main>

<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Theater Header -->
        <div class="text-center mb-16">
            <h1 class="theater-title text-5xl md:text-6xl font-bold text-red-900 mb-4">Het Stadstheater</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Waar kunst tot leven komt sinds 1923</p>
        </div>
        
        <!-- Theater Information -->
        <div class="grid md:grid-cols-2 gap-12 mb-20">
            <div class="space-y-6">
                <h2 class="theater-title text-3xl font-bold text-gray-900">Over ons theater</h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Gelegen in het hart van de stad, is Het Stadstheater al bijna een eeuw het culturele middelpunt van de regio. 
                    Onze prachtige art deco zaal biedt plaats aan 750 bezoekers en staat bekend om zijn uitstekende akoestiek.
                </p>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Wij programmeren een gevarieerd aanbod van toneel, muziek, dans en jeugdvoorstellingen, 
                    met zowel gerenommeerde gezelschappen als opkomend talent.
                </p>
                <div class="mt-8">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-map-marker-alt text-red-700 text-xl mr-4"></i>
                        <span class="text-gray-700">Stationsplein 12, 1012 AB Amsterdam</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-phone-alt text-red-700 text-xl mr-4"></i>
                        <span class="text-gray-700">020-1234567</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-red-700 text-xl mr-4"></i>
                        <span class="text-gray-700">info@hetstadstheater.nl</span>
                    </div>
                </div>
            </div>
            
            <div class="relative rounded-xl overflow-hidden shadow-lg">
                <img src="https://www.theateramsterdam.nl/sites/default/files/2018-05/01_Theaterzaal_view-podium_0.jpg" 
                     alt="Interieur van Het Stadstheater" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h3 class="theater-title text-2xl font-bold mb-2">Onze prachtige zaal</h3>
                    <p>Een van de mooiste theaterzalen van Nederland</p>
                </div>
            </div>
        </div>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4"><?php echo $heading; ?></h1>
        <a href="/NieuweEvent" class="inline-block mb-6 px-6 py-3 bg-red-700 text-white font-semibold rounded-lg shadow hover:bg-red-800 transition-colors duration-200">
            Nieuwe Evenementen
        </a>
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

                            <form method="POST" action="/destroyEvenement"
                            onsubmit="return confirm('Weet je zeker dat je dit evenement wilt verwijderen?');" class="inline-flex items-center ml-auto">
                                <input type="hidden" name="id" value="<?php echo $event['Id']; ?>">
                                <input type="hidden" name="_method" value="DELETE">
                                
                                <button type="submit" 
                                    class="ml-auto flex items-center gap-2 px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-full shadow transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-400"
                                    title="Evenement verwijderen">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <span class="hidden sm:inline">Verwijderen</span>
                                </button>
                            </form>
                            <a href="/event/edit/<?php echo $event['Id']; ?>" class="text-sm text-yellow-600 hover:underline ml-4">Bewerk</a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php';
