<?php

use Core\App;
use Core\Database;

try {
    $db = App::resolve(Database::class);
    //hier maak je een query aan.

    $medewerker = $db->query("
        SELECT 
            medewerker.Nummer,
            medewerker.Medewerkersoort,
            CONCAT(
                COALESCE(gebruiker.Voornaam, 'Onbekend'), ' ',
                COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
                COALESCE(gebruiker.Achternaam, '')
            ) AS VolledigeNaam
        FROM medewerker 
        LEFT JOIN gebruiker ON medewerker.GebruikerId = gebruiker.Id
    ")->get();

    view("medewerker/index.view.php", [
        'medewerker' => $medewerker,
        "heading" => "Medewerker overicht"
    ]);
    
} catch (Exception $e) {
    error_log('Fout bij ophalen medewerkers: ' . $e->getMessage());

    // Toon een foutpagina of foutmelding op het scherm
    view("medewerker/index.view.php", [
        'medewerker' => [],
        'heading' => "Medewerker overicht",
        'errors' => ['general' => 'Er is een fout opgetreden bij het laden van de medewerkers.']
    ]);
}
