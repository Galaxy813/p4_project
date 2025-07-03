<?php

use Core\App;
use Core\Database;

// Haal en valideer ID
$id = (int) ($_POST['id'] ?? 0);

if ($id === 0) {
    // Geen geldige ID, redirect of foutmelding
    header('Location: /medewerker/create');
    exit;
}

$db = App::resolve(Database::class);

try {
    // Zoek medewerker (controleer of deze bestaat)
    $medewerker = $db->query('SELECT * FROM medewerker WHERE Id = :id', [
        'id' => $id
    ])->findOrFail();

    // Verwijder eerst meldingen van deze medewerker
    $db->query('DELETE FROM melding WHERE GebruikerId = :id', [
        'id' => $id
    ]);

    // Verwijder vervolgens de medewerker
    $db->query('DELETE FROM medewerker WHERE Id = :id', [
        'id' => $id
    ]);

    // Zet succesbericht en redirect
    $_SESSION['success'] = "De medewerker is succesvol verwijderd";
    header('Location: /medewerker/create');
    exit;

} catch (Exception $e) {
    // Afhandeling wanneer medewerker niet wordt gevonden of andere fout optreedt
    echo "Er is een fout opgetreden: " . $e->getMessage();
    exit;
}