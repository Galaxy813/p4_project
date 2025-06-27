<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$notes = $db->query("
    SELECT 
        melding.Id
        melding.Nummer,
        melding.Bericht,
        melding.GebruikerId,
        melding.Type,
        CONCAT(COALESCE(gebruiker.Voornaam, 'Onbekend'), ' ',
               COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
               COALESCE(gebruiker.Achternaam, '')) AS VolledigeNaam
    FROM melding
    LEFT JOIN gebruiker ON melding.GebruikerId = gebruiker.Id
    WHERE Type != 'Feedback'
")->get();

view("notes/index.view.php", [
    'notes' => $notes
]);