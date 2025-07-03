<?php

use Core\App;
use Core\Database;

$naam = $_POST['naam'] ?? null;
$beschrijving = $_POST['beschrijving'] ?? null;
$datum = $_POST['datum'] ?? null;
$tijd = $_POST['time'] ?? null;

// Haal MedewerkerId op uit sessie of andere bron
$medewerkerId = $_SESSION['user']['id'] ?? null;


$db = App::resolve(Database::class);

try {
    $db->query('
        INSERT INTO voorstelling (
            MedewerkerId,
            Naam,
            Beschrijving,
            Datum,
            Tijd,
            Isactief,
            Datumaangemaakt,
            Datumgewijzigd
        ) VALUES (
            :medewerkerId,
            :naam,
            :beschrijving,
            :datum,
            :tijd,
            1,
            NOW(6),
            NOW(6)
        )
    ', [
        'medewerkerId' => $medewerkerId,
        'naam' => $naam,
        'beschrijving' => $beschrijving,
        'datum' => $datum,
        'tijd' => $tijd
    ]);

    $_SESSION['success'] = "De voorstelling is succesvol toegevoegd";
    header('Location: /');
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = "Er is een fout opgetreden bij het toevoegen van de voorstelling.";
    header('Location: /NieuweEvent'); // Of terug naar formulier
    exit;
}

