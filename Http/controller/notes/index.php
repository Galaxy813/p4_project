<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$notes = $db->query("
    SELECT 
        melding.Bericht,
        CONCAT(COALESCE(gebruiker.Voornaam, 'Onbekend'), ' ',
               COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
               COALESCE(gebruiker.Achternaam, '')) AS VolledigeNaam
    FROM melding
    LEFT JOIN medewerker ON melding.MedewerkerId = medewerker.Id
    LEFT JOIN gebruiker ON medewerker.GebruikerId = gebruiker.Id
")->get();

view("notes/index.view.php", [
    'notes' => $notes
]);