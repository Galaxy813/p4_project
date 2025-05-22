<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$accounts = $db->query("
    SELECT 
        Gebruikersnaam,
        CONCAT(gebruiker.Voornaam, ' ', 
               COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
               gebruiker.Achternaam) AS VolledigeNaam
    FROM Gebruiker
")->get();

view("accounts/index.view.php", [
    'accounts' => $accounts,
    'heading' => 'Accounten'
]);



