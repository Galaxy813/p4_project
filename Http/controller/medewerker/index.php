<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$medewerker = $db->query("
    SELECT 
        medewerker.Nummer,
        medewerker.Medewerkersoort,
        CONCAT(COALESCE(gebruiker.Voornaam, 'Onbekend'), ' ',
               COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
               COALESCE(gebruiker.Achternaam, '')) AS VolledigeNaam
    FROM medewerker 
    LEFT JOIN gebruiker ON medewerker.GebruikerId = gebruiker.Id
")->get();

view("medewerker/index.view.php", [
    'medewerker' => $medewerker,
    "heading" => "Medewerker overicht"
]);
