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
    // Zoek account (controleer of deze bestaat)
    $accounten = $db->query('SELECT * FROM gebruiker WHERE Id = :id', [
        'id' => $id
    ])->findOrFail();

    // Verwijder eerst meldingen van deze gebruiker
    $db->query('DELETE FROM melding WHERE GebruikerId = :id', [
        'id' => $id
    ]);

    // Verwijder vervolgens het account
    $db->query('DELETE FROM gebruiker WHERE Id = :id', [
        'id' => $id
    ]);

    // Zet succesbericht en redirect
    $_SESSION['success'] = "Je account is succesvol verwijderd";
    header('Location: /accounts/create');
    exit;

} catch (Exception $e) {
    // Afhandeling wanneer gebruiker niet wordt gevonden of andere fout optreedt
    echo "Er is een fout opgetreden: " . $e->getMessage();
    exit;
}
