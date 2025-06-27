<?php

use Core\App;
use Core\Database;

// Haal en valideer ID
$id = (int) ($_POST['id'] ?? 0);

if ($id === 0) {
    // Geen geldige ID, redirect of foutmelding
    header('Location: /accounts');
    exit;
}

$db = App::resolve(Database::class);

try {
    // Zoek account
    $accounten = $db->query('SELECT * FROM gebruiker WHERE Id = :id', [
        'id' => $id
    ])->findOrFail();

    // Verwijder account
    $db->query('DELETE FROM gebruiker WHERE Id = :id', [
        'id' => $id
    ]);

    // Redirect
    header('Location: /accounts/create');
    exit;

} catch (Exception $e) {
    // Afhandeling wanneer gebruiker niet wordt gevonden of andere fout optreedt
    echo "Er is een fout opgetreden: " . $e->getMessage();
    exit;
}
