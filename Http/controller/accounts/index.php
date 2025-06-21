<?php

use Core\App;
use Core\Database;

try {
    $db = App::resolve(Database::class);

    $accounts = $db->query("
        SELECT 
            Id,
            Gebruikersnaam,
            CONCAT(
                gebruiker.Voornaam, ' ', 
                COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
                gebruiker.Achternaam
            ) AS VolledigeNaam
        FROM gebruiker
    ")->get();

    //hier heb ik een view functie gemaakt dat meteen wat dat het een views folder is.
    view("accounts/index.view.php", [
        'accounts' => $accounts,
        'heading' => 'Accounten'
    ]);

} catch (Exception $e) {
    error_log('Fout bij ophalen accounts: ' . $e->getMessage());

    // Toon een foutmelding op het scherm
    view("accounts/index.view.php", [
        'accounts' => $accounts,
        'heading' => 'Accounten',
        'errors' => ['general' => 'Er is een fout opgetreden bij het laden van de accounts.']
    ]);
}
