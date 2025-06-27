<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

if (!isset($_GET['id'])) {
    die('Geen account ID opgegeven.');
}

$id = $_GET['id'];

$account = $db->query("
    SELECT 
        Id,
        Voornaam,
        Tussenvoegsel,
        Achternaam,
        Gebruikersnaam
    FROM gebruiker
    WHERE Id = :id
", [
    'id' => $id
])->find();

if (!$account) {
    die('Account niet gevonden.');
}

view("accounts/edit.view.php", [
    'heading' => 'Wijzig een account',
    'account' => $account
]);
