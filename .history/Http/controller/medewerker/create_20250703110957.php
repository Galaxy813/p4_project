<?php

use Core\App;
use Core\Validator;
use Core\Database;

$first = $_POST['first'];
$middle = $_POST['middle'] ?? null;
$last = $_POST['last'];
$type = $_POST['type'] ?? '';

// Valideer formuliergegevens
$errors = [];

if (!Validator::string($first, 4, 50)) {
    $errors['first'] = 'minimaal 4 en maximaal 50 tekens lang zijn.';
}

if (!Validator::string($last, 4, 50)) {
    $errors['last'] = 'Minimaal 4 en maximaal 50 tekens lang zijn.';
}

if (!empty($errors)) {
    return view('medewerker/create.view.php', [
        'errors' => $errors
    ]);
}

try {
    $db = App::resolve(Database::class);

    // Controleer of de gebruiker al bestaat
    $existingUser = $db->query('
        SELECT * FROM gebruiker 
        WHERE Voornaam = :first AND Tussenvoegsel <=> :middle AND Achternaam = :last
    ', [
        'first' => $first,
        'middle' => $middle,
        'last' => $last
    ])->find();

    if ($existingUser) {
        header('Location: /medewerker');
        exit();
    }

    // Voeg gebruiker toe
    $db->query('
        INSERT INTO gebruiker (Voornaam, Tussenvoegsel, Achternaam)
        VALUES (:first, :middle, :last)
    ', [
        'first' => $first,
        'middle' => $middle,
        'last' => $last
    ]);

    // Haal GebruikerId op
    $gebruikerId = $db->query('SELECT LAST_INSERT_ID() AS Id')->find()['Id'];

    // Bepaal volgende unieke Nummer
    $maxNummer = $db->query('SELECT MAX(Nummer) AS max FROM medewerker')->find()['max'] ?? 0;
    $nieuwNummer = $maxNummer + 1;

    // Voeg medewerker toe
    $db->query('
        INSERT INTO medewerker (GebruikerId, Medewerkersoort, Nummer)
        VALUES (:gebruikerId, :type, :Nummer)
    ', [
        'gebruikerId' => $gebruikerId,
        'type' => $type,
        'Nummer' => $nieuwNummer
    ]);

    header('Location: /medewerker/create');
    exit();

} catch (Exception $e) {
    error_log('Fout bij toevoegen medewerker: ' . $e->getMessage());

    return view('medewerker/create.view.php', [
        'errors' => ['general' => 'Er is een fout opgetreden bij het toevoegen van de medewerker.']
    ]);
}
